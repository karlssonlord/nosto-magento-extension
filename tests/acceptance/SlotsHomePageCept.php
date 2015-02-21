<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('see slots on the home page');
$I->amOnPage('/');

$I->seeGlobalSlots($I);

$I->seeElement('#frontpage-nosto-1');
$I->seeElement('#frontpage-nosto-2');
$I->seeElement('#frontpage-nosto-3');
$I->seeElement('#frontpage-nosto-4');