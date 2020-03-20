<?php

namespace App\Test\Unit\Models;

use UnitTester;
use Codeception\Test\Unit;
use SG\Models\Admin;

class AdminTest extends Unit
{
    /**
     * The Users model.
     * @var Admin
     */
    protected $admin;

    /**
     * UnitTester Object
     * @var UnitTester
     */
    protected $tester;

    protected function _before(){
        $this->admin = new Admin();
    }

    public function testGetSource()
    {
        $this->assertEquals($this->admin->getSource(), 'admins');
    }

    public function testValidation(){
        $this->assertFalse($this->admin->save());
    }
}