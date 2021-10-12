<?php

require '../init.php';

$root = [
    '/' => [
        'controller' => 'controller',
        'methode' => 'home',
    ],
    '/about' => [
        'controller' => 'controller',
        'methode' => 'about',
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
    '/buy' => [
        'controller' => 'controller',
        'methode' => 'buy'
    ],
    '/ordered' => [
        'controller' => 'controller',
        'methode' => 'ordered'
    ],
    '/admin' => [
        'controller' => 'adminController',
        'methode' => 'admin'
    ],
    '/admin/dashboard' => [
        'controller' => 'adminController',
        'methode' => 'adminDashboard'
    ],
    '/admin/orders' => [
        'controller' => 'adminController',
        'methode' => 'adminOrders'
    ],
    '/admin/orders/show' => [
        'controller' => 'adminController',
        'methode' => 'adminOrdersShow'
    ],
    '/admin/products' => [
        'controller' => 'adminController',
        'methode' => 'adminProducts'
    ],
    '/admin/products/add' => [
        'controller' => 'adminController',
        'methode' => 'adminProductsAdd'
    ],
    '/admin/products/edit' => [
        'controller' => 'adminController',
        'methode' => 'adminProductsEdit'
    ],
    '/admin/members' => [
        'controller' => 'adminController',
        'methode' => 'adminMembers'
    ]
];

if (isset($_SERVER['PATH_INFO'])) {

    $pathInfo = $_SERVER['PATH_INFO'];

    if (!isset($root[$pathInfo])) {
        $pathInfo = '/notFound';
    }


} else {
    // dirty workaround for missing PATH_INFO
    if (isset($_SERVER['DOCUMENT_URI']) && isset($_SERVER['SCRIPT_NAME'])) {
        $pathInfo = substr($_SERVER['DOCUMENT_URI'], strlen($_SERVER['SCRIPT_NAME']));

        if (!isset($root[$pathInfo])) {
            $pathInfo = '/notFound';
        }
    } else {
        $pathInfo = '/notFound';
    }
}


$container = new \Core\Container();
$controller = $container->make($root[$pathInfo]['controller']);
$methode = $root[$pathInfo]['methode'];
$controller->$methode();



