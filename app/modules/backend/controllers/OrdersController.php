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

    public function deleteAction($id){
        if ($this->helper->getAccessLevel("promotions") > $this->account->level) {
            $this->flash->error($this->locale->t('no_access_to_this_page'));
        } else {
            $order = Order::findFirst($id);
            if ($order && $order->delete()) {
                $this->flash->success($this->locale->t('success_delete_order'));
            }
        }
        $this->response->redirect($_SERVER['HTTP_REFERER']);
    }
}