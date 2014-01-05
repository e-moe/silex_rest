<?php
$I = new WebGuy($scenario);
$I->wantTo('ensure Navigation is working');
$I->amOnPage('/');

$I->expect('home nav is active and help is not');
$I->see('Home','.active');
$I->dontSee('Help','.active');

$I->expectTo('see correct links');
$I->seeLink('Home','/');
$I->seeLink('Help','/help');

$I->amGoingTo('open help page');
$I->click('Help');

$I->expect('help nav is active and home is not');
$I->see('Help','.active');
$I->dontSee('Home','.active');
