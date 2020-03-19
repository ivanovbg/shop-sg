<?php
declare(strict_types=1);

namespace SG\Modules\Frontend\Controllers;

use Phalcon\Http\Response;
use SG\Models\Order;
use SG\Models\OrderProducts;
use SG\Models\Product;
use SG\Models\Promotion;

class IndexController extends ControllerBase{

    public function indexAction(){
        if($this->request->isPost()){
            $products = $this->orders->prepareProductString($this->request->getPost('products'));
            if(!$products){
                $this->flash->error('Не сте въвели продукти');
            }else{
                $products = str_split($products, 1);
                $products = $this->orders->orderProducts($products);

                $order = [];
                foreach($products as $product => $items){
                    $productData = Product::getProductBySku($product, null, 1);

                    if(!$productData){
                        $notFoundProducts[] = $product;
                        continue;
                    }

                    $promotion = Promotion::findOneActualProductPromotion($productData->id);
                    $order['products'][] = array_merge(['product_id' => $productData->id], $this->orders->calculateProductOrder($productData, $items, $promotion));
                }


                if(empty($order)){
                	$this->flash->error('Съжаляваме, но няма съвпадение на продукти');
                }

                $order['total'] = $this->orders->calculateOrderTotal($order['products']);

                $orderEntry = new Order();
                $orderEntry->total_price = $order['total'];

                if($orderEntry->save()){
                    foreach($order['products'] as $key => $product){
                        $product['order_id'] = $orderEntry->id;
                        $orderProduct = new OrderProducts();
                        $orderProduct->assign($product);
                        $orderProduct->save();
                    }

                    $response = new Response();
                    $response->redirect("/order/".$orderEntry->id);
                    return $response->send();
                }

                $this->flash->error('Упсс нещо се обърка! Моля, опитайте отново.');
            }
        }
    }

    public function orderAction($id){
        $order = Order::findFirst($id);
        if(!$order) $this->response->redirect("/");
        $this->view->order = $order;
    }
}

