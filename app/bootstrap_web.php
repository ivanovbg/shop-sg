<?php
declare(strict_types=1);

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Application;

error_reporting(E_ALL);
if(!defined('BASE_PATH')){
    define('BASE_PATH', dirname(__DIR__));
}

if(!defined('APP_PATH')) {
    define('APP_PATH', BASE_PATH . '/app');
}

try {
    /**
     * The FactoryDefault Dependency Injector automatically registers the services that
     * provide a full stack framework. These default services can be overidden with custom ones.
     */
    $di = new FactoryDefault();

    /**
     * Include general helpers
     */

    require APP_PATH . '/config/helpers.php';

    /**
     * Include general services
     */
    require APP_PATH . '/config/services.php';

    /**
     * Include web environment specific services
     */
    require APP_PATH . '/config/services_web.php';

    /**
     * Get config service for use in inline setup below
     */
    $config = $di->getConfig();

    /**
     * Include Autoloader
     */
    include APP_PATH . '/config/loader.php';

    /**
     * Handle the request
     */
    $application = new Application($di);

    /**
     * Register application modules
     */
    $application->registerModules([
        'frontend' => ['className' => 'SG\Modules\Frontend\Module'],
        'cms' => ['className' => 'SG\Modules\Backend\Module'],
    ]);

    /**
     * Include routes
     */
    require APP_PATH . '/config/routes.php';

    ##for tests
    if(defined("TEST")) return $application;

    echo $application->handle($_SERVER['REQUEST_URI'])->getContent();
} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
