<?php
namespace SG\Models;

class Product extends Model{

    public function initialize(){
        $this->setSource('products');
    }


    public static function getProduct($product_id, $is_active = null){
        if(!$is_active) return Product::findFirst($product_id);

        return Product::findFirst([
            'conditions' => 'id = :id: AND is_active = :is_active:',
            'bind' => ['id' => $product_id, 'is_active' => $is_active]
        ]);

    }


    public static function getProductBySku($sku, $id = null, $is_active = null){
        $conditions = "sku = :sku:";
        $bind['sku'] = $sku;

        if($id){
            $conditions .= " AND id != :id:";
            $bind['id'] = $id;
        }

        if($is_active){
            $conditions .= " AND is_active = :is_active:";
            $bind['is_active'] = $is_active;
        }

        return Product::findFirst(['conditions' => $conditions, 'bind' => $bind]);
    }

}