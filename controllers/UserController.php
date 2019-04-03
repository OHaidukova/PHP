<?php
namespace app\controllers;
use app\models\repositories\UserRepository;
use app\models\entities\User;

class UserController extends Controller{
    private $useLayout = false;
    
    public function actionIndex() {
        $this->useLayout = true;
        $userId = $_SESSION['user_id'] ?? null;
//        var_dump($_SESSION,  $userId);
        
        if($userId) {
            $userId = (int) $userId;
            try {
                $user = (new UserRepository())->getOne($userId);
//                 var_dump($user);
            } catch (\Exception $e) {
                $error = 'User not found';
                $this->useLayout = false;
                echo $this->render('errors', ['errors' => $error], $this->useLayout);
                exit;
            };
            if(!$user) {
            throw new \Exception("User not found");
            };
            
            echo $this->render('user', ['user' => $user], $this->useLayout);
        } else{
            $message = '';
            echo $this->render('form', ['message' => $message], $this->useLayout);
        }
    } 
    
    public function actionSign() {
        $message = '';
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $login = $_POST['name'];
            $pass = $_POST['password'];
            $user = (new UserRepository())->getUserByLoginPass($login, $pass);
            if($user) {
                $_SESSION['user_id'] = $user['id'];
                echo $this->render('user', $user, $this->useLayout);
            } else {
                $message = 'Wrong data';
                echo render('form', ['message' => $message]); 
            };
        };
        
    }
    
}

?>