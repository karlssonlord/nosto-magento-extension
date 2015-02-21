<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('see product tagging');

$product = $I->getSimpleProduct();
$I->amOnPage($product->url);
$I->see($product->url, '.nosto_product .url');
$I->see($product->productId, '.nosto_product .product_id');
$I->see($product->name, '.nosto_product .name');
$I->see($product->imageUrl, '.nosto_product .image_url');
$I->see($product->price, '.nosto_product .price');
$I->see($product->listPrice, '.nosto_product .list_price');
$I->see($product->currencyCode, '.nosto_product .price_currency_code');
$I->see($product->availability, '.nosto_product .availability');
$I->see($product->description, '.nosto_product .description');
$I->see($product->datePublished, '.nosto_product .date_published');
if (!empty($product->brand)) {
    $I->see($product->brand, '.nosto_product .brand');
}
foreach ($product->categories as $category) {
    $I->see($category, '.nosto_product .category');
}
foreach ($product->tags as $tag) {
    $I->see($tag, '.nosto_product .tag1');
}