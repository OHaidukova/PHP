<?php
namespace app\models\repositories;
use app\models\entities\Order;

class OrderRepository extends Repository {
    
    public function getTableName(): string {
        return 'orders';
    }
    
    public function getEntityClass(): string {
        return Order::class;
    }
    
}

?>