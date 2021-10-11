<?php

namespace Users;

use Core\AbstractRepository;
use Locations\LocationsRepository;
use Members\MembersRepository;
use PDO;

class UsersRepository extends AbstractRepository
{

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
    }

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

    public function getUserCount()
    {
        $statement = $this->pdo->query("SELECT COUNT(*) AS count FROM user");
        $count = $statement->fetch();
        if ($count) {
            return $count['count'];
        }
        return false;
    }

    public function login($email, $password)
    {
        $statement = $this->pdo->prepare("SELECT * FROM user WHERE email = :email");
        $statement->execute(['email' => $email]);
        $statement->setFetchMode(PDO::FETCH_CLASS, $this->model);
        $user = $statement->fetch(PDO::FETCH_CLASS);

        if (session_status() === 1) {
            session_start();
        }

        //check password
        if ($user !== false && password_verify($password, $user->password)) {
            $_SESSION['userid'] = $user->user_ID;
            return $user;
        } else {
            return false;
        }
    }

    public function registration(UserModel $user)
    {
        $password_hash = password_hash($user->password, PASSWORD_DEFAULT);

        $user_ID = md5(uniqid(rand(), true));
        $location_ID = md5(uniqid(rand(), true));

        // create user in Users
        $statement = $this->pdo->prepare("INSERT INTO user (user_ID, email, password, forename, surname, location_ID) VALUES (:user_ID , :email, :password, :forename, :surname, :location);");
        $result = $statement->execute([':user_ID' => $user_ID, 'email' => $user->email, 'password' => $password_hash, 'forename' => $user->forename, 'surname' => $user->surname, 'location' => $location_ID] );

        // create new location in Location
        $statement = $this->pdo->prepare("INSERT INTO location (location_ID, user_ID, street, street_number, postcode, city) VALUES (:location_ID, :uid, :st, :nu, :pc, :ci);");
        $result = $statement->execute(['location_ID' => $location_ID, 'uid' => $user_ID, 'st' => $user->street, 'nu' => $user->street_number, 'pc' => $user->postcode, 'ci' => $user->city]);
        // FIXME: if $location_ID exists and execute fails -> execute update after recreation of $location_ID
//        // update location_ID of user in Users by user_ID
//        $statement = $this->pdo->prepare("UPDATE user SET location_ID = :loc WHERE user_ID = :uid");
//        $result = $statement->execute(array('uid' => $user_ID, 'loc' => $location_ID));

        if ($result) {
            if (session_status() === 1) {
                session_start();
            }
            $_SESSION['userid'] = $user_ID;
            return $user_ID;
        }
        return false;
    }
}