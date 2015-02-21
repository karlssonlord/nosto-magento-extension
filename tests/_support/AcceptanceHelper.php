<?php
namespace Codeception\Module;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

require_once 'tests/_support/Product.php';

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
     */
    public function addProductToCart(\AcceptanceTester $I)
    {
        $I->wantTo('add a product to cart');
        $product = $this->getSimpleProduct();
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
     * Returns the shopping cart page URL for the Magento version currently being tested.
     *
     * @return string the url.
     * @throws \Exception if the Magento version cannot be determined or is not supported.
     */
    public function getCartPageUrl()
    {
        switch ($this->config['version']) {
            case '1.8.1.0':
                return 'index.php/checkout/cart';

            default:
                throw new \Exception(sprintf('Invalid Magento version "%s".', $this->config['version']));
        }
    }

    /**
     * Returns a category page URL for the Magento version currently being tested.
     * The category is hard-coded.
     *
     * @return string the url.
     * @throws \Exception if the Magento version cannot be determined or is not supported.
     */
    public function getCategoryPageUrl()
    {
        switch ($this->config['version']) {
            case '1.8.1.0':
                return 'index.php/electronics/computers.html';

            default:
                throw new \Exception(sprintf('Invalid Magento version "%s".', $this->config['version']));
        }
    }

    /**
     * Returns the search page URL for the Magento version currently being tested.
     *
     * @return string the url.
     * @throws \Exception if the Magento version cannot be determined or is not supported.
     */
    public function getSearchPageUrl()
    {
        switch ($this->config['version']) {
            case '1.8.1.0':
                return 'index.php/catalogsearch/result/?q=nosto';

            default:
                throw new \Exception(sprintf('Invalid Magento version "%s".', $this->config['version']));
        }
    }
}
