<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('see slots on the category page');
$category = $I->getCategory();
$I->amOnPage($category->url);

$I->seeGlobalSlots($I);

$I->seeElement('#nosto-page-category1');
$I->seeElement('#nosto-page-category2');