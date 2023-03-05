<?php

namespace App\Libraries;

class AuthAPILibrary
{
    public static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}