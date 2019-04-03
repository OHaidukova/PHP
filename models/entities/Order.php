<?php
namespace app\models\entities;
use app\models\entities\DataEntity;

class Order extends DataEntity{
    public $order_id;
    public $address;
    
    public function __construct($order_id = null, $address = null) {
    parent::__construct();
    $this->order_id = $order_id;
    $this->address = $address;
    }
    
    

}


?>