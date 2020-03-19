<?php
namespace SG\Helpers;

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