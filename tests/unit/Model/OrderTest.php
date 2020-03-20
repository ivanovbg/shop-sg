<?php
namespace App\Test\Unit\Models;

use SG\Models\Order;
use UnitTester;
use Codeception\Test\Unit;

class OrderTest extends Unit
{
    /**
     * The Users model.
     * @var Order
     */
    protected $admin;

    /**
     * UnitTester Object
     * @var UnitTester
     */
    protected $tester;

    protected function _before(){
        $this->order = new Order();
    }

    public function testGetSource()
    {
        $this->assertEquals($this->order->getSource(), 'orders');
    }

    public function testValidation(){
        $this->assertFalse($this->order->save());
    }
}