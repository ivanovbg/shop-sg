<?php
namespace App\Test\Functional;

use FunctionalTester;

class OrderCest{


    public function orderPageWork(FunctionalTester $I){
        $I->wantTo("View order page");
        $I->amOnPage("/");
        $I->seeResponseCodeIs(200);
        $I->seeInTitle('SG - Online shop');
    }

    public function submitWrongOrder(FunctionalTester $I){
        $I->wantTo('submit wrong order');
        $I->amOnPage('/');
        $I->seeResponseCodeIs(200);
        $I->see('SG - Online shop');
        $I->fillField('products',    '&!&@&!@');
        $I->click('#submit');
        $I->seeElement(['xpath'=>'//div[contains(@class, "alert-danger")]']);
    }

    public function submitOrder(FunctionalTester $I){
        $I->wantTo('submit order');
        $I->amOnPage('/');
        $I->seeResponseCodeIs(200);
        $I->see('SG - Online shop');
        $I->fillField('products', 'AAA');
        $I->click('#submit');
        $I->canSeeCurrentUrlMatches('/order/');
        $url = $I->getCurrentUrl();
        $I->seeInCurrentUrl($url);
        $I->amOnPage($url);
    }

}