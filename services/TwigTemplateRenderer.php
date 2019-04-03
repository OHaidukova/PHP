<?php
namespace app\services;
use app\interfaces\IRenderer;
use Twig_Environment;
use Twig_Loader_Filesystem;


class TwigTemplateRenderer implements IRenderer{
    protected $loader;
    protected $twig;
    
    public function __construct() {
        $this->loader = new Twig_Loader_Filesystem(TEMPLATES_DIR);
        $this->twig = new Twig_Environment($this->loader);
    }
    
    public function render($template, $params = []) {
//        ob_start();
//        extract($params);
//        $templatePath = TEMPLATES_DIR . $template . '.html';
//        include $templatePath;
//        return ob_get_clean();

        $templateTwig = $this->twig->load($template . '.html');
//        var_dump($params);
        return $templateTwig->render($params);
    }
    
}



?>