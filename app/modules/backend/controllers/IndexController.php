<?php
declare(strict_types=1);

namespace SG\Modules\Backend\Controllers;

class IndexController extends ControllerBase {
    public function indexAction(){
        $this->helper->menu('dashboards');
        $this->helper->breadcrumbs(['dashboard' => 'admin/dashboard']);
    }
}

