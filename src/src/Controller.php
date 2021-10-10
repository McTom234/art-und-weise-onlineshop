<?php

use Articles\ArticlesRepository;
use Authentication\AuthenticationRepository;
use Checkouts\CheckoutsRepository;
use Core\AbstractController;
use Locations\LocationsRepository;
use Members\MembersRepository;
use Orders\OrdersRepository;
use Products\ImagesProductsRepository;
use Products\ProductsRepository;
use ShoppingCart\ShoppingCartRepository;
use Users\UsersRepository;

class Controller extends AbstractController
{

    private $productsRepository;
    private $usersRepository;
    private $imagesProductRepository;
    private $articlesRepository;
    private $checkoutsRepository;
    private $locationsRepository;
    private $ordersRepository;
    private $membersRepository;
    private $authenticationRepository;
    private $shoppingCartRepository;

    public function __construct(UsersRepository $usersRepository, ProductsRepository $productsRepository, ImagesProductsRepository $imagesProductRepository, ArticlesRepository $articlesRepository, CheckoutsRepository $checkoutsRepository, LocationsRepository $locationsRepository, OrdersRepository $ordersRepository, MembersRepository $membersRepository, AuthenticationRepository $authenticationRepository, ShoppingCartRepository $shoppingCartRepository)
    {
        $this->usersRepository = $usersRepository;
        $this->productsRepository = $productsRepository;
        $this->imagesProductRepository = $imagesProductRepository;
        $this->articlesRepository = $articlesRepository;
        $this->checkoutsRepository = $checkoutsRepository;
        $this->locationsRepository = $locationsRepository;
        $this->ordersRepository = $ordersRepository;
        $this->membersRepository = $membersRepository;
        $this->authenticationRepository = $authenticationRepository;
        $this->shoppingCartRepository = $shoppingCartRepository;
    }

    public function home()
    {
        $authentication = $this->authenticationRepository->authentication();
        $products = $this->productsRepository->fetchNumber(3);
        foreach ($products as $product) {
            $product_ID = $product->product_ID;
            $product->images = $this->imagesProductRepository->fetchByProductID($product_ID);
        }

        $this->render("home", [
            'loggedIn' => $authentication,
            'products' => $products,
            'shoppingCartProductCount' => $this->shoppingCartRepository->getProductCount(),
        ]);
    }

