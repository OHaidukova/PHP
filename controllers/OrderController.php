<?php
namespace app\controllers;
use app\models\repositories\OrderRepository;
use app\models\entities\Order;

class OrderController extends Controller{
    private $useLayout = false;
    
    public function actionIndex() {
        $userId = $_SESSION['user_id'] ?? null;
        
        if($userId) {
            $userId = (int) $userId;
            $this->useLayout = true;
            $orders = (new OrderRepository())->getAll();
            echo $this->render('orders', $orders, $this->useLayout);
        };
    }
    
    public function actionCreateOrder() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $address = $_POST['address'];
            
            if(isset($_SESSION['basket'])) {
                if(isset($_SESSION['user_id'])) {
                    $userId = $_SESSION['user_id'];
                    var_dump($_SESSION['basket']);
                };
            };
        };
    }
    
}

?>