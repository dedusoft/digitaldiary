<?php

namespace App\Libraries;

class AuthAPILibrary
{
    public static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function checkPassword($passwordInput,$passwordDB )
    {
        return password_verify($passwordInput,$passwordDB ) ? true : false;
    }
}