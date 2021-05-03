<?php

require '../init.php';

$root = [
    '/home' => [
        'controller' => 'productsController',
        'methode' => 'home',
    ],
    '/show' => [
        'controller' => 'productsController',
        'methode' => 'show',
    ]
];

$pathInfo = $_SERVER['PATH_INFO'];

$container = new \Core\Container();
$controller = $container->make($root[$pathInfo]['controller']);

$methode = $root[$pathInfo]['methode'];
$controller->$methode();



