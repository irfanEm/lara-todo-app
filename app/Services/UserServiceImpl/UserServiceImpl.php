<?php

namespace App\Services\UserServiceImpl;
use App\Services\UserService;

class UserServiceImpl implements UserService
{
    private array $user = [
        "irfanem" => "irfan2711"
    ];
    public function login(string $user, string $password): bool
    {
        if(!isset($this->user[$user])){
            return false;
        }

        $passwordBenar = $this->user[$user];
        return $passwordBenar == $password;
    }
}
