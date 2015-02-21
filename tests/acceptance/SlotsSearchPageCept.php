<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('see slots on the search page');
$I->amOnPage($I->getSearchPageUrl());

$I->seeGlobalSlots($I);

$I->seeElement('#nosto-page-search1');
$I->seeElement('#nosto-page-search2');