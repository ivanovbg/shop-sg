<?php
namespace SG\Modules\Backend\Controllers;

use SG\Helpers\Orders;
use SG\Models\Order;
use SG\Modules\GlobalController;

class OrdersController extends ControllerBase {

    public function indexAction(){
        $orders = Order::find(['order' => 'date_created desc']);

        $this->view->orders = $orders;
        $this->helper->menu('orders');
        $this->helper->breadcrumbs(['dashboard' => 'cms/dashboard', 'orders' => 'cms/orders']);
    }

    public function viewAction($id){

    }
}