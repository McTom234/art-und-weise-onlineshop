<?php

namespace Orders;
use Core\AbstractRepository;
use PDO;

class OrdersRepository extends AbstractRepository {

    public function getModel()
    {
        return "Orders\\OrderModel";
    }

    public function getTable()
    {
        return "order";
    }

    public function getIdName()
    {
        return "order_ID";
    }

    public function fetch($id){
        $statement = $this->pdo->prepare("SELECT * FROM `order`  WHERE $this->idName = :id");
        $statement->execute(['id' => $id]);
        $statement->setFetchMode(PDO::FETCH_CLASS, $this->model);
        return $statement->fetch(PDO::FETCH_CLASS);
    }

    public function fetchNumber($number)
    {
        $statement = $this->pdo->prepare("SELECT * FROM `order` LIMIT :number");
        $statement->execute([':number' => $number]);
        return $statement->fetchAll(PDO::FETCH_CLASS, $this->model);
    }

    public function insertOrder($checkout_ID, $product_ID, $discount, $quantity){
        $statement = $this->pdo->prepare("INSERT INTO `order` (product_ID, discount, quantity) VALUES (:product_ID, :discount, :quantity)");
        $result = $statement->execute([
            ':product_ID' => $product_ID,
            ':discount' => $discount,
            ':quantity' => $quantity,
        ]);
        if($result){
            $order_ID = $this->pdo->lastInsertId();

            $statement = $this->pdo->prepare("INSERT INTO `checkout-order` (checkout_ID, order_ID) VALUES (:checkout_ID, :order_ID)");
            $result = $statement->execute([
                ':checkout_ID' => $checkout_ID,
                ':order_ID' => $order_ID,
            ]);

            return $result;
        }
        return false;

    }


}