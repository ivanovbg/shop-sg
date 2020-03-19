<?php

namespace App\Test\Unit\Models;

use SG\Models\OrderProducts;
use UnitTester;
use Codeception\Test\Unit;
use SG\Models\Admin;

class OrderProductsTest extends Unit
{
    /**
     * The Users model.
     * @var Admin
     */
    protected $orderProducts;

    /**
     * UnitTester Object
     * @var UnitTester
     */
    protected $tester;

    protected function _before(){
        $this->orderProducts = new OrderProducts();
    }

    public function testGetSource()
    {
        $this->assertEquals($this->orderProducts->getSource(), 'orders_products');
    }
}