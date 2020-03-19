<?php
namespace SG\Models;

class Order extends Model{

    public function initialize(){
        $this->setSource('orders');
        $this->hasMany('id', OrderProducts::class, 'order_id', array('alias' => 'products'));
    }


}