<?php
declare(strict_types=1);

use SG\Helpers\Locale;
use Phalcon\Escaper;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Router;
use Phalcon\Session\Adapter\Stream as SessionAdapter;
use Phalcon\Session\Manager as SessionManager;
use Phalcon\Url as UrlResolver;

/**
 * Registering a router
 */
$di->setShared('router', function () {
    $router = new Router();
    $router->setDefaultModule('frontend');
    return $router;
});

/**
 * The URL component is used to generate all kinds of URLs in the application
 */
$di->setShared('url', function () {
    $config = $this->getConfig();

    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
});

/**
 * Starts the session the first time some component requests the session service
 */
$di->setShared('session', function () {
    $session = new SessionManager();
    $files = new SessionAdapter([
        'savePath' => sys_get_temp_dir(),
    ]);
    $session->setAdapter($files);
    $session->start();

    return $session;
});

/**
 * Register the session flash service with the Twitter Bootstrap classes
 */
$di->set('flash', function () {
    $escaper = new Escaper();
    $flash = new \Phalcon\Flash\Session($escaper);
    $flash->setImplicitFlush(true);
    $flash->setCssClasses([
        'error'   => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice'  => 'alert alert-info',
        'warning' => 'alert alert-warning'
    ]);
    return $flash;
});


/**
 * Set the default namespace for dispatcher
 */
$di->setShared('dispatcher', function() use ($di) {
    $eventManager = $di->getShared('eventsManager');
    $eventManager->attach('dispatch:beforeException', function($event, Dispatcher $dispatcher, $exception) use($di) {
        switch ($exception->getCode()) {
            case \Phalcon\Dispatcher\Exception::EXCEPTION_HANDLER_NOT_FOUND:
            case\Phalcon\Dispatcher\Exception::EXCEPTION_ACTION_NOT_FOUND:
                http_response_code(404);
                $di->get('response')->redirect('/404');
                return false;
        }
    });

    $dispatcher = new Dispatcher();
    $dispatcher->setEventsManager($eventManager);
    $dispatcher->setDefaultNamespace('SG\Modules\Frontend\Controllers');
    return $dispatcher;
});

/**
 * Load translations
 */
$di->set("locale", function (){
    $translator = Locale::getInstance();
    return $translator->getTranslator();
});

$di->set("helper", function(){
    return \SG\Helpers\Helper::getInstance();
});

$di->set("orders", function(){
    return \SG\Helpers\Orders::getInstance();
});

$di->setShared('cache', function(){
    $factory = new \SG\Storage\SerializerFactory();

    $options = [
        'defaultSerializer' => 'Php',
        'lifetime'          => 7200,
        'servers'           => [
            0 => [
                'host'   => '127.0.0.1',
                'port'   => 11211,
                'weight' => 1,
            ]
        ],
    ];

   $adapter = new \Phalcon\Cache\Adapter\Libmemcached($factory, $options);
   return $adapter;
});

