<?php

namespace Users;
use Core\AbstractRepository;
use PDO;

class UsersRepository extends AbstractRepository {

    public function getModel()
    {
        return "Users\\UserModel";
    }

    public function getTable()
    {
        return "user";
    }

    public function getIdName()
    {
        return "user_ID";
    }

    public function login($email, $password){
        $statement = $this->pdo->prepare("SELECT * FROM user WHERE email = :email");
        $statement->execute(['email' => $email]);
        $statement->setFetchMode(PDO::FETCH_CLASS, $this->model);
        $user = $statement->fetch(PDO::FETCH_CLASS);
        //check password
        if ($user !== false && password_verify($password, $user->password)) {
            $_SESSION['userid'] = $user->user_ID;
            return true;
        } else {
            return false;
        }
    }

    public function registration(UserModel $user){
        $password_hash = password_hash($user->password, PASSWORD_DEFAULT);

        // create user in Users
        $statement = $this->pdo->prepare("INSERT INTO user (email, password, forename, surname) VALUES (:username, :password, :forename, :surname);");
        $result = $statement->execute(array('username' => $user->email, 'password' => $password_hash, 'forename' => $user->forename, 'surname' => $user->surname));

        // fetch new user_ID by email
        $statement = $this->pdo->prepare("SELECT user_ID FROM user WHERE email = :email");
        $statement->execute(array('email' => $user->email));
        $user_ID = $statement->fetch()['user_ID'];

        // create new location in Location
        $statement = $this->pdo->prepare("INSERT INTO location (user_ID, street, street_number, postcode, city) VALUES (:uid, :st, :nu, :pc, :ci);");
        $result = $statement->execute(array('uid' => $user_ID, 'st' => $user->street, 'nu' => $user->street_number, 'pc' => $user->postcode, 'ci' => $user->city));

        // fetch new location_ID by user_ID
        $statement = $this->pdo->prepare("SELECT location_ID FROM location WHERE user_ID = :uid");
        $statement->execute(array('uid' => $user_ID));
        $location_ID = $statement->fetch()['location_ID'];

        // update location_ID of user in Users by user_ID
        $statement = $this->pdo->prepare("UPDATE user SET location_ID = :loc WHERE user_ID = :uid");
        $result = $statement->execute(array('uid' => $user_ID, 'loc' => $location_ID));

        return $result;
    }
}