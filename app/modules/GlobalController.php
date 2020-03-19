<?php
declare(strict_types=1);
namespace SG\Modules;

use SG\Helpers\Cache;
use SG\Models\Admin;
use Phalcon\Mvc\Controller;

class GlobalController extends Controller {

    public $isAjax;

    function onConstruct(){
        $this->isAjax = $this->request->isAjax();
    }

}