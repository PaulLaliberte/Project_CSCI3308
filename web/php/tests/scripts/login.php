<?php
$I = new LoginTester($scenario);
$I->wantTo('log into the site')
$I->amOnPage('/')
$I->fillField('Name' 'paul')
$I->fillField('Password' 'password')
$I->click('Login')
?>
