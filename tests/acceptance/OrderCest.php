<?php
namespace App\Test\Acceptance;

use AcceptanceTester;

class OrderCest
{

    public function submitWrongOrder(AcceptanceTester $I){
        $I->wantTo('submit wrong order');
        $I->amOnPage('/');
        $I->seeResponseCodeIs(200);
        $I->see('SG - Online shop');
        $I->fillField('products',    '&!&@&!@');
        $I->click('#submit');
        $I->seeElement(['xpath'=>'//div[contains(@class, "alert-danger")]']);
    }


    public function submitOrder(AcceptanceTester $I){
        $I->wantTo('submit order');
        $I->amOnPage('/');
        $I->seeResponseCodeIs(200);
        $I->see('SG - Online shop');
        $I->fillField('products', 'AAA');
        $I->click('#submit');
        $I->canSeeCurrentUrlMatches('/order/');
        $I->seeResponseCodeIs(200);
        $I->see("Поръчка");
        $I->see('Общо: 130.00лв.');
        $I->dontSeeElement(['xpath'=>'//div[contains(@class, "alert-danger")]']);
    }
}
