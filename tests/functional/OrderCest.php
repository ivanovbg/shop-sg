<?php

class OrderCest{

    public function submitWrongOrder(FunctionalTester $I){
        $I->wantTo('submit wrong order');
        $I->amOnPage('/');
        $I->see('SG - Online shop');
        $I->fillField('products',    '&!&@&!@');
        $I->click('Изпрати');
        $I->seeElement(['xpath'=>'//div[contains(@class, "alert-danger")]']);
    }

    public function submitOrder(FunctionalTester $I){
        $I->wantTo('submit order');
        $I->amOnPage('/');
        $I->see('SG - Online shop');
        $I->fillField('products', 'AAA');
        $I->click('#submit');
        $I->canSeeCurrentUrlMatches('/order/');
        $url = $I->getCurrentUrl();
        $I->seeInCurrentUrl($url);
        $I->amOnPage($url);
    }

}