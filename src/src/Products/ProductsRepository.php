<?php

namespace Products;
use Core\AbstractRepository;
use PDO;

class ProductsRepository extends AbstractRepository {

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