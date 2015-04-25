<?php
/**
 * Copyright (c) 2015, "F. Lancer"
 * All rights reserved.
 */
/**
 * User: Alex Gusev <alex@flancer64.com>
 */
use Flancer32_PayPalApi_Config as Config;

include_once('../phpunit_bootstrap.php');

class Flancer32_PayPalApi_Test_Helper_Data_UnitTest extends PHPUnit_Framework_TestCase
{

    public function test_helper()
    {
        $cfg = Config::get();
        $helper = $cfg->helper();
        $this->assertTrue($helper instanceof Flancer32_PayPalApi_Helper_Data);
    }

    public function test_initClassLoader()
    {
        $cfg = Config::get();
        $helper = $cfg->helper();
        $this->assertTrue($helper instanceof Flancer32_PayPalApi_Helper_Data);
        $helper->initClassLoader();
        $address = new \PayPal\Api\Address();
        $this->assertTrue($address instanceof PayPal\Api\Address);
    }
}