<?php
namespace App\Test\Unit\Form;

use Codeception\Test\Unit;
use SG\Modules\Backend\Module;

class FormTest extends Unit{
    private $backendModule;

    protected function _before(){
        $this->backendModule = new Module();
        $this->backendModule->registerAutoloaders();
    }
}