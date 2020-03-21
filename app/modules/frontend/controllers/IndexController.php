<?php
declare(strict_types=1);

namespace SG\Modules\Frontend\Controllers;

use Phalcon\Http\Response;
use SG\Models\Order;

class IndexController extends ControllerBase{

    public function indexAction(){
        if($this->request->isPost()){
            $products = $this->orders->prepareProductString($this->request->getPost('products'));
            if(!$products){
                $this->flash->error('Не сте въвели продукти');
            }else{
                $products = str_split($products, 1);
                $products = $this->orders->orderProducts($products);
                $order = $this->orders->prepareOrder($products);

                if(empty($order)) {
                    $this->flash->error('Съжаляваме, но няма съвпадение на продукти');
                }

                $order_id = $this->orders->saveOrder($order);
                if($order_id !== false){
                    $response = new Response();
                    $response->redirect("/order/".$order_id);
                    return $response->send();
                }else{
                    $this->flash->error('Упсс нещо се обърка! Моля, опитайте отново.');
                }
            }
        }
    }

    public function orderAction($id){
        $order = Order::findFirst($id);
        if(!$order) $this->response->redirect("/");
        $this->view->order = $order;
    }

    public function changeLocaleAction($language){
        $selected_language = mb_strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $language));
        $languages_config = $this->getDI()->get('config')->languages;

        $selected_language = in_array($selected_language, $languages_config->get('list')->toArray()) ? $selected_language : $languages_config->get('default');


        $this->cookies->set('_locale', $selected_language, time() + ((365*24)*60)*60, '/')->send();
        $this->response->redirect($_SERVER['HTTP_REFERER']);
    }
}

