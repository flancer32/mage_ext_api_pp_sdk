<?php
/**
 * Copyright (c) 2015, "F. Lancer""
 * All rights reserved.
 */

/**
 * Package top level class - contains hardcoded configuration (constants) and provides easy access to the module's main
 * entities.
 *
 * User: Alex Gusev <alex@flancer64.com>
 */
class Flancer32_PayPalApi_Config
{
    /**
     * Itself. Singleton.
     * We should not use static methods (bad testability).
     *
     * @var Flancer32_PayPalApi_Config
     */
    private static $_instance;

    /**
     * Get singleton instance.
     *
     * @return Flancer32_PayPalApi_Config
     */
    public static function  get()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Flancer32_PayPalApi_Config();
        }
        return self::$_instance;
    }

    /**
     * Returns default helper for the module.
     *
     * @return Flancer32_PayPalApi_Helper_Data
     */
    public function helper()
    {
        return Mage::helper('flancer32_ppapi_helper');
    }

    /**
     * Get path to PayPal PHP SDK from system configuration.
     *
     * @param null $store
     * @return string
     */
    public function sysPathToSdk($store = null)
    {
        $result = (string)Mage::getStoreConfig('dev/flancer32_ppapi/path', $store);
        return $result;
    }
}