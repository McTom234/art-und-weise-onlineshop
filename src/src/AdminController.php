<?php

use Articles\ArticlesRepository;
use Authentication\AuthenticationRepository;
use Categories\CategoriesRepository;
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
    private $categoriesRepository;

    public function __construct(UsersRepository $usersRepository, ProductsRepository $productsRepository, MembersRepository $membersRepository, ArticlesRepository $articlesRepository, LocationsRepository $locationsRepository, OrdersRepository $ordersRepository, CheckoutsRepository $checkoutsRepository, AuthenticationRepository $authenticationRepository, ShoppingCartRepository $shoppingCartRepository, CategoriesRepository $categoriesRepository)
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
        $this->categoriesRepository = $categoriesRepository;
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
        $authentication = $this->authenticationRepository->memberAuthentication();

        $page = 1;
        if (isset($_GET['p'])) {
            $page = $_GET['p'];
        }
        $request['page'] = $page;

        $number = 20;
        $offset = ($page - 1) * $number;


        $query = "";
        if (isset($_GET['q'])) {
            $query = $_GET['q'];
            $request['query'] = $query;
        }
        $checkouts = $this->checkoutsRepository->fetchNumberOffsetQuery($number, $offset, $query);

        $numberTotalProducts = $this->productsRepository->fetchProductCount($query);
        $maxPages = ceil(($numberTotalProducts / $number));

        $this->render("admin/orders", [
            'loggedIn' => $authentication,
            'checkouts' => $checkouts,
            'request' => $request,
            'maxPages' => $maxPages
        ]);
    }

    public function adminOrdersShow()
    {
        $authentication = $this->authenticationRepository->memberAuthentication();

        if (isset($_GET['id'])) {
            $checkout_id = $_GET['id'];
            $checkout = $this->checkoutsRepository->fetch($checkout_id);
            $this->render("admin/orders/show", [
                'loggedIn' => $authentication,
                'checkout' => $checkout,
            ]);
        } else {
            header("Location: /admin/orders");
            exit();
        }
    }

    public function adminProducts()
    {
        $authentication = $this->authenticationRepository->memberAuthentication();

        $page = 1;
        if (isset($_GET['p'])) {
            $page = $_GET['p'];
        }
        $request['page'] = $page;

        $number = 20;
        $offset = ($page - 1) * $number;


        $query = "";
        if (isset($_GET['q'])) {
            $query = $_GET['q'];
            $request['query'] = $query;
            $products = $this->productsRepository->fetchNumberOffsetQuery($number, $offset, $query);

        } else {
            $products = $this->productsRepository->fetchNumberOffset($number, $offset);

        }

        $numberTotalProducts = $this->productsRepository->fetchProductCount($query);
        $maxPages = ceil(($numberTotalProducts / $number));

        $this->render("admin/products", [
            'loggedIn' => $authentication,
            'products' => $products,
            'request' => $request,
            'maxPages' => $maxPages
        ]);
    }

    public function adminProductsAdd()
    {
        $authentication = $this->authenticationRepository->memberAuthentication();

        $categories = $this->categoriesRepository->fetchAll();

        if (!empty($_POST)) {

            $name = htmlspecialchars($_POST['name']);
            $description = htmlspecialchars($_POST['description']);
            $price = htmlspecialchars($_POST['price']);
            $discount = htmlspecialchars($_POST['discount']);

            $newCategory = htmlspecialchars($_POST['category']);

            $base64 = null;
            $file_tmp = $_FILES['image']['tmp_name'];

            if (!empty($file_tmp)) {
                $type = pathinfo($file_tmp, PATHINFO_EXTENSION);
                $data = file_get_contents($file_tmp);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            }

            $product_ID = $this->productsRepository->insertProduct($name, $description, $price, $discount, $base64);

            if($product_ID){
                if(strlen($newCategory) > 0){
                    $this->categoriesRepository->insertProductCategory($newCategory, $product_ID);
                }
                header("Location: /show?id=" . $product_ID);
                exit();
            }
        }

        $this->render("admin/products/add", [
            'loggedIn' => $authentication,
            'categories' => $categories,
        ]);
    }

    public function adminProductsEdit()
    {
        $authentication = $this->authenticationRepository->memberAuthentication();

        if (isset($_GET['id'])) {
            $product_id = htmlspecialchars($_GET['id']);
            $product = $this->productsRepository->fetch($product_id);
            $categories = $this->categoriesRepository->fetchAll();
            if ($product) {
                $category = $this->categoriesRepository->fetchByProductID($product_id);
                if ($category) {
                    foreach ($categories as $c) {
                        if ($c->category_ID == $category->category_ID) {
                            $c->selected = true;
                        }
                    }
                }
            }

            if (!empty($_POST)) {

                if (isset($_POST['delete'])) {
                    $this->productsRepository->remove($product_id);
                    header("Location: /admin/products");
                    exit();
                }

                $name = htmlspecialchars($_POST['name']);
                $description = htmlspecialchars($_POST['description']);
                $price = htmlspecialchars($_POST['price']);
                $discount = htmlspecialchars($_POST['discount']);

                $newCategory = htmlspecialchars($_POST['category']);

                $this->categoriesRepository->removeProductCategory($product_id);
                if(strlen($newCategory) > 0){
                    $this->categoriesRepository->insertProductCategory($newCategory, $product_id);
                }


                $base64 = null;
                $file_tmp = $_FILES['image']['tmp_name'];

                if (!empty($file_tmp)) {
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
                'categories' => $categories,
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