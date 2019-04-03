<?php
namespace app\controllers;
use app\models\repositories\BasketRepository;
use app\models\entities\Basket;

class BasketController extends Controller{
    private $useLayout = false;
    
    public function actionIndex() {
        $this->useLayout = true;
        $productsBasket = [];
        if (!empty($_SESSION['basket'])) {
            $arrayKeys = implode(",", array_keys($_SESSION['basket']));
//            var_dump($_SESSION['basket']);
            $productsBasket = (new BasketRepository())->getFewItems($arrayKeys);
        };
//       var_dump($productsBasket);
        echo $this->render('basket', $productsBasket, $this->useLayout);
    }
    
    public function actionAddToBasket() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = (int) $_POST['id'];
        $number = (int) $_POST['number'];
    
        if(isset($_SESSION['basket'][$id])) {
            $_SESSION['basket'][$id] = $_SESSION['basket'][$id] + $number;
        } else $_SESSION['basket'][$id] = $number;
//            var_dump($_SESSION['basket']);
        echo json_encode(['success' => 'ok', 'message' => 'Product added to basket']);
        
        }
    }
    
        public function actionDeleteFromBasket() {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $id = (int) $_POST['id'];
              
                if(isset($_SESSION['basket'][$id])) {
                unset($_SESSION['basket'][$id]);
                };
            echo json_encode(['success' => 'ok', 'message' => 'Product deleted from basket']);
        };

    }
}

?>