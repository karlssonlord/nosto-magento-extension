<?php
namespace Codeception\Module;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

require_once 'tests/_support/Product.php';
require_once 'tests/_support/Category.php';

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
     * Adds a product to the shopping cart.
     * The product is the same as the one view on `$this->getProductPageUrl()`.
     *
     * @see AcceptanceHelper::getProductPageUrl
     * @param \AcceptanceTester $I
     * @param \Codeception\Module\Product $product
     */
    public function addProductToCart(\AcceptanceTester $I, Product $product)
    {
        $I->amOnPage($product->url);
        $I->submitForm('#product_addtocart_form', array());
    }

    /**
     * Returns a "Simple Product" for the Magento version currently being tested.
     * The product is hard-coded.
     *
     * @return \Codeception\Module\Product
     * @throws \Exception
     */
    public function getSimpleProduct()
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
     * @throws \Exception
     */
    public function getCategory()
    {
        $category = new Category();
        $category::$baseUrl = $this->config['baseUrl'];
        $category->load($this->config['version']);
        return $category;
    }

    /**
     * Returns the shopping cart page URL for the Magento version currently being tested.
     *
     * @return string the url.
     */
    public function getCartPageUrl()
    {
        return 'index.php/checkout/cart';
    }

    /**
     * Returns the search page URL for the Magento version currently being tested.
     *
     * @return string the url.
     */
    public function getSearchPageUrl()
    {
        return 'index.php/catalogsearch/result/?q=nosto';
    }
}
