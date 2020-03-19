<?php
namespace SG\Models;

class OrderProducts extends Model{

    public function initialize(){
        $this->setSource('orders_products');
        $this->hasOne('product_id', Product::class, 'id', array('alias' => 'product'));
    }

}