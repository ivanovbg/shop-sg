<?php
declare(strict_types=1);

namespace SG\Modules\Backend;

use SG\Common\Library\loadProphiler;
use Phalcon\Di\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\View;
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
            'SG\Modules\Backend\Controllers' => __DIR__ . '/controllers/',
            'SG\Modules\Backend\Models' => __DIR__ . '/models/',
            'SG\Modules\Backend\Forms' => __DIR__.'/forms'
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
                '.volt'  => 'voltShared'
            ]);

            return $view;
        });
    }
}
