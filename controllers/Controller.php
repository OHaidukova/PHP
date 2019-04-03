<?php
namespace app\controllers;
use app\interfaces\IRenderer;

abstract class Controller {
        
    private $action;
    private $defaultAction = 'Index';
    private $layout = 'main';
    private $renderer;
    
    public function __construct(IRenderer $renderer) {
       
            $this->renderer = $renderer;
    }
    
    public function run($action = null) {
        $this->action = isset($action) ? $action : $this->defaultAction;
        $method = "action" . ucfirst($this->action);

        if(method_exists($this, $method)) {
            $this->$method();
        } else {
            echo "404";
        }
    }
    
    protected function render($template, $params = [], $useLayout) {
        if($useLayout) {
            $content = $this->renderTemplate($template, $params);
            return $this->renderTemplate("layouts/{$this->layout}", ['content' => $content]);
        } else return $this->renderTemplate($template, $params);
    }
    
    protected function renderTemplate($template, $params = []) {
        
        return $this->renderer->render($template, $params);

    }
}


?>