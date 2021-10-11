<?php

namespace Members;

use Core\AbstractRepository;
use PDO;
use Users\UsersRepository;

class MembersRepository extends AbstractRepository
{

    private $usersRepository;

    public function __construct(PDO $pdo, UsersRepository $usersRepository)
    {
        parent::__construct($pdo);
        $this->usersRepository = $usersRepository;
    }

    public function getModel()
    {
        return "Members\\MemberModel";
    }

    public function getTable()
    {
        return "member";
    }

    public function getIdName()
    {
        return "member_ID";
    }

    public function fetchByUserID($userID)
    {
        $statement = $this->pdo->prepare("SELECT * FROM member WHERE user_ID = :id");
        $statement->execute(['id' => $userID]);
        $statement->setFetchMode(PDO::FETCH_CLASS, $this->model);

        $member = $statement->fetch(PDO::FETCH_CLASS);
        if ($member) {
            $user = $this->usersRepository->fetch($userID);
            $member->forename = $user->forename;
            $member->surname = $user->surname;
            $member->email = $user->surname;
            $member->location_ID = $user->location_ID;
            return $member;
        }
        return false;

    }

    public function insertMember($userID, $rights)
    {
        $member_ID = $this->generateUID();
        $statement = $this->pdo->prepare("INSERT INTO member (member_ID, user_ID, rights) VALUES (:member_ID, :user_ID, :rights)");
        return $statement->execute([
            ':member_ID' => $member_ID,
            ':user_ID' => $userID,
            ':rights' => $rights,
        ]);
    }

}