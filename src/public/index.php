<?php

require '../init.php';

$root = [
    '/' => [
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
    '/products' => [
        'controller' => 'controller',
        'methode' => 'products',
    ],
    '/shopping-cart' => [
        'controller' => 'controller',
        'methode' => 'shoppingCart',
    ],
    '/notFound' => [
        'controller' => 'controller',
        'methode' => 'notFound',
    ],
    '/fetchProducts' => [
        'controller' => 'controller',
        'methode' => 'fetchProducts',
    ],
    '/fetchShoppingCart' => [
        'controller' => 'controller',
        'methode' => 'fetchShoppingCart',
    ],
    '/admin/dashboard' => [
        'controller' => 'adminController',
        'methode' => 'adminDashboard'
    ],
    '/buy' => [
        'controller' => 'controller',
        'methode' => 'buy'
    ],
    '/ordered' => [
        'controller' => 'controller',
        'methode' => 'ordered'
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



