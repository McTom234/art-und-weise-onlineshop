<?php

use Core\AbstractController;
use Products\ProductsRepository;
use Users\UsersRepository;

class Controller extends AbstractController {

    private $productsRepository;
    private $usersRepository;

    public function __construct(UsersRepository $usersRepository, ProductsRepository $productsRepository)
    {
        $this->usersRepository = $usersRepository;
        $this->productsRepository = $productsRepository;
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
        $_SESSION['userid'] = 1;
        $authentication = $this->authentication();

        $products = $this->productsRepository->fetchNumber(3);

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


            //better way -> make email UNIQUE

            /**
            if(!$error) {
                $statement = $pdo->prepare("SELECT user_ID FROM user WHERE email = :username");
                $statement->execute(array('username' => $email));
                $user = $statement->fetch();

                if($user !== false) {
                    $errorMessage = 'Dieser Benutzername ist bereits vergeben';
                    $error = true;
                }
            }
            **/

            if(!$error) {

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

    public function fetchShoppingCart(){

        if(isset($_POST)){

            $shoppingCartString = $_POST['shoppingCart'];
            $shoppingCart = json_decode($shoppingCartString, true);

            $items = [];
           foreach($shoppingCart as $id => $count){
                array_push($items, $this->productsRepository->fetch($id));
            }
           echo json_encode($items);
        }


    }
}