<?php

use Articles\ArticlesRepository;
use Authentication\AuthenticationRepository;
use Checkouts\CheckoutsRepository;
use Core\AbstractController;
use Images\ImagesRepository;
use Locations\LocationsRepository;
use Members\MembersRepository;
use Orders\OrdersRepository;
use Products\ProductsRepository;
use ShoppingCart\ShoppingCartRepository;
use Users\UsersRepository;

class AdminController extends AbstractController {

    private $productsRepository;
    private $usersRepository;
    private $articlesRepository;
    private $checkoutsRepository;
    private $locationsRepository;
    private $ordersRepository;
    private $membersRepository;
    private $authenticationRepository;
    private $shoppingCartRepository;

    public function __construct(UsersRepository $usersRepository, ProductsRepository $productsRepository, MembersRepository $membersRepository, ArticlesRepository $articlesRepository, LocationsRepository $locationsRepository, OrdersRepository $ordersRepository, CheckoutsRepository $checkoutsRepository, AuthenticationRepository $authenticationRepository, ShoppingCartRepository $shoppingCartRepository)
    {
        $this->usersRepository = $usersRepository;
        $this->productsRepository = $productsRepository;
        $this->articlesRepository = $articlesRepository;
        $this->checkoutsRepository = $checkoutsRepository;
        $this->locationsRepository =  $locationsRepository;
        $this->ordersRepository =  $ordersRepository;
        $this->membersRepository = $membersRepository;
        $this->authenticationRepository = $authenticationRepository;
        $this->shoppingCartRepository = $shoppingCartRepository;
    }

    public function adminDashboard(){
        $authentication = $this->authenticationRepository->memberAuthentication();
        if(!$authentication){
            header("Location: /login");
            exit();
        }

        $products = $this->productsRepository->fetchNumber(10);
        $orders = $this->ordersRepository->fetchNumber(5);
//        $members = $this->membersRepository->fetchAll();
//        $balance = $this->balanceRepository->fetchAll();
//        $articles = $this->articlesRepository->fetchAll();
//        $images = $this->imagesRepository->fetchAll();

        $this->render("admin/dashboard", [
            'loggedIn' => $authentication,
            'products' => $products,
            'orders' => $orders,
//            'members' => $members,
//            'balance' => $balance,
//            'articles' => $articles,
//            'images' => $images,
        ]);
    }

    public function admin(){
        $authentication = $this->authenticationRepository->memberAuthentication();

        if(!$authentication){
            header("Location: /login");
            exit();
        }
        header("Location: /admin/dashboard");
    }
}