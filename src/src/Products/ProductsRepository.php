<?php

namespace Products;
use Core\AbstractRepository;
use PDO;

class ProductsRepository extends AbstractRepository {

    public $imagesProductsRepository;

    public function __construct(PDO $pdo, ImagesProductsRepository $imagesProductsRepository)
    {
        parent::__construct($pdo);

        $this->imagesProductsRepository = $imagesProductsRepository;

    }

    public function getModel()
    {
        return "Products\\ProductModel";
    }

    public function getTable()
    {
        return "product";
    }

    public function getIdName()
    {
        return "product_ID";
    }

    public function fetch($id)
    {
         $product = parent::fetch($id);
         if($product){
             $product->images = $this->imagesProductsRepository->fetchByProductID($id);
         }
         return $product;
    }

    function fetchProductCount($query = ""){
        $statement = $this->pdo->prepare("SELECT COUNT(*) AS count FROM $this->table WHERE name LIKE :query");
        $statement->execute([':query' => '%' . $query . '%']);
        return $statement->fetch()['count'];
    }

    function fetchNumberOffset($number, $offset){
        $statement = $this->pdo->prepare("SELECT * FROM $this->table LIMIT :number OFFSET :offset");
        $statement->execute([':number' => $number, ':offset' => $offset]);
        return $statement->fetchAll(PDO::FETCH_CLASS, $this->model);
    }

    function fetchNumberOffsetQuery($number, $offset, $query){
        $statement = $this->pdo->prepare("SELECT * FROM $this->table WHERE name LIKE :query LIMIT :number OFFSET :offset");
        $statement->execute([':query' => '%' . $query . '%',':number' => $number, ':offset' => $offset]);
        return $statement->fetchAll(PDO::FETCH_CLASS, $this->model);
    }

    function insertProduct($name, $description, $price, $discount){
        $statement = $this->pdo->prepare("INSERT INTO $this->table (name, price, discount, description) VALUES (:name, :price, :discount, :description)");
        $statement->execute([':name' => $name, ':description' => $description, ':price' => $price, ':discount' => $discount]);
    }
}