<?php

use Core\AbstractController;
use Products\ProductsRepository;
use Users\UsersRepository;

class AdminController extends AbstractController {

    private $productsRepository;
    private $usersRepository;

    public function __construct(UsersRepository $usersRepository, ProductsRepository $productsRepository)
    {
        $this->usersRepository = $usersRepository;
        $this->productsRepository = $productsRepository;
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

    public function adminDashboard(){
        $authentication = $this->authentication();
        $products = $this->productsRepository->fetchNumber(10);
//        $orders = $this->ordersRepository->fetchAll();
//        $members = $this->membersRepository->fetchAll();
//        $balance = $this->balanceRepository->fetchAll();
//        $articles = $this->articlesRepository->fetchAll();
//        $images = $this->imagesRepository->fetchAll();

        $this->render("admin/dashboard", [
            'loggedIn' => $authentication,
            'products' => $products,
//            'orders' => $orders,
//            'members' => $members,
//            'balance' => $balance,
//            'articles' => $articles,
//            'images' => $images,
        ]);
    }
}