<?php
namespace App\Test\Unit\Form;

use SG\Modules\Backend\Forms\ProductForm;

class ProductFormTest extends FormTest{

    /**
     * @var ProductForm
     */
    protected $form;
    protected $data = [];

    protected function _before(){
        parent::_before();
        $this->form = new ProductForm();
    }

    public function testValidation(){
        $data = [];
        $this->assertFalse($this->form->isValid($this->data));

        $this->data['title'] = 'test';
        $this->data['sku'] = "B";
        $this->data['price'] = 120;
        $this->data['is_active'] = 1;
        $this->data['description'] = "test product";

        $this->assertTrue($this->form->isValid($this->data));
    }
}