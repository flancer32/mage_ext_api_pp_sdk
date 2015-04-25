<?php
/**
 * Copyright (c) 2015, "F. Lancer"
 * All rights reserved.
 */
use Flancer32_PayPalApi_Config as Config;

/**
 * User: Alex Gusev <alex@flancer64.com>
 */
class Flancer32_PayPalApi_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Init class loader to load PayPal classes from ./vendor/ catalog (composer scheme) or using path to SDK lib
     * directory.
     */
    public function initClassLoader()
    {
        $cfg = Config::get();
        $path = $cfg->sysPathToSdk();
        if ($path && is_dir($path)) {
            /* SDK should be loaded from external path */
            $this->_initClassLoaderFromCfgPath($path);
        } else {
            /* SDK should be loaded from composer's vendor directory */
            $this->_initClassLoaderFromVendor();
        }
    }

    /**
     * Add PayPal PHP SDK path to PHP include path.
     *
     * @param $path string absolute path to PayPal PHP SDK root.
     */
    private function _initClassLoaderFromCfgPath($path)
    {
        if (is_dir($path . DS . 'PayPal')) {
            $ini_set = ini_get('include_path') . PS . $path;
            ini_set('include_path', $ini_set);
        }
    }

    /**
     * Add class loader to load PayPal PHP SDK classes from./vendor/ directory.
     */
    private function _initClassLoaderFromVendor()
    {
        if (!class_exists('Composer\\Autoload\\ClassLoader', false)) {
            // Composer's vendor root folder
            $vendorRoot = 'vendor';
            // Autoloader file relative to the vendor folder.
            $autoloadFile = 'autoload.php';
            // Absolute path to magento root (.../mage/)
            $path = BP;
            // Clear cache for file_exists()
            clearstatcache();
            /* travers up to 32 levels to find ./vendor/autoload.php */
            for ($i = 0; $i < 32; $i++) {
                $pathToFile = $path . DS . $vendorRoot . DS . $autoloadFile;
                if (file_exists($pathToFile)) {
                    $varien = null;
                    $funcs = spl_autoload_functions();
                    /**
                     * un-register Varien_Autoload and re-register it after Composer autoload function registration
                     * as first function in queue.
                     */
                    /* find Varien_Autoload */
                    foreach ($funcs as $one) {
                        if (is_array($one) && $one[0] instanceof \Varien_Autoload) {
                            $varien = $one;
                            break;
                        }
                    }
                    /* un-register Varien_Autoload */
                    if ($varien) {
                        spl_autoload_unregister($varien);
                    }
                    /* register Composer autoload */
                    require_once($pathToFile);
                    /* register Varien_Autoload as first function in queue */
                    if ($varien) {
                        spl_autoload_register($varien, true, true);
                    }
                    break;
                } else {
                    $path = dirname($path);
                }
            }
        }
    }
}