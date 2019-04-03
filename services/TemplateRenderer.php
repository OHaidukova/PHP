<?php
namespace app\services;
use app\interfaces\IRenderer;
use app\base\App;

class TemplateRenderer implements IRenderer {
    
    public function render($template, $params = []) {
        ob_start();
//        var_dump($params);
        extract($params);
        $templatePath = App::call()->config['templatesDir'] . $template . '.php';
        include $templatePath;
        return ob_get_clean();
    }
    
}



?>