<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('see cart tagging');

$product = $I->getSimpleProduct();
$I->addProductToCart($I, $product);
$I->amOnPage('/');
$I->see($product->productId, '.nosto_cart .line_item .product_id');
$I->see(1, '.nosto_cart .line_item .quantity');
$I->see($product->name, '.nosto_cart .line_item .name');
$I->see($product->price, '.nosto_cart .line_item .unit_price');
$I->see($product->currencyCode, '.nosto_cart .line_item .price_currency_code');