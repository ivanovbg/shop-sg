<?php
namespace unit\Form;

use Codeception\Test\Unit;
use SG\Models\Product;
use SG\Modules\Backend\Forms\PromotionForm;

class PromotionFormTest extends FormTest{

    /**
     * @var PromotionForm
     */
    protected $form;
    protected $data = [];

    protected function _before(){
        parent::_before();
        $this->form = new PromotionForm();
    }

    public function testValidation(){

        $this->assertFalse($this->form->isValid($this->data));

        $product = Product::findFirst();

        if($product){
            $this->data['product_id'] = $product->id;
            $this->data['products'] = 12;
            $this->data['price'] = 120;
            $this->data['valid_from'] = new \DateTime();
            $this->data['valid_to'] = new \DateTime();
            $this->data['is_active'] = 1;
            $this->assertTrue($this->form->isValid($this->data));
        }
    }
}