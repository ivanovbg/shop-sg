<?php
/**
 * @var \Codeception\Scenario $scenario
 */
$I = new FunctionalTester($scenario);

$I->wantTo('submit wrong order');

$I->amOnPage('/');
$I->see('SG - Online shop');
$I->fillField('products',    '&!&@&!@');
$I->click('Изпрати');
$I->seeElement(['xpath'=>'//div[contains(@class, "alert-danger")]']);