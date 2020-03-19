<?php
use Phalcon\Loader;

$loader = new Loader();

/**
 * Register Namespaces
 */
$loader->registerNamespaces([
    'SG\Helpers' => APP_PATH. '/common/helpers/'
]);

$loader->register();

