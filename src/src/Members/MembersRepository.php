<?php

namespace Members;
use Core\AbstractRepository;
use PDO;

class MembersRepository extends AbstractRepository {

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

}