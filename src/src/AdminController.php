<?php

use Articles\ArticlesRepository;
use Checkouts\CheckoutsRepository;
use Core\AbstractController;
use Images\ImagesRepository;
use Locations\LocationsRepository;
use Members\MembersRepository;
use Orders\OrdersRepository;
use Products\ProductsRepository;
use Users\UsersRepository;

class AdminController extends AbstractController {

    private $productsRepository;
    private $usersRepository;
    private $articlesRepository;
    private $checkoutsRepository;
    private $locationsRepository;
    private $ordersRepository;
    private $membersRepository;

    public function __construct(UsersRepository $usersRepository, ProductsRepository $productsRepository, MembersRepository $membersRepository, ArticlesRepository $articlesRepository, LocationsRepository $locationsRepository, OrdersRepository $ordersRepository, CheckoutsRepository $checkoutsRepository)
    {
        $this->usersRepository = $usersRepository;
        $this->productsRepository = $productsRepository;
        $this->articlesRepository = $articlesRepository;
        $this->checkoutsRepository = $checkoutsRepository;
        $this->locationsRepository =  $locationsRepository;
        $this->ordersRepository =  $ordersRepository;
        $this->membersRepository = $membersRepository;
    }

    // FIXME can I move/leave this in Container?
    public function authentication(){
        if (session_status() === 1) {
            session_start();
        }
        if(isset($_SESSION['userid'])) {
            $result = $this->usersRepository->fetch($_SESSION['userid']);
            if(!$result){
                return false;
            }else{
                return $result;
            }
        }
        else {
            return false;
        }
    }

    public function memberAuthentication(){
        if (session_status() === 1) {
            session_start();
        }
        if(isset($_SESSION['userid'])) {
            $result = $this->membersRepository->fetchByUserID($_SESSION['userid']);
            if(!$result){
                return false;
            }else{
                return $result;
            }
        }
        else {
            return false;
        }
    }

    public function adminDashboard(){
        $authentication = $this->memberAuthentication();
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
        $authentication = $this->memberAuthentication();

        if(!$authentication){
            header("Location: /login");
            exit();
        }
        header("Location: /admin/dashboard");
    }
}