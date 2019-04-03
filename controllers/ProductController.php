<?php
namespace app\controllers;
use app\base\App;
use app\models\repositories\ProductRepository;
use app\models\entities\Product;

class ProductController extends Controller{
    private $useLayout = false;
    
    public function actionIndex() {
        $this->useLayout = true;
        $products = (new ProductRepository())->getAll();
        echo $this->render('catalog', $products, $this->useLayout);
    }
    
    public function actionCard() {
        $this->useLayout = true;
        $id = App::call()->request->getParams('id');
        $id = (int) $id;
//        var_dump($id);
        try {
            $product = (new ProductRepository())->getOne($id);
//            var_dump($product);
        } catch (\Exception $e) {
            $error = 'Product not found';
            $this->useLayout = false;
            echo $this->render('errors', ['errors' => $error], $this->useLayout);
            exit;
        };
        
        if(!$product) {
            throw new \Exception("Product not found");
        };
        
        echo $this->render('card', ['product' => $product], $this->useLayout);
    }
    
    
}

?>