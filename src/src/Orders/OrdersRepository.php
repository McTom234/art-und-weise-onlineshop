<?php

namespace Orders;

use Core\AbstractRepository;
use PDO;

class OrdersRepository extends AbstractRepository
{

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

    public function fetch($id)
    {
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

    public function insertOrder($checkout_ID, $product_ID, $price, $discount, $quantity)
    {
        $order_ID = $this->generateUID();
        $statement = $this->pdo->prepare("INSERT INTO `order` (order_ID, product_ID, price, discount, quantity) VALUES (:order_ID, :product_ID, :price, :discount, :quantity)");
        $result = $statement->execute([
            'order_ID' => $order_ID,
            ':product_ID' => $product_ID,
            ':price' => $price,
            ':discount' => $discount,
            ':quantity' => $quantity,
        ]);
        if ($result) {
            $statement = $this->pdo->prepare("INSERT INTO `checkout-order` (checkout_ID, order_ID) VALUES (:checkout_ID, :order_ID)");
            return $statement->execute([
                ':checkout_ID' => $checkout_ID,
                ':order_ID' => $order_ID,
            ]);
        }
        return false;

    }


}