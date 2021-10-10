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

class AdminController extends AbstractController
{

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
        $this->locationsRepository = $locationsRepository;
        $this->ordersRepository = $ordersRepository;
        $this->membersRepository = $membersRepository;
        $this->authenticationRepository = $authenticationRepository;
        $this->shoppingCartRepository = $shoppingCartRepository;
    }

    public function admin()
    {
        $authentication = $this->authenticationRepository->memberAuthentication();

        if (!$authentication) {
            header("Location: /login");
            exit();
        }
        header("Location: /admin/dashboard");
    }

    public function adminDashboard()
    {
        $authentication = $this->authenticationRepository->memberAuthentication();
        if (!$authentication) {
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

    public function adminOrders()
    {
    }

    public function adminProducts()
    {
        $authentication = $this->authenticationRepository->memberAuthentication();

        $page = 1;
        if (isset($_GET['p'])) {
            $page = $_GET['p'];
        }
        $request['page'] = $page;

        $numberProducts = 20;
        $offset = ($page - 1) * $numberProducts;


        $query = "";
        if (isset($_GET['q'])) {
            $query = $_GET['q'];
            $request['query'] = $query;
            $products = $this->productsRepository->fetchNumberOffsetQuery($numberProducts, $offset, $query);

        } else {
            $products = $this->productsRepository->fetchNumberOffset($numberProducts, $offset);

        }

        $numberTotalProducts = $this->productsRepository->fetchProductCount($query);
        $maxPages = ceil(($numberTotalProducts / $numberProducts));

        $this->render("admin/products", [
            'loggedIn' => $authentication,
            'products' => $products,
            'request' => $request,
            'maxPages' => $maxPages
        ]);
    }

    public function adminProductsAdd()
    {
    }

    public function adminProductsEdit()
    {
        $authentication = $this->authenticationRepository->memberAuthentication();

        if (isset($_GET['id'])) {
            $product_id = $_GET['id'];
            $product = $this->productsRepository->fetch($product_id);

            if (!empty($_POST)) {

                if(isset($_POST['delete'])){
                    $this->productsRepository->remove($product_id);
                    header("Location: /admin/products");
                    exit();
                }

                $name = $_POST['name'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $discount = $_POST['discount'];


                $base64 = null;
                $file_tmp = $_FILES['image']['tmp_name'];
                var_dump($file_tmp);
                if(!empty($file_tmp)){
                    $type = pathinfo($file_tmp, PATHINFO_EXTENSION);
                    $data = file_get_contents($file_tmp);
                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                }


                $this->productsRepository->updateProduct($product_id, $name, $description, $price, $discount, $base64);
                header("Refresh:0");
            }

            $this->render("admin/products/edit", [
                'loggedIn' => $authentication,
                'product' => $product,
            ]);
        } else {
            header("Location: /admin/products");
            exit();
        }
    }


    public function adminMembers()
    {
    }
}