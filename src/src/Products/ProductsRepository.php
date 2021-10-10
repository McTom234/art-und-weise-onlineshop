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

    function remove($id)
    {
        $this->imagesProductsRepository->removeByProductID($id);
        return parent::remove($id);
    }

    function updateProduct($product_ID, $name, $description, $price, $discount, $image = null){
        $statement = $this->pdo->prepare("UPDATE product SET name = :name, price = :price, discount = :discount, description = :description WHERE product_ID = :product_ID");
        $statement->execute([':product_ID' => $product_ID, ':name' => $name, ':description' => $description, ':price' => $price, ':discount' => $discount]);

        if($image){
            $this->imagesProductsRepository->removeByProductID($product_ID);
            $this->imagesProductsRepository->insertImage($product_ID, $image);
        }
    }

    function insertProduct($name, $description, $price, $discount, $image){
        $statement = $this->pdo->prepare("INSERT INTO $this->table (name, price, discount, description) VALUES (:name, :price, :discount, :description)");
        $statement->execute([':name' => $name, ':description' => $description, ':price' => $price, ':discount' => $discount]);
        $product_ID = $this->pdo->lastInsertId();
        $this->imagesProductsRepository->insertImage($product_ID, $image);
        return $product_ID;
    }
}