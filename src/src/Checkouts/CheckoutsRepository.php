<?php

namespace Checkouts;
use Core\AbstractRepository;
use PDO;

class CheckoutsRepository extends AbstractRepository {

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

    public function insertCheckout($user_ID, $tip = null, $member_ID = null){
        $statement = $this->pdo->prepare("INSERT INTO checkout (user_ID, tip, member_ID) VALUES (:user_ID, :tip, :member_ID)");
        $result = $statement->execute([
            ':user_ID' => $user_ID,
            ':tip' => $tip,
            ':member_ID' => $member_ID,
        ]);
        return $this->pdo->lastInsertId();
    }

}