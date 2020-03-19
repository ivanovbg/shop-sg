<?php 

class FirstCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
    }

    public function homePageVisibility(AcceptanceTester $I){
        $I->amOnPage('/');
        $I->see('Home');
    }
}
