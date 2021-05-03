<?php

namespace Core;

use PDO;
use Products\ProductsController;
use Products\ProductsRepository;

class Container{

    private $recipes = [];
    private $instances = [];

    public function __construct(){
        $this->recipes = [
            'productsController' => function (){
            return new ProductsController($this->make('productsRepository'));
            },
            'productsRepository' => function () {
            return new ProductsRepository($this->make('pdo'));

            },
            'pdo' => function () {
            return require __DIR__ . '/Database/databaseConnection.php';
            }
        ];
    }

    public function make($name){
        if(empty($this->instances[$name]) && isset($this->recipes[$name])){
            $this->instances[$name] = $this->recipes[$name]();
        }
        return $this->instances[$name];
    }

}