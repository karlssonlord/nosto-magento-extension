<?php

namespace Codeception\Module;

class Product
{
    public static $baseUrl;
    public static $data = array(
        '1.8.1.0' => array(
            'url' => 'index.php/furniture/living-room/ottoman.html',
            'productId' => 51,
            'name' => 'Ottoman',
            'imageUrl' => 'media/catalog/product/o/t/ottoman.jpg',
            'price' => 299.99,
            'listPrice' => 299.99,
            'currencyCode' => 'USD',
            'availability' => 'InStock',
            'categories' => array('/Furniture/Living Room'),
            'description' => 'The Magento ottoman will impress with its style while it delivers on quality. This piece of living room furniture is built to last with durable solid wood framing, generous padding and plush stain-resistant microfiber upholstery.',
            'datePublished' => '2007-08-28',
            'brand' => null,
            'tags' => array('wood', 'Furniture', 'modern', 'red', 'couch', 'pouffe', 'canape', 'chic', 'footrest', 'add-to-cart'),
        ),
    );

    public $url;
    public $productId;
    public $name;
    public $imageUrl;
    public $price;
    public $listPrice;
    public $currencyCode;
    public $availability;
    public $categories = array();
    public $description;
    public $datePublished;
    public $brand;
    public $tags = array();

    public function load($version)
    {
        if (!isset(self::$data[$version])) {
            throw new \Exception(sprintf('Product does not have any data defined for Magento %s', $version));
        }
        foreach (self::$data[$version] as $property  => $value) {
            if ($property === 'url' || $property === 'imageUrl') {
                $value = self::$baseUrl.$value;
            }
            $this->{$property} = $value;
        }
    }
}
