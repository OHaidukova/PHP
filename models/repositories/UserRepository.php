<?php
namespace app\models\repositories;
use app\models\entities\User;

class UserRepository extends Repository {
    
    public function getTableName(): string {
        return 'users';
    }
    
    public function getEntityClass(): string {
        return User::class;
    }
    
    public function getUserByLoginPass($login, $pass) {
        return $this->find("SELECT * FROM users WHERE name = '{$login}' AND password = '{$pass}'", []);
    }
    
}

?>