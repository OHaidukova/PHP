<?php
namespace app\models\entities;
use app\models\entities\DataEntity;

class Product extends DataEntity{
    public $id;
    public $name;
    public $addr_max_img;
    public $addr_min_img;
    public $price;
    public $description;
    
    public function __construct($id = null, $name = null, $addr_max_img = null, $addr_min_img = null, $price = null, $description = null) {
    $this->id = $id;
    $this->name = $name;
    $this->addr_max_img = $addr_max_img;
    $this->addr_min_img = $addr_min_img;
    $this->price = $price;
    $this->description = $description;
    }


}


?>