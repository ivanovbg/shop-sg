<?php
declare(strict_types=1);

namespace SG\Modules\Frontend;

use Dailty\Helpers\Locale;
use Phalcon\Di\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{
    /**
     * Registers an autoloader related to the module
     *
     * @param DiInterface $di
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();

        $loader->registerNamespaces([
            'SG\Modules\Frontend\Controllers' => __DIR__ . '/controllers/',
            'SG\Modules\Frontend\Models' => __DIR__ . '/models/',
        ]);

        $loader->register();
    }

    /**
     * Registers services related to the module
     *
     * @param DiInterface $di
     */
    public function registerServices(DiInterface $di)
    {
        /**
         * Setting up the view component
         */
        $di->setShared('view', function () {
            $view = new View();
            $view->setDI($this);
            $view->setViewsDir(__DIR__ . '/views/');
            $view->setLayoutsDir(__DIR__.'/views/_layout/');
            $view->setLayout("default");
            $view->setRenderLevel(View::LEVEL_ACTION_VIEW);

            $view->registerEngines([
                '.volt'  => 'voltShared',
                '.phtml' => PhpEngine::class
            ]);

            return $view;
        });
    }
}
