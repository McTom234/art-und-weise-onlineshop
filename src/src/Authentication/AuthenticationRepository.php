<?php

namespace Authentication;

use Members\MembersRepository;
use Users\UsersRepository;

class AuthenticationRepository
{
    private $usersRepository;
    private $membersRepository;


    public function __construct(UsersRepository $usersRepository, MembersRepository $membersRepository){
        $this->usersRepository = $usersRepository;
        $this->membersRepository = $membersRepository;
    }

    public function authentication()
    {
        if (session_status() === 1) {
            session_start();
        }
        if (isset($_SESSION['userid'])) {
            $id = $_SESSION['userid'];
            $user = $this->usersRepository->fetch($id);
            if (!$user) {
                return false;
            } else {
                if($this->membersRepository->fetchByUserID($id)){
                    $user->member = true;
                }
                return $user;
            }
        } else {
            return false;
        }
    }

    public function memberAuthentication()
    {
        if (session_status() === 1) {
            session_start();
        }
        if (isset($_SESSION['userid'])) {
            $result = $this->membersRepository->fetchByUserID($_SESSION['userid']);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        } else {
            return false;
        }
    }

}