    public function login()
    {
        $message = null;
        $buy = false;
        if (isset($_GET['buy'])) {
            $buy = true;
        }

        if (isset($_GET['login'])) {
            if (isset($_POST['email']) && isset($_POST['password'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $user = $this->usersRepository->login($email, $password);

                if ($user) {
                    if (isset($_GET['buy'])) {
                        header("Location: /buy");
                    } else {
                        $member = $this->membersRepository->fetchByUserID($user->user_ID);
                        if ($member) {
                            header("Location: /admin");
                        } else {
                            header("Location: /");
                        }
                    }
                } else {
                    $message = 'Email or Password wrong!';
                }

            } else {
                $message = 'Please enter email and password!';
            }
        }

        $this->render("user/login", [
            'message' => $message,
            'buy' => $buy,
        ]);

    }

    public function registration()
    {

        $infoMessage = null;
        $errorMessage = null;


        $userCount = $this->usersRepository->getUserCount();

        if ($userCount <= 0) {
            $infoMessage = "Du bist die erste Person, die sich registriert. Bitte gebe deine Daten an, damit du als Administrator hinzugefügt wirst.";
        }

        if (isset($_GET['register'])) {
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


            if (strlen($user->email) == 0) {
                $errorMessage = 'Bitte eine E-Mail angeben';
                $error = true;
            }

            if (strlen($user->forename) == 0 || strlen($user->surname) == 0) {
                $errorMessage = 'Bitte einen Namen angeben';
                $error = true;
            }

            if (strlen($user->street) == 0 || strlen($user->street_number) == 0 || strlen($user->postcode) == 0 || strlen($user->city) == 0) {
                $errorMessage = 'Bitte eine Adresse angeben';
                $error = true;
            }

            if (strlen($user->password) == 0) {
                $errorMessage = 'Bitte ein Passwort angeben';
                $error = true;
            }
            if ($user->password != $password2) {
                $errorMessage = 'Die Passwörter müssen übereinstimmen';
                $error = true;
            }

            if (!$error) {

                // TODO: check if email (unique) is already used
                $result = $this->usersRepository->registration($user);

                if ($result) {

                    // first registration -> make user to member/admin
                    if ($userCount === 0) {
                        $this->membersRepository->insertMember($result, 1);
                        header("Location: /admin");
                    }

                    header("Location: /");

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

    public function show()
    {
        $authentication = $this->authenticationRepository->authentication();

        $product = false;
        if (isset($_GET['id'])) {
            $product = $this->productsRepository->fetch($_GET['id']);
        }

        $this->render('product/show', [
            'loggedIn' => $authentication,
            'product' => $product,
            'shoppingCartProductCount' => $this->shoppingCartRepository->getProductCount(),
        ]);
    }

    public function notFound()
    {
        $products = $this->productsRepository->fetchNumber(3);

        $this->render("error/notFound");
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header("Location: /");
    }

    public function shoppingCart()
    {
        $authentication = $this->authenticationRepository->authentication();

        $this->render("product/shoppingCart", [
            'loggedIn' => $authentication,
            'shoppingCartProductCount' => $this->shoppingCartRepository->getProductCount(),
        ]);
    }

    public function products()
    {
        $authentication = $this->authenticationRepository->authentication();

        $request = [];

        $page = 1;
        if (isset($_GET['p'])) {
            $page = $_GET['p'];
        }
        $request['page'] = $page;

        $numberProducts = 15;
        $offset = ($page - 1) * $numberProducts;


        $query = "";
        if (isset($_GET['q'])) {
            $query = $_GET['q'];
            $request['query'] = $query;
            $products = $this->productsRepository->fetchNumberOffsetQuery($numberProducts, $offset, $query);

        } else {
            $products = $this->productsRepository->fetchNumberOffset($numberProducts, $offset);

        }
        $maxPages = 0;
        $numberTotalProducts = $this->productsRepository->fetchProductCount($query);
        $maxPages = ceil(($numberTotalProducts / $numberProducts));


        foreach ($products as $product) {
            $product_ID = $product->product_ID;
            $product->images = $this->imagesProductRepository->fetchByProductID($product_ID);
        }


        $this->render('product/products', [
            'loggedIn' => $authentication,
            'products' => $products,
            'request' => $request,
            'maxPages' => $maxPages,
            'shoppingCartProductCount' => $this->shoppingCartRepository->getProductCount(),
        ]);
    }

    public function buy()
    {
        $authentication = $this->authenticationRepository->authentication();
        $userLocation = $this->locationsRepository->fetch($authentication->location_ID);

        if (!$authentication) {
            header('Location: /login?buy=1');
        }


        if (isset($_COOKIE['shoppingCart'])) {
            $shoppingCartIDs = json_decode($_COOKIE['shoppingCart'], true);

            $shoppingCart = [];

            $totalPrice = 0;
            foreach ($shoppingCartIDs as $product_ID => $quantity) {
                $product = $this->productsRepository->fetch($product_ID);
                if ($product) {
                    $price = $product->discountPriceEuro;
                    $totalPrice += $price * $quantity;
                    $product->price = $price;
                    $product->count = $quantity;
                    array_push($shoppingCart, $product);
                }
            }

            if (isset($_GET['submit'])) {
                $checkout_ID = $this->checkoutsRepository->insertCheckout($authentication->user_ID);
                foreach ($shoppingCartIDs as $product_ID => $quantity) {
                    $product = $this->productsRepository->fetch($product_ID);
                    if ($product) {
                        $this->ordersRepository->insertOrder($checkout_ID, $product_ID, $product->price, $product->discount, $quantity);
                    }
                }
                header('Location: /ordered');
            }


            $this->render('buy', [
                'loggedIn' => $authentication,
                'userLocation' => $userLocation,
                'shoppingCart' => $shoppingCart,
                'totalPrice' => $totalPrice,

            ]);
        }


    }

    public function ordered()
    {
        $authentication = $this->authenticationRepository->authentication();

        if (!$authentication) {
            header('Location: /login?buy=1');
        }

        $this->render('ordered', [
            'loggedIn' => $authentication,
        ]);
    }

    public function fetchProducts()
    {
        if (isset($_POST['row']) && isset($_POST['number'])) {
            $products = $this->productsRepository->fetchNumberOffset($_POST['number'], $_POST['row']);

            foreach ($products as $product) {
                $product_ID = $product->product_ID;
                $product->images = $this->imagesProductRepository->fetchByProductID($product_ID);
            }

            $this->render('layout/productsRow', [
                'products' => $products
            ]);

        }

    }

    public function fetchShoppingCart()
    {

        if (isset($_POST['shoppingCart'])) {

            $shoppingCartString = $_POST['shoppingCart'];
            $shoppingCart = json_decode($shoppingCartString, true);

            $items = [];
            foreach ($shoppingCart as $id => $count) {
                $item = $this->productsRepository->fetch($id);
                if (!$item) {
                    array_push($items, false);
                    continue;
                }
                $product_ID = $item->product_ID;
                $item->images = $this->imagesProductRepository->fetchByProductID($product_ID);
                $item->price = $item->discountPriceEuro;
                array_push($items, $item);
            }
            echo json_encode($items);
        }

    }

    public function insertTestProducts($count)
    {
        for ($i = 1; $i <= $count; $i++) {
            $price = rand(50, 2000);
            if (rand(0, 3) == 0) {
                $discount = rand(0, 100);
            } else {
                $discount = 0;
            }

            $file_tmp = 'https://picsum.photos/200/300';
            $type = pathinfo($file_tmp, PATHINFO_EXTENSION);
            $data = file_get_contents($file_tmp);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

            $this->productsRepository->insertProduct('Product ' . $i, 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', $price, $discount, $base64);
        }

    }
}