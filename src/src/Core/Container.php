<?php

namespace Core;

use Articles\ArticlesRepository;
use Checkouts\CheckoutsRepository;
use Locations\LocationsRepository;
use Orders\OrdersRepository;
use PDO;
use Controller;
use AdminController;
use Products\ImagesProductsRepository;
use Images\ImagesRepository;
use Products\ProductsRepository;
use Users\UsersRepository;

class Container{

    private $recipes = [];
    private $instances = [];

    public function __construct(){
        $this->recipes = [
            'controller' => function (){
                return new Controller($this->make('usersRepository'),$this->make('productsRepository'), $this->make('imagesProductsRepository') , $this->make('articlesRepository'), $this->make('checkoutsRepository'), $this->make('locationsRepository'), $this->make('ordersRepository'));
            },
            'adminController' => function (){
                return new AdminController($this->make('usersRepository'),$this->make('productsRepository'));
            },
            'usersRepository' => function () {
                return new UsersRepository($this->make('pdo'));

            },
            'imagesRepository' => function () {
                return new ImagesRepository($this->make('pdo'));

            },
            'imagesProductsRepository' => function () {
                return new ImagesProductsRepository($this->make('pdo'), $this->make('imagesRepository'));

            },
            'articlesRepository' => function () {
            return new ArticlesRepository($this->make('pdo'));

            },
            'checkoutsRepository' => function () {
                return new CheckoutsRepository($this->make('pdo'));

            },
            'locationsRepository' => function () {
                return new LocationsRepository($this->make('pdo'));

            },
            'ordersRepository' => function () {
                return new OrdersRepository($this->make('pdo'));

            },
            'productsRepository' => function () {
                return new ProductsRepository($this->make('pdo'), $this->make('imagesProductsRepository'));

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