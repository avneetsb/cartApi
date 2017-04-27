<?php

/**
 * Class to handle all Configuration Management functionality
 */
namespace App\Library;

/**
 * Class to handle all Configuration Management functionality
 *
 * @package cartApi
 * @author Avneet Singh Bindra <avneetbindra180691@gmail.com>
 */
class ConfigurationManager
{
    /**
     * Private variable, used to store Singleton Object of class
     * @var Object
     */
    private static $class;
    /**
     * Private variable, used to store get config params
     * @var Array
     */
    private static $config;

    /**
     * Defaut constructor used to initialize config array
     */
    private function __construct()
    {
        $this->config = array();
    }

    /**
     * Function used to get Singleton instance of current class
     */
    public static function getInstance()
    {

        if (self::$class == null) {
            self::$class = new ConfigurationManager();
        }
        return self::$class;
    }

    /**
     * Function used to load confuguration details from the App\Config directory
     * @param String $dir App\Config
     */
    public function load($dir)
    {
        $handle = opendir($dir);
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
                $arrayIndex                = substr($entry, 0, strpos($entry, '.php'));
                $this->config[$arrayIndex] = (include "$dir/$entry");
            }
        }
        closedir($handle);
        return $this->config;
    }

    /**
     * Function to get all config params array
     */
    public function all()
    {
        return $this->config;
    }

    /**
     * Function to extract spefic config params from config array
     * @param String $configName Config Parameters Name
     */
    public function get($configName)
    {
        if (array_key_exists($configName, $this->config)) {
            return $this->config[$configName];
        }
        return false;
    }

}
