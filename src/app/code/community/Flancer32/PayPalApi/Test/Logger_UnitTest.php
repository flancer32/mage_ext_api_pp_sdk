<?php
/**
 * Copyright (c) 2015, "F. Lancer"
 * All rights reserved.
 */
/**
 * User: Alex Gusev <alex@flancer64.com>
 */

include_once('phpunit_bootstrap.php');

class Flancer32_PayPalApi_Test_Logger_UnitTest extends PHPUnit_Framework_TestCase {

    public function test_logger() {
        $log = Flancer32_PayPalApi_Logger::getLogger(__CLASS__);
        $this->assertTrue($log instanceof Flancer32_PayPalApi_Logger);
        $log->trace('trace level message');
        $log->debug('debug level message');
        $log->info('info level message');
        $log->warn('warn level message');
        $log->error('error level message');
        $log->fatal('fatal level message');
    }
}