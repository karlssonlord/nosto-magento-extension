<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('see slots on the cart page');
$I->addProductToCart($I);
$I->amOnPage($I->getCartPageUrl());

$I->seeGlobalSlots($I);

$I->seeElement('#nosto-page-cart1');
$I->seeElement('#nosto-page-cart2');
$I->seeElement('#nosto-page-cart3');