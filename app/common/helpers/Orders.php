<?php
namespace SG\Helpers;

use SG\Models\Order;
use SG\Models\OrderProducts;
use SG\Models\Product;
use SG\Models\Promotion;

class Orders{
    private static $instance = false;

    private function __construct(){

    }

    public static  function getInstance(){
        if(self::$instance) {
            return self::$instance;
        }
        return new Orders();
    }

    public function prepareProductString($products){
        if(!$products) return false;
        $products = mb_strtoupper(preg_replace('/[^A-Za-z0-9\-]/', '', $products));
        if(!$products) return false;
        return $products;
    }

    public function orderProducts($products){
        $products_final = [];
        foreach($products as $product){
            if(array_key_exists($product, $products_final)){
                $products_final[$product] += 1;
            }else{
                $products_final[$product] = 1;
            }
        }

        return $products_final;
    }


    public function prepareOrder($products){
        $order = [];
        if(empty($products)) return $order;
        foreach($products as $product => $items){
            $productData = Product::getProductBySku($product, null, 1);

            if(!$productData){
                continue;
            }

            $promotion = Promotion::findOneActualProductPromotion($productData->id);
            $order['products'][] = array_merge(['product_id' => $productData->id], $this->calculateProductOrder($productData, $items, $promotion));
        }
        return $order;
    }

    public function saveOrder($order){
        $order['total'] = $this->calculateOrderTotal($order['products']);

        $orderEntry = new Order();
        $orderEntry->total_price = $order['total'];
        $is_ok = false;

        if($orderEntry->save()){
            foreach($order['products'] as $key => $product){
                $product['order_id'] = $orderEntry->id;
                $orderProduct = new OrderProducts();
                $orderProduct->assign($product);
                $orderProduct->save();
            }
            $is_ok = $orderEntry->id;
        }

        return $is_ok;
    }


    public function calculateProductOrder($product, $items_count, $promotion){
        if(!$promotion){
            return $this->productRowWithOutPromotion($product->price, $items_count);
        }else{
            if($promotion->products > $items_count){
                return $this->productRowWithOutPromotion($product->price, $items_count);
            }elseif($promotion->products == $items_count){
                return $this->productRowWithPromotion($items_count, $promotion);
            }else{
                $del = $items_count%$promotion->products;
                if($del){
                    $normal = fmod($items_count, $promotion->products);
                    $promo = ($items_count - $del);
                    return array_merge($this->productRowWithOutPromotion($product->price, $normal), $this->productRowWithPromotion($promo, $promotion));
                }else{
                    return $this->productRowWithPromotion($items_count, $promotion);
                }
            }
        }
    }

    public function calculateOrderTotal($products){
        $sum = 0;

        foreach($products as $product){

             if(isset($product['products_without_promotion'])){
                 $sum += $product['products_without_promotion'] * $product['product_regular_price'];
             }
             if(isset($product['promotion_id'])){
                 $sum += ($product['products_with_promotion']/$product['promotion_products']) * $product['promotion_price'];
             }
        }

        return $sum;
    }

    private function productRowWithOutPromotion($item_regular_price, $items_count){
        $product_row = ['products_without_promotion' => $items_count, 'product_regular_price' => $item_regular_price];
        return $product_row;
    }

    private function productRowWithPromotion($items_count, $promotion){
        $product_row = ['products_with_promotion' => $items_count, 'promotion_price' => $promotion->price, 'promotion_id' => $promotion->id, 'promotion_products' => $promotion->products];
        return $product_row;
    }


}