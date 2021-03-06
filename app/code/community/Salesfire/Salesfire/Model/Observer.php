<?php

/**
 * Salesfire observer
 *
 * @category   Salesfire
 * @package    Salesfire_Salesfire
 * @version.   1.2.8
 */
class Salesfire_Salesfire_Model_Observer extends Varien_Event_Observer
{
    /**
     * This an observer function for the event 'controller_front_init_before'.
     * It prepends our autoloader, so we can load the extra libraries.
     *
     * @param Varien_Event_Observer $observer
     */
    public function controllerFrontInitBefore(Varien_Event_Observer $observer)
    {
        spl_autoload_register(array($this, 'load'), true, true);
    }

    /**
     * This function can autoloads classes starting with:
     * - Salesfire\Salesfire
     *
     * @param string $class
     */
    public static function load($class)
    {
        if (preg_match('#^(Salesfire\\\\)\b#', $class)) {
            $phpFile = Mage::getBaseDir('lib') . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, array('Salesfire', 'Salesfire', 'src')) . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, preg_replace('/^Salesfire\\\\/i', '', $class)) . '.php';

            require_once($phpFile);
        }
    }
}
