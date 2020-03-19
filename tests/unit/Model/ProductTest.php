<?php

namespace App\Test\Unit\Models;

use SG\Models\Product;
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
}