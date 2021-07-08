<?php

use Core\AbstractController;
use Products\ImagesProductsRepository;
use Products\ProductsRepository;
use Users\UsersRepository;

class Controller extends AbstractController {

    private $productsRepository;
    private $usersRepository;
    private $imagesProductRepository;

    public function __construct(UsersRepository $usersRepository, ProductsRepository $productsRepository, ImagesProductsRepository $imagesProductRepository)
    {
        $this->usersRepository = $usersRepository;
        $this->productsRepository = $productsRepository;
        $this->imagesProductRepository = $imagesProductRepository;
    }

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

    public function home(){
        $authentication = $this->authentication();

        $products = $this->productsRepository->fetchNumber(3);
        foreach ($products as $product){
            $product_ID = $product->product_ID;
            $product->images = $this->imagesProductRepository->fetchByProductID($product_ID);
        }

        $this->render("home", [
            'loggedIn' => $authentication,
            'products' => $products
        ]);
    }

    public function login(){;
        $this->authentication();

        $message = null;
        if (isset($_GET['login'])) {
            if (isset($_POST['email']) && isset($_POST['password'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $result = $this->usersRepository->login($email, $password);

                if ($result) {
                    header("Location: home");
                } else {
                    $message = 'Email or Password wrong!';
                }

            } else {
                $message = 'Please enter email and password!';
            }
        }

        $this->render("user/login", [
            'message' => $message
        ]);

    }

    public function registration(){

        $infoMessage = null;
        $errorMessage = null;

        if(isset($_GET['register'])) {
            $error = false;

            $user = new Users\UserModel();

            $user->email = $_POST['email'];
            $user->password = $_POST['password'];
            $password2 = $_POST['password2'];

            $user->forename = $_POST['forename'];
            $user->surname = $_POST['surname'];

            $user->street = $_POST['street'];
            $user->street_number = $_POST['number'];
            $user->postcode = $_POST['postcode'];
            $user->city = $_POST['city'];


            if(strlen($user->email) == 0) {
                $errorMessage = 'Bitte eine E-Mail angeben';
                $error = true;
            }

            if(strlen($user->forename) == 0 || strlen($user->surname) == 0) {
                $errorMessage = 'Bitte einen Namen angeben';
                $error = true;
            }

            if(strlen($user->street) == 0 || strlen($user->street_number) == 0 || strlen($user->postcode) == 0 || strlen($user->city) == 0) {
                $errorMessage = 'Bitte eine Adresse angeben';
                $error = true;
            }

            if(strlen($user->password) == 0) {
                $errorMessage = 'Bitte ein Passwort angeben';
                $error = true;
            }
            if($user->password != $password2) {
                $infoMessage = 'Die Passwörter müssen übereinstimmen';
                $error = true;
            }

            if(!$error) {

                // TODO: check if email (unique) is already used
                $result = $this->usersRepository->registration($user);

                if($result) {
                    $infoMessage = 'Du wurdest erfolgreich registriert.';
                } else {
                    $errorMessage = 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
                }
            }
        }

        $this->render('user/registration', [
            "infoMessage" => $infoMessage,
            "errorMessage" => $errorMessage
            ]);
    }

    public function show(){
        $authentication = $this->authentication();

        $product = false;
        if(isset($_GET['id'])){
            $product = $this->productsRepository->fetch($_GET['id']);
        }

        $this->render('product/show', [
            'loggedIn' => $authentication,
            'product' => $product
        ]);
    }

    public function notFound(){
        $products = $this->productsRepository->fetchNumber(3);

        $this->render("error/notFound");
    }

    public function logout(){
       $this->render("user/logout");
    }

    public function shoppingCart(){
        $authentication = $this->authentication();

        $this->render("product/shoppingCart", [
            'loggedIn' => $authentication
        ]);
    }

    public function products(){
        $authentication = $this->authentication();

        $request = [

        ];

        $page = 1;
        if(isset($_GET['p'])){
            $page = $_GET['p'];
        }
        $request['page'] = $page;

        $numberProducts = 15;
        $offset = ($page - 1) * $numberProducts;


        if(isset($_GET['q'])){
            $query = $_GET['q'];
            $request['query'] = $query;
            $products = $this->productsRepository->fetchNumberOffsetQuery($numberProducts, $offset, $query);
        }else{
            $products = $this->productsRepository->fetchNumberOffset($numberProducts, $offset);
        }




        foreach ($products as $product){
            $product_ID = $product->product_ID;
            $product->images = $this->imagesProductRepository->fetchByProductID($product_ID);
        }
        $maxPages = 10;

        $this->render('product/products', [
            'loggedIn' => $authentication,
            'products' => $products,
            'request' => $request,
            'maxPages' => $maxPages
        ]);
    }

    public function fetchProducts(){
        if(isset($_POST['row']) && isset($_POST['number'])){
            $products = $this->productsRepository->fetchNumberOffset($_POST['number'], $_POST['row']);

            foreach ($products as $product){
                $product_ID = $product->product_ID;
                $product->images = $this->imagesProductRepository->fetchByProductID($product_ID);
            }

            $this->render('layout/productsRow', [
               'products' => $products
            ]);

        }

    }

    public function fetchShoppingCart(){

        if(isset($_POST['shoppingCart'])){

            $shoppingCartString = $_POST['shoppingCart'];
            $shoppingCart = json_decode($shoppingCartString, true);

            $items = [];
           foreach($shoppingCart as $id => $count){
               $item = $this->productsRepository->fetch($id);
               if(!$item){
                   array_push($items, false);
                   continue;
               }
               $item->description = $item->getShortDescription(100);
               $product_ID = $item->product_ID;
               $item->images = $this->imagesProductRepository->fetchByProductID($product_ID);
               array_push($items, $item);
            }
           echo json_encode($items);
        }

    }

    public function insertTestProducts($count){
        for($i = 1; $i <= $count; $i++){
            $price = rand(50, 2000);
            if(rand(0,3) == 0){
                $discount = rand(0,100);
            }else{
                $discount = 0;
            }

            $this->productsRepository->insertProduct('Product ' . $i, 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', $price, $discount);
        }
    }

    public function insertTestImages($count){
        $products = $this->productsRepository->fetchNumber($count);
        foreach($products AS $product){
            $img = file_get_contents('https://picsum.photos/200/300');
            $this->imagesProductRepository->insertImage($product->product_ID, $img);

        }
    }
}