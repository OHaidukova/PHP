<?php
return [
    'DS' => DIRECTORY_SEPARATOR,
    'rootDir' => __DIR__ . "/../",
    'templatesDir' => __DIR__ . "/../views/",
    'defaultController' => 'product',
    'controllersNamespace' => "app\\controllers",
    'components' =>[
        'db' => [
        'class' =>\app\services\Db::class,
        'driver' => 'mysql',
        'host' => 'localhost',
        'login' => 'root',
        'password' => '',
        'database' => 'project',
        'charset' => 'utf8'
        ],
        'request' => [
        'class' =>\app\services\Request::class  
        ],
        'templateRenderer' => [
        'class' =>\app\services\TemplateRenderer::class
        ]
    ]
];

?>