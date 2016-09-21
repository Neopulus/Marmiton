<?php

namespace Core\Database;
use \PDO;

/**
 * Class Database
 * Permet la connextion a la database, la preparation et execution des requets SQL, et l'accès au dernier ID insérer
 */
class Database
{
    
    private $db_name;
    private $db_user;
    private $db_pass;
    private $db_host;
    private $pdo;

    /**
     * Database constructor.
     * @param $db_name
     * @param string $db_user
     * @param string $db_pass
     * @param string $db_host
     */
    public function __construct($db_name = null, $db_user, $db_pass, $db_host){
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_host = $db_host;
    }

    /**
     * Connexion a la base de donnée et stocker le PDO dans une instance $pdo
     * @return PDO
     */
    private function getPDO()
    {
        if($this->pdo === null)
        {
            $pdo = new PDO("mysql:host=". $this->db_host ."; dbname=" . $this->db_name, $this->db_user, $this->db_pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        }
        return $this->pdo;
    }

    /**
     * Exécute une requête SQL et retourne un jeu de résultats en tant qu'objet PDOStatement (Représente
     * une requête préparée et, une fois exécutée, le jeu de résultats associé)
     * @param $statement
     * @param null $class_name
     * @param bool|false $one
     * @return array|mixed|\PDOStatement
     */
    public function query($statement, $class_name = null, $one = false)
    {
        $req = $this->getPDO()->query($statement);
        if (strpos($statement, "UPDATE") === 0 ||
            strpos($statement, "INSERT") === 0 ||
            strpos($statement, "DELETE") === 0)
        {
            return $req;
        }
        if($class_name === null)
        {
            $req->setFetchMode(PDO::FETCH_OBJ);
        }
        else
        {
            $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
        }
        if($one)
        {
            $data = $req->fetch();
        }
        else
        {
            $data = $req->fetchAll();
        }
        return $data;
    }

    /*
     * TEST BUG QUERY 1
     */
    public function query2($statement)
    {
        return ($this->getPDO()->query($statement));
    }

    /**
     * Prépare une requête à l'exécution et retourne un objet
     * @param $statement
     * @param $attributes
     * @param null $class_name
     * @param $one
     * @return array|bool|mixed
     */
    public function prepare($statement, $attributes, $class_name = null, $one)
    {
        $req = $this->getPDO()->prepare($statement);
        $res = $req->execute($attributes);
        if (strpos($statement, "UPDATE") === 0 ||
            strpos($statement, "INSERT") === 0 ||
            strpos($statement, "DELETE") === 0)
        {
            return $res;
        }
        if($class_name === null)
        {
            $req->setFetchMode(PDO::FETCH_OBJ);
        }
        else
        {
            $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
        }
        if($one)
        {
            $data = $req->fetch();
        }
        else
        {
            $data = $req->fetchAll(PDO::FETCH_OBJ);
        }
        return $data;
    }

    public function getLastId()
    {
        return $this->getPDO()->lastInsertId();
    }

}