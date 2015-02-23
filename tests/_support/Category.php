<?php

namespace Codeception\Module;

class Category
{
    public static $baseUrl;
    public static $data = array(
        '1.8.1.0' => array(
            'url' => 'index.php/electronics/computers.html',
            'name' => '/Electronics/Computers',
        ),
    );

    public $url;
    public $name;

    public function load($version)
    {
        if (!isset(self::$data[$version])) {
            throw new \Exception(sprintf('Category does not have any data defined for Magento %s', $version));
        }
        foreach (self::$data[$version] as $property  => $value) {
            if ($property === 'url') {
                $value = self::$baseUrl.$value;
            }
            $this->{$property} = $value;
        }
    }
}
