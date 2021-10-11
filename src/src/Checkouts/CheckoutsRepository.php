<?php

namespace Checkouts;

use Core\AbstractRepository;
use Orders\OrdersRepository;
use PDO;

class CheckoutsRepository extends AbstractRepository
{

    private $ordersRepository;

    public function __construct(PDO $pdo, OrdersRepository $ordersRepository)
    {
        parent::__construct($pdo);

        $this->ordersRepository = $ordersRepository;

    }

    public function getModel()
    {
        return "Checkouts\\CheckoutModel";
    }

    public function getTable()
    {
        return "checkout";
    }

    public function getIdName()
    {
        return "checkout_ID";
    }

    public function fetch($id)
    {
        $statement = $this->pdo->prepare("SELECT checkout_ID, tip, member_ID, forename, surname, email, street, street_number, postcode, city FROM checkout LEFT JOIN user ON user.user_ID = checkout.user_ID LEFT JOIN location ON location.user_ID = user.user_ID WHERE checkout_ID = :id");
        $statement->execute([
            ':id' => $id,
        ]);

        $statement->setFetchMode(PDO::FETCH_CLASS, $this->model);
        $checkout = $statement->fetch(PDO::FETCH_CLASS);

        $statement = $this->pdo->prepare("SELECT order_ID FROM `checkout-order` WHERE checkout_ID = :checkout_ID");
        $statement->execute([':checkout_ID' => $checkout->checkout_ID]);
        $order_IDs = $statement->fetchAll();


        $orders = [];
        foreach ($order_IDs as $order_ID) {
            $order = $this->ordersRepository->fetch($order_ID[0]);
            if ($order) {
                array_push($orders, $order);
            }
        }
        $checkout->orders = $orders;

        return $checkout;
    }

    public function fetchNumberOffsetQuery($number, $offset, $query = "")
    {
        $statement = $this->pdo->prepare("SELECT checkout_ID, tip, member_ID, forename, surname, email, street, street_number, postcode, city FROM checkout LEFT JOIN user ON user.user_ID = checkout.user_ID LEFT JOIN location ON location.user_ID = user.user_ID WHERE checkout_ID LIKE :checkout_ID OR forename LIKE :forename OR surname LIKE :surname OR email LIKE :email OR street LIKE :street OR street_number LIKE :street_number OR postcode LIKE :postcode OR city LIKE :city LIMIT :number OFFSET :offset");
        $statement->execute([
            ':number' => $number,
            ':offset' => $offset,
            ':checkout_ID' => '%' . $query . '%',
            ':forename' => '%' . $query . '%',
            ':surname' => '%' . $query . '%',
            ':email' => '%' . $query . '%',
            ':street' => '%' . $query . '%',
            ':street_number' => '%' . $query . '%',
            ':postcode' => '%' . $query . '%',
            ':city' => '%' . $query . '%',
        ]);
        $checkouts = $statement->fetchAll(PDO::FETCH_CLASS, $this->model);

        foreach ($checkouts as $checkout) {
            $statement = $this->pdo->prepare("SELECT order_ID FROM `checkout-order` WHERE checkout_ID = :checkout_ID");
            $statement->execute([':checkout_ID' => $checkout->checkout_ID]);
            $order_IDs = $statement->fetchAll();


            $orders = [];
            foreach ($order_IDs as $order_ID) {
                $order = $this->ordersRepository->fetch($order_ID[0]);
                if ($order) {
                    array_push($orders, $order);
                }
            }
            $checkout->orders = $orders;
        }
        return $checkouts;
    }

    public function insertCheckout($user_ID, $tip = null, $member_ID = null)
    {
        $checkout_ID = $this->generateUID();

        $statement = $this->pdo->prepare("INSERT INTO checkout (checkout_ID, user_ID, tip, member_ID) VALUES (:checkout_ID, :user_ID, :tip, :member_ID)");
        $result = $statement->execute([
            ':checkout_ID' => $checkout_ID,
            ':user_ID' => $user_ID,
            ':tip' => $tip,
            ':member_ID' => $member_ID,
        ]);
        if ($result) {
            return $checkout_ID;
        } else {
            return false;
        }
    }

}