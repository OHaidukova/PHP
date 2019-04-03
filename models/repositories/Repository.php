<?php
namespace app\models\repositories;
use app\services\Db;
use app\base\App;

class RepositoryException extends \Exception {}

abstract class Repository {
    protected $db;
    
    public function __construct() {
        $this->db = App::call()->db;
    }
    
    public function getOne(int $id) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return $this->db->queryObject($sql, ['id' => $id], $this->getEntityClass());
    }
    
    public function getFewItems($arrayKeys) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id IN ({$arrayKeys})";
        return $this->db->queryAll($sql, [], $this->getEntityClass());
    }
    
    public function getAll(): array {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->db->queryAllObject($sql, get_called_class());
    }
    
    public function find($sql, $params) {
        return $this->db->queryObject($sql, $params, $this->getEntityClass());
    }
    
        public function delete($entity) {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return $this->db->execute($sql, ['id' => $entity->id]);
    }
    
    public function insert($entity) {
        $tableName = $this->getTableName();
        
        $params = [];
        $columns = [];
        
        foreach ($entity as $key => $value) {
            if($key == 'db') {
                continue;
            };
            $params[":{$key}"] = $value;
            $columns[] = "`{$key}`";
        };
        
        $columns = implode(',', $columns);
        $placeholders = implode(',', array_keys($params));
        $sql = "INSERT INTO {$tableName} ({$columns}) VALUES ({$placeholders})";
        
        $this->db->execute($sql, $params);
        $entity->id = $this->db->lastInsertId();
    }
    
    public function update($entity) {
        $tableName = $this->getTableName();
        
        $productDb = $this->getOne($entity->id);
        
        $params = '';
        
        foreach($productDb as $key => $value) {
            if($key == 'db') {
                continue;
            };
            if($value != $entity->$key) {
                $params = $params . ' ' . "`{$key}` = '{$entity->$key}',";
            };
        };
        if(strlen($params)) {
            $params = substr($params, 0, -1);
            $sql = "UPDATE {$tableName} SET {$params} WHERE id = {$entity->id}";
            
            $this->db->execute($sql);
        };
    }
    
    public function save($entity) {
        $entity->id ? $this->update($entity) : $this->insert($entity);
    }
    
    abstract public function getTableName(): string;
    
    abstract public function getEntityClass(): string;
    
}



?>