<?php

use Core\Config;
use Core\Database\Database;

class App
{

    public $title = "Marmiton";
    private $db_instance;
    private static $_instance;

    public static function getInstance()
    {
        if(is_null(self::$_instance))
        {
            self::$_instance = new App();
        }
        return self::$_instance;
    }

    /**
     * Function pour incluer les 2 autoloader dans le /app et /core
     */
    public static function load()
    {
        session_start();
        require ROOT . '/app/Autoloader.php';
        App\Autoloader::register();
        require ROOT . '/core/Autoloader.php';
        Core\Autoloader::register();
    }

    /**
     * Recuper la base de donnée
     * @return Database
     */
    public function getDB()
    {
        $config = Config::getInstance(ROOT . '/config/config.php');
        if(is_null($this->db_instance))
        {
            $this->db_instance = new Database($config->get('db_name'), $config->get('db_user'), $config->get('db_pass'), $config->get('db_host'));
        }
        return $this->db_instance;
    }

    /**
     * Recuper le model (la Table)
     * @param $name
     * @return mixed
     */
    public function getTable($name)
    {
        $class_name = '\\App\\Model\\' .ucfirst($name) . 'Model';
        return new $class_name($this->getDB());
    }

}
