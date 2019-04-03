<?php
namespace app\services;

class Request {
    
    private $controllerName;
    private $actionName;
    private $params;
    private $requestString;
    private $requestMethod;
    
    public function __construct() {
        $this->requestString = $_SERVER['REQUEST_URI'];
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
        $this->parseRequest();
    }
    
    private function parseRequest() {
        $pattern = "#(?P<controller>\w+)[/]?(?P<action>\w+)?[/]?[?]?(?P<params>.*)#ui";
        if(preg_match_all($pattern, $this->requestString, $matches)) {
            $this->controllerName = $matches['controller'][0];
            $this->actionName = $matches['action'][0];
            $this->params = $_REQUEST;
        }
    }
    
    public function getControllerName() {
        
        
        return $this->controllerName;
    }
    
     public function getActionName() {
        
        
        return $this->actionName;
    }
    
     public function getParams($name = null) {  
        if($name){
            return $this->params[$name];
        }
        return $this->params;
    }
    
    public function getRequestMethod()
    {
        return $this->requestMethod;
    }

    public function isGet()
    {
        return $this->requestMethod == "GET";
    }

    public function isPost()
    {
        return $this->requestMethod == "POST";
    }
    
}


?>