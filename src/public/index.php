<?php

require '../init.php';

$root = [
    '/home' => [
        'controller' => 'controller',
        'methode' => 'home',
    ],
    '/login' => [
        'controller' => 'controller',
        'methode' => 'login',
    ],
    '/registration' => [
        'controller' => 'controller',
        'methode' => 'registration',
    ],
    '/logout' => [
        'controller' => 'controller',
        'methode' => 'logout',
    ],
    '/show' => [
        'controller' => 'controller',
        'methode' => 'show',
    ],
    '/shopping-cart' => [
        'controller' => 'controller',
        'methode' => 'shoppingCart',
    ],
    '/notFound' => [
        'controller' => 'controller',
        'methode' => 'notFound',
    ],
    '/fetchShoppingCart' => [
        'controller' => 'controller',
        'methode' => 'fetchShoppingCart',
    ]
];

if(isset($_SERVER['PATH_INFO'])){

    $pathInfo = $_SERVER['PATH_INFO'];

    if(!isset($root[$pathInfo])){
        $pathInfo = '/notFound';
    }


}else{
    $pathInfo = '/notFound';
}


$container = new \Core\Container();
$controller = $container->make($root[$pathInfo]['controller']);
$methode = $root[$pathInfo]['methode'];
$controller->$methode();



