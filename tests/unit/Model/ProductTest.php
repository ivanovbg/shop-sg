<?php

namespace App\Test\Unit\Models;

use Phalcon\Loader;
use SG\Models\Product;
use SG\Modules\Backend\Forms\ProductForm;
use UnitTester;
use Codeception\Test\Unit;

class ProductTest extends Unit
{
    /**
     * The Users model.
     * @var Product
     */
    protected $product;

    /**
     * UnitTester Object
     * @var UnitTester
     */
    protected $tester;

    protected function _before(){
        $this->product = new Product();
    }

    public function testGetSource()
    {
        $this->assertEquals($this->product->getSource(), 'products');
    }

    public function testValidation(){
        $this->assertFalse($this->product->save());
    }
}