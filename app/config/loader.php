<?php
use Phalcon\Loader;

$loader = new Loader();

/**
 * Register Namespaces
 */
$loader->registerNamespaces([
    'SG\Models' => APP_PATH . '/common/models/',
    'SG\Common\Library' => APP_PATH. '/common/library/'
]);

/**
 * Register module classes
 */
$loader->registerClasses([
    'SG\Modules\Frontend\Module' => APP_PATH . '/modules/frontend/Module.php',
    'SG\Modules\Backend\Module' => APP_PATH . '/modules/backend/Module.php',
    'SG\Modules\Cli\Module'      => APP_PATH . '/modules/cli/Module.php',
    'SG\Modules\GlobalController' => APP_PATH . '/modules/GlobalController.php'
]);

$loader->register();
