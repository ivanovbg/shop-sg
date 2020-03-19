<?php
declare(strict_types=1);

use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;

/**
 * Shared configuration service
 */
$di->setShared('config', function () {
    return include APP_PATH . "/config/config.php";
});

$di->setShared("settings", function() use($di){
   return $di->get('config')->settings;
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->setShared('db', function () {
    $config = $this->getConfig();

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
    $params = [
        'host'     => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname'   => $config->database->dbname,
        'charset'  => $config->database->charset
    ];

    if ($config->database->adapter == 'Postgresql') {
        unset($params['charset']);
    }

    return new $class($params);
});

/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->setShared('modelsMetadata', function () {
    return new MetaDataAdapter();
});

/**
 * Configure the Volt service for rendering .volt templates
 */
$di->setShared('voltShared', function ($view){
    $config = $this->getConfig();

    $volt = new VoltEngine($view, $this);

    $volt->setOptions([
        'always' => $config->get('application')->debug,
        'path' => function($templatePath) use ($config) {
            $basePath = $config->application->appDir;
            if ($basePath && substr($basePath, 0, 2) == '..') {
                $basePath = dirname(__DIR__);
            }

            $basePath = realpath($basePath);
            $templatePath = trim(substr($templatePath, strlen($basePath)), '\\/');

            $filename = basename(str_replace(['\\', '/'], '_', $templatePath), '.volt') . '.php';

            $cacheDir = $config->application->cacheDir;
            if ($cacheDir && substr($cacheDir, 0, 2) == '..') {
                $cacheDir = __DIR__ . DIRECTORY_SEPARATOR . $cacheDir;
            }

            $cacheDir = realpath($cacheDir);

            if (!$cacheDir) {
                $cacheDir = sys_get_temp_dir();
            }

            $dir = $config->get("application")->debug ? "compile" : "volt";

            if (!is_dir($cacheDir . DIRECTORY_SEPARATOR . $dir)) {
                @mkdir($cacheDir . DIRECTORY_SEPARATOR . $dir , 0755, true);
            }

            return $cacheDir . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $filename;
        }
    ]);


    //clear folders
    if($config->get('application')->debug){
        $cacheFiles = glob(BASE_PATH.'/cache/volt/*.*');
        if(!empty($cacheFiles)){
            array_map( 'unlink', array_filter($cacheFiles));
        }
    }else{
        $cacheFiles = glob(BASE_PATH.'/cache/compile/*.*');
        if(!empty($cacheFiles)){
            array_map( 'unlink', array_filter($cacheFiles));
        }
    }

    $volt = \SG\Helpers\Volt::filters($volt); //load custom filters
    $volt = \SG\Helpers\Volt::functions($volt); //load custom functions

    return $volt;
});

$di->set('crypt', function() {
    $crypt = new \Phalcon\Crypt();
    $crypt->setKey('ReallyRandomKey');
    return $crypt;
});

$di->setShared('modelsCache', function () use($di){
    $serializerFactory = new \Phalcon\Storage\SerializerFactory();
    $options = [
        'defaultSerializer' => 'Php',
        'lifetime'          => \SG\Helpers\Cache::$default_lifetime,
        'server'           => [
                'host'   => $di->get('config')->cache->server,
                'port'   => $di->get('config')->cache->port,
                'weight' => 1

        ],
        'prefix' => 'models-cache-',
    ];
    $adapter =  new \Phalcon\Cache\Adapter\Libmemcached($serializerFactory, $options);
    return $adapter;
});


if($di->get('config')->application->debug && extension_loaded('memcached')){
    $adapter = $di->get('modelsCache');
    $keys = $adapter->getKeys();
    if(!empty($keys)){
        \SG\Helpers\Cache::clear($keys);
    }
}