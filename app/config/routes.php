<?php
$router = $di->getRouter();

$router->add("/404", ['controller' => 'index', 'action' => 'test']); //404 page router
$router->add("/order/{order}", ['controller' => 'index', 'action' => 'order'])->setName('order');
$router->add("/change-language/{language}", ['controller' => 'index', 'action' => 'changeLocale'])->setName('change-language');

foreach ($application->getModules() as $key => $module) {
    $namespace = preg_replace('/Module$/', 'Controllers', $module['className']);

    $router->add('/'.$key.'/:params', [
        'namespace' => $namespace,
        'module' => $key,
        'controller' => 'index',
        'action' => 'index',
        'params' => 1
    ])->setName($key);

    $router->add('/'.$key.'/:controller/:params', [
        'namespace' => $namespace,
        'module' => $key,
        'controller' => 1,
        'action' => 'index',
        'params' => 2
    ]);

    $router->add('/'.$key.'/:controller/:action/:params', [
        'namespace' => $namespace,
        'module' => $key,
        'controller' => 1,
        'action' => 2,
        'params' => 3
    ]);
}





