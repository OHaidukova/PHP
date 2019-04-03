<?php
namespace app\models\repositories;
use app\models\entities\Basket;

class BasketRepository extends Repository {
    
    public function getTableName(): string {
        return 'products';
    }
    
    public function getEntityClass(): string {
        return Basket::class;
    }
    
}

?>