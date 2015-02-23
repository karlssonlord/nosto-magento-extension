<?php
namespace Codeception\Module;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

require_once 'tests/_support/Product.php';
require_once 'tests/_support/Category.php';
require_once 'tests/_support/Customer.php';

class AcceptanceHelper extends \Codeception\Module
{
    /**
     * @inheritdoc
     */
    protected $requiredFields = array('version', 'baseUrl');

    /**
     * Asserts the global recommendation slots that are put one very page.
     *
     * @param \AcceptanceTester $I
     */
    public function seeGlobalSlots(\AcceptanceTester $I)
    {
        $I->seeElement('#nosto-page-top');
        $I->seeElement('#nosto-page-footer');
    }

    /**
     * Logs in a customer in the Magento frontend currently being tested.
     *
     * @param \AcceptanceTester $I
     * @param Customer $customer
     */
    public function login(\AcceptanceTester $I, Customer $customer)
    {
        $I->amOnPage('index.php/customer/account/login');
        $I->fillField(['id' => 'email'], $customer->email);
        $I->fillField(['id' => 'pass'], $customer->password);
        $I->click(['id' => 'send2']);
    }

    /**
     * Adds a product to the shopping cart.
     *
     * @param \AcceptanceTester $I
     * @param \Codeception\Module\Product $product
     */
    public function addProductToCart(\AcceptanceTester $I, Product $product)
    {
        $I->amOnPage($product->url);
        $I->submitForm('#product_addtocart_form', array());
    }

    /**
     * Does a new order and stops on the order confirmation page.
     * If no customer is given, the guest checkout will be done.
     *
     * @param \AcceptanceTester $I
     * @param \Codeception\Module\Customer $customer
     */
    public function doOrder(\AcceptanceTester $I, Customer $customer = null)
    {
        // todo: guest checkout
        if ($customer !== null) {
            $this->login($I, $customer);
        }

        $I->amOnPage('index.php/checkout/onepage');

        // Billing information
//        $I->fillField(['id' => 'billing[street][]'], 'Street Name');
//        $I->fillField(['id' => 'billing[city]'], 'City Name');
//        //$I->selectOption('billing[region_id]', 'Alabama'); // todo
//        $I->fillField(['id' => 'billing[postcode]'], '00000');
//        $I->fillField(['id' => 'billing[telephone]'], '123123');

        $I->click('#billing-buttons-container button');

        // Shipping method
        $I->click('#shipping-method-buttons-container button');

        // Payment information
        $I->selectOption('payment[method]', 'Check / Money order ');
        $I->click('#payment-buttons-container button');

        // Order review
        $I->click('#review-buttons-container button');
    }

    /**
     * Returns a product for the Magento version currently being tested.
     * The product is hard-coded.
     *
     * @return \Codeception\Module\Product
     */
    public function getProduct()
    {
        $product = new Product();
        $product::$baseUrl = $this->config['baseUrl'];
        $product->load($this->config['version']);
        return $product;
    }

    /**
     * Returns a category object for the Magento version currently being tested.
     *
     * @return \Codeception\Module\Category
     */
    public function getCategory()
    {
        $category = new Category();
        $category::$baseUrl = $this->config['baseUrl'];
        $category->load($this->config['version']);
        return $category;
    }

    /**
     * Returns a customer object for the Magento version currently being tested.
     *
     * @return \Codeception\Module\Customer
     */
    public function getCustomer()
    {
        return new Customer();
    }

    /**
     * Returns the shopping cart page URL for the Magento version currently being tested.
     *
     * @return string
     */
    public function getCartPageUrl()
    {
        return 'index.php/checkout/cart';
    }

    /**
     * Returns the search page URL for the Magento version currently being tested.
     *
     * @return string
     */
    public function getSearchPageUrl()
    {
        return 'index.php/catalogsearch/result/?q=nosto';
    }
}
