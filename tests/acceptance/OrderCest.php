<?php

class OrderCest
{
    public function _before(AcceptanceTester $I)
    {
    }


    public function wrongOrder(AcceptanceTester $I){
        $I->wantTo('submit wrong order');
        $I->amOnPage('/');
        $I->see('SG - Online shop');
        $I->fillField('products',    '&!&@&!@');
        $I->click('Изпрати');
        $I->seeElement(['xpath'=>'//div[contains(@class, "alert-danger")]']);
    }


    public function submitOrder(AcceptanceTester $I){
        $I->wantTo('submit order');
        $I->amOnPage('/');
        $I->see('SG - Online shop');
        $I->fillField('products', 'AAA');
        $I->click('#submit');
        $I->canSeeCurrentUrlMatches('/order/');
        $I->see("Поръчка");
        $I->see('Общо: 130.00лв.');
        $I->dontSeeElement(['xpath'=>'//div[contains(@class, "alert-danger")]']);
    }
}
