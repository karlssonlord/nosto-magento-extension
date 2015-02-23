<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('see customer tagging');

$customer = $I->getCustomer();
$I->login($I, $customer);
$I->amOnPage('/');
$I->see($customer->firstName, '.nosto_customer .first_name');
$I->see($customer->lastName, '.nosto_customer .last_name');
$I->see($customer->email, '.nosto_customer .email');