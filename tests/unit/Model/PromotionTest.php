<?php

namespace App\Test\Unit\Models;


use SG\Models\Promotion;
use UnitTester;
use Codeception\Test\Unit;

class PromotionTest extends Unit
{
    /**
     * The Users model.
     * @var Promotion
     */
    protected $promotion;

    /**
     * UnitTester Object
     * @var UnitTester
     */
    protected $tester;

    protected function _before(){
        $this->promotion = new Promotion();
    }

    public function testGetSource()
    {
        $this->assertEquals($this->promotion->getSource(), 'promotions');
    }

    public function testValidation(){
        $this->assertFalse($this->promotion->save());
    }
}