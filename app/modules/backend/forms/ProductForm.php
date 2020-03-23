<?php
namespace SG\Modules\Backend\Forms;

use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;

class ProductForm extends Form {
    public function initialize()
    {
        ##title field
        $title = new Text('title', ['class' => 'form-control']);
        $title->setFilters(['text', 'trim']);
        $title->addValidator(new PresenceOf(['message' => $this->getDI()->get('locale')->t('required_field')]));

        ##sku field
        $sku = new Text('sku', ['class' => 'form-control', 'onkeyup'=>"this.value = this.value.toUpperCase();", 'maxlength' => 1]);
        $sku->setFilters(['text']);
        $sku->addValidator(new StringLength(['max' => 1, 'min'=>1,'messageMinimum' => $this->getDI()->get('locale')->t('require_one_char'), 'messageMaximum' => $this->getDI()->get('locale')->t('require_one_char')]));

        ##description field
        $description = new TextArea('description', ['class' => 'form-control']);
        $description->setFilters(['text', 'trim']);
        $description->addValidator(new PresenceOf(['message' => $this->getDI()->get('locale')->t('required_field')]));

        ##price field
        $price = new Numeric('price', ['class' => 'form-control', 'min' => 0, 'step'=>'.01']);
        $price->addValidator(new PresenceOf(['message' => $this->getDI()->get('locale')->t('required_field')]));

        ##active field
        $is_active = new Check('is_active', ['value' => 1]);


        $this->add($title)->add($description)->add($price)->add($is_active)->add($sku);
    }
}