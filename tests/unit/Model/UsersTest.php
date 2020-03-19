<?php

namespace App\Test\Unit\Models;

use UnitTester;
use Codeception\Test\Unit;
use SG\Models\Admin;

class UsersTest extends Unit
{
    /**
     * The Users model.
     * @var Admin
     */
    protected $user;

    /**
     * UnitTester Object
     * @var UnitTester
     */
    protected $tester;

    protected function _before(){
        $this->user = new Admin();
    }

    public function testGetSource()
    {
        $this->assertEquals($this->user->getSource(), 'admins');
    }
}