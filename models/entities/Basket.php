<?php
namespace app\models\entities;
use app\models\entities\DataEntity;

class Basket extends DataEntity{
    public $id;
    public $name;
    public $addr_min_img;
    public $price;
    
    
    public function __construct($id = null, $name = null, $addr_min_img = null, $price = null) {
    $this->id = $id;
    $this->name = $name;
    $this->price = $price;
    $this->addr_min_img = $addr_min_img;
    }
    
    

}


?>