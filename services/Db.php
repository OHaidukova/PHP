<?php
namespace app\services;

use app\traits\TraitSingleton;

class Db {
    private $config;
    
    private $conn = null;
//    private static $instance = null;
    
    public function __construct($driver, $host, $login, $password, $database, $charset) {
        
        $this->config['driver'] = $driver;
        $this->config['host'] = $host;
        $this->config['login'] = $login;
        $this->config['password'] = $password;
        $this->config['database'] = $database;
        $this->config['charset'] = $charset;
    }
    
    public function getConnection() {
        if(is_null($this->conn)) {
            $this->conn = new \PDO($this->prepareDsnString(),
                                  $this->config['login'],
                                  $this->config['password']);
        $this->conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
//            $this->conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
        };
        return $this->conn;
    }
    
    private function query($sql, $params = []) {
        $pdoStatement = $this->getConnection()->prepare($sql);
        $pdoStatement->execute($params);
//        var_dump($pdoStatement);
        return $pdoStatement;
    }
    
    public function queryOne($sql, $params = []) {
        return $this->queryAll($sql, $params)[0];
    }
      
    public function queryObject($sql, $params = [], $class) {
        $smtp = $this->query($sql, $params);
        $smtp->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class);
        return $smtp->fetch();
    }
    
    public function queryAll($sql, $params = []) {
        return $this->query($sql, $params)->fetchAll();
    }
    
    public function queryAllObject($sql, $class, $params = []) {
        $smtp = $this->query($sql, $params);
        $smtp->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class);
        return $smtp->fetchAll();
    }
    
    public function execute($sql, $params = []) {
        $this->query($sql, $params);
//        var_dump($params);
        return true;
    }
    
    public function lastInsertId() {
        return $this->getConnection()->lastInsertId();
    }
    
    private function prepareDsnString() {
        return sprintf("%s:host=%s; dbname=%s; charset=%s",
                      $this->config['driver'],
                      $this->config['host'],
                      $this->config['database'],
                      $this->config['charset']);
    }
}


?>