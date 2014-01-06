<?php
$I = new ApiGuy($scenario);
$I->wantTo('get all addresses');
$I->sendGET('/');
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseContainsJson(['label' => 'The White House']);

$I->wantTo('get certain addr');
$I->sendGET('/2');
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseContainsJson(['label' => 'Google Headquarters']);
