<?php

namespace Core;

use PDO;
use Controller;
use AdminController;
use Products\ProductsRepository;
use Users\UsersRepository;

class Container{

    private $recipes = [];
    private $instances = [];

    public function __construct(){
        $this->recipes = [
            'controller' => function (){
                return new Controller($this->make('usersRepository'),$this->make('productsRepository'));
            },
            'adminController' => function (){
                return new AdminController($this->make('usersRepository'),$this->make('productsRepository'));
            },
            'usersRepository' => function () {
                return new UsersRepository($this->make('pdo'));

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