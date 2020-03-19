<?php
/**
 * @var \Codeception\Scenario $scenario
 */
$I = new FunctionalTester($scenario);
$I->wantTo('submit order');
$I->amOnPage('/');
$I->see('SG - Online shop');
$I->fillField('products', 'AAA');
$I->click('#submit');
$I->canSeeCurrentUrlMatches('/order/');
$url = $I->getCurrentUrl();
$I->seeInCurrentUrl($url);
$I->amOnPage($url);

