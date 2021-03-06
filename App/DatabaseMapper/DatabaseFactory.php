<?php

/**
 * Main Class, used to create DB instances for each Mapped DB Class
 */
namespace App\DatabaseMapper;

use PDO;

/**
 * Main Class, used to create DB instances for each Mapped DB Class
 *
 * @package cartApi
 * @author Avneet Singh Bindra <avneetbindra180691@gmail.com>
 */
class DatabaseFactory
{
    /**
     * Private variable, used to store Singleton Object of class
     * @var Object
     */
    private static $class;
    /**
     * Private variable, used to store connection using PDO
     * @var Object
     */
    private $connection;

    /**
     * Default constructor, get DB configuration and creates an instance of PHP PDO Object
     * @param Object $configurationManager Configuration Manager Object
     */
    private function __construct($configurationManager)
    {
        $mysqlConf = $configurationManager->get('database');

        $host   = $mysqlConf['mysql']['host'];
        $dbname = $mysqlConf['mysql']['database'];
        $dbuser = $mysqlConf['mysql']['user'];
        $dbpswd = $mysqlConf['mysql']['password'];

        $this->connection = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpswd);
    }

    /**
     * Function to get Singleton instance of current class
     * @param Object $configurationManager Configuration Manager Object
     */
    public static function getInstance($configurationManager)
    {

        if (self::$class == null) {
            self::$class = new DatabaseFactory($configurationManager);
        }
        return self::$class;
    }

    /**
     * Function to return Object of UserMap
     */
    public function getUserMap()
    {
        return new UserMap($this->connection);
    }

    /**
     * Function to return Object of CartMap
     */
    public function getCartMap()
    {
        return new CartMap($this->connection);
    }

    /**
     * Function to return Object of ItemMap
     */
    public function getItemMap()
    {
        return new ItemMap($this->connection);
    }
}
