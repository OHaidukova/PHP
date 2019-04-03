<?php
namespace app\base;
//use app\base\Storage;
use app\services\Db;
use app\services\Request;
use app\traits\TraitSingleton;
use app\interfaces\IRenderer;

class App {
    use TraitSingleton;
    
    public $config;
    private $components;
    
    public static function call() {
        return static::getInstance();
    }
    
    public function run($config) {
        session_start();
        $this->config = $config;
        $this->components = new Storage();
        $this->runController();
    }
    
    private function runController() {
        $controllerName = $this->request->getControllerName() ? $this->request->getControllerName() : $this->config['defaultController'];
        $action = $this->request->getActionName() ? $this->request->getActionName() : null;
        
        $controllerClass = $this->config['controllersNamespace'] . "\\" . ucfirst($controllerName) . "Controller";
        if(class_exists($controllerClass)) {
            $controller = new $controllerClass($this->templateRenderer);
            $controller->run($action);
        }
    }
    
    public function createComponent($name) {
        if(isset($this->config['components'][$name])) {
            $params = $this->config['components'][$name];
            $class = $params['class'];
            if(class_exists($class)) {
               $reflection = new \ReflectionClass($class);
                // Don't convey 'class' as parameter
                unset($params['class']);
                //newInstanceArgs - create object
                return $reflection->newInstanceArgs($params);
            }
            throw new \Exception("Class doesn't exists!");
        }
        throw new \Exception("Componet doesn't exist!");
    }
    
    function __get($name) {
        return $this->components->get($name);
    }
    
}

?>