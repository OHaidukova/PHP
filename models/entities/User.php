<?php
namespace app\models\entities;
use app\models\entities\DataEntity;

class User extends DataEntity{
    public $id;
    public $name;
    public $password;
    
    public function __construct($id = null, $name = null, $password = null) {
    $this->id = $id;
    $this->name = $name;
    $this->password = $password;
    }
    


}

?>