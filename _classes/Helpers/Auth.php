<?php

namespace Helpers;

session_start();

class Auth
{
    static $loginUrl = "/index.php";
    static $profileUrl = "/profile.php";

    static function check()
    {
        if (isset($_SESSION["user"])) {
            return $_SESSION["user"];
        } else {
            HTTP::redirect(static::$loginUrl);
        }
    }

    static function isAdmin()
    {
        if (isset($_SESSION["user"])) {
            if ($_SESSION["user"]->role_id !== "3")
                HTTP::redirect(static::$profileUrl);
        }
    }
}
