<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('see slots on the product page');
$product = $I->getProduct();
$I->amOnPage($product->url);

$I->seeGlobalSlots($I);

$I->seeElement('#nosto-page-product1');
$I->seeElement('#nosto-page-product2');
$I->seeElement('#nosto-page-product3');