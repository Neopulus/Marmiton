<?php

namespace Core\Model;
use App\App;
use Core\Database\Database;

class Model
{
    
    protected $table;
    protected $db;

    /**
     * Model constructor.
     * @param Database $db
     */
    public function __construct(Database $db)
    {
        $this->db = $db;
        if(is_null($this->table))
        {
            $parts = explode('\\', get_class($this));
            $class_name = end($parts);
            $this->table = strtolower(str_replace('Model', '', $class_name)) .'s';
        }
    }

    /**
     * @return array|mixed|\PDOStatement
     */
    public function all()
    {
        return json_encode($this->query('SELECT * FROM ' .$this->table));
    }

    public function getLastId()
    {
        return $this->db->getLastId();
    }

    /**
     * @param $key
     * @param $value
     * @return array
     */
    public function extract($key, $value)
    {
        $records = $this->all();
        $return = [];
        foreach ($records as $v)
        {
            $return[$v->$key] = $v->$value;
        }
        return $return;
    }

    /**
     * @param $statement
     * @param null $class_name
     * @param bool $one
     * @return array|mixed|\PDOStatement
     */
    public function query($statement, $class_name = null, $one = false)
    {
        return $this->db->query($statement, $class_name, $one);
    }

    public function query2($statement)
    {
        return $this->db->query2($statement);
    }
}