<?php
namespace SG\Models;

use Phalcon\Di\DiInterface;

class Promotion extends Model{

    public function initialize(){
        $this->setSource('promotions');
        $this->hasOne('product_id', Product::class, 'id', array('alias' => 'product'));
    }


    public function beforeCreate(){
        if($this->valid_from != null){
            $valid_from = new \DateTime($this->valid_from);
            $this->valid_from = $valid_from->format('Y-m-d');
        }
        if($this->valid_to != null){
            $valid_to = new \DateTime($this->valid_to);
            $this->valid_to = $valid_to->format('Y-m-d');
        }
    }

    public function beforeUpdate(){
        if($this->valid_from != null){
            $valid_from = new \DateTime($this->valid_from);
            $this->valid_from = $valid_from->format('Y-m-d');
        }
        if($this->valid_to != null){
            $valid_to = new \DateTime($this->valid_to);
            $this->valid_to = $valid_to->format('Y-m-d');
        }
    }


    public static function findOneActualProductPromotion($product_id){
        $conditions = ['product_id' => $product_id, 'is_active' => 1];

        $promotion = Promotion::findFirst([
                'conditions' => 'product_id=:product_id: AND is_active=:is_active: AND (valid_from <= DATE(NOW()) AND valid_to >= DATE(NOW()))',
                'bind' => $conditions,
                'order' => 'id desc'
            ]
        );

        return $promotion ?? false;
    }

}