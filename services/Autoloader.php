<?php
namespace app\services;

class Autoloader {
    
    public $fileExtention = '.php';
    
    public function loadClass($className) {
        
        $fileName = str_replace(["app\\", "\\"], [ROOT_DIR, DS], $className);
        $fileName .= $this->fileExtention;

        if(file_exists($fileName)) {
               include $fileName;
       }
    }
}


?>