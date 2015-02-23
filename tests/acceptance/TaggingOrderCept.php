<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('see order tagging');

$product = $I->getProduct();
$I->addProductToCart($I, $product);
$customer = $I->getCustomer();
$I->doOrder($I, $customer);

//$I->seeElement('.nosto_purchase_order .order_number');

$I->see($customer->firstName, '.nosto_purchase_order .buyer .first_name');
$I->see($customer->lastName, '.nosto_purchase_order .buyer .last_name');
$I->see($customer->email, '.nosto_purchase_order .buyer .email');

$I->see($product->productId, '.nosto_purchase_order .purchased_items .line_item .product_id');
$I->see(1, '.nosto_purchase_order .purchased_items .line_item .quantity');
$I->see($product->name, '.nosto_purchase_order .purchased_items .line_item .name');
$I->see($product->price, '.nosto_purchase_order .purchased_items .line_item .unit_price');
$I->see($product->currencyCode, '.nosto_purchase_order .purchased_items .line_item .price_currency_code');