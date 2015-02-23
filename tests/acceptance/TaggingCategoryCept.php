<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('see category tagging');

$category = $I->getCategory();
$I->amOnPage($category->url);
$I->see($category->name, '.nosto_category');