<?php
/**
 * Copyright (c) 2015, "F. Lancer"
 * All rights reserved.
 */
/**
 * User: Alex Gusev <alex@flancer64.com>
 */
use Flancer32_PayPalApi_Config as Config;

include_once('phpunit_bootstrap.php');

class Flancer32_PayPalApi_Test_Config_UnitTest extends PHPUnit_Framework_TestCase {

    public function test_cfg() {
        $cfg = Config::get();
        $this->assertTrue($cfg->helper() instanceof Flancer32_PayPalApi_Config);
    }
}