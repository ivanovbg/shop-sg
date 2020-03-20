<?php
namespace SG\Modules\Backend\Forms;

use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\Date;
use Phalcon\Validation\Validator\Numericality;
new \Phalcon\Validation\Validator\Date;
use SG\Models\Product;

class PromotionForm extends Form {
    public function initialize(){
        ##product field
        $product = new Select('product_id', Product::find(['is_active' => 1]), ['using' => ['id', 'title'], 'useEmpty'   => true, 'emptyText'  => $this->di->get('locale')->t('please_select'), 'emptyValue' => null, 'class' => 'form-control']);
        $product->addValidator(new Numericality(['message' => $this->di->get('locale')->t('required_field'), 'allowEmpty' => false]));


        ##price field
        $price = new Numeric('price', ['class' => 'form-control', 'min' => 0, 'step'=>'.01']);
        $price->addValidator(new Numericality(['message' => $this->getDI()->get('locale')->t('required_field'), 'allowEmpty' => false]));

        ##number of products
        $products = new Numeric('products', ['class' => 'form-control', 'min' => 2, 'step'=> 1]);
        $products->addValidator(new Numericality(['message' => $this->getDI()->get('locale')->t('required_field'), 'allowEmpty' => false]));


        ##valid from - to fields
        $valid_from = new Text('valid_from', ['class' =>'form-control pull-right datepicker', 'readonly' => true]);
        $valid_from->addValidator(new Date(['message' => 'Невалидна дата', 'format' => 'Y-m-d', 'allowEmpty' => false]));
        $valid_to = new Text('valid_to', ['class' =>'form-control pull-right datepicker', 'readonly' => true]);
        $valid_to->addValidator(new Date(['message' => 'Невалидна дата', 'format' => 'Y-m-d', 'allowEmpty' => false]));


        ##active field
        $is_active = new Check('is_active', ['value' => 1]);

        $this->add($product)->add($products)->add($price)->add($valid_from)->add($valid_to)->add($is_active);
    }
}