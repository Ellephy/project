<?php

include("../vendor/autoload.php");

use Helpers\Auth;
use Helpers\HTTP;
use Libs\Database\MySQL;
use Libs\Database\UserTable;

Auth::check();
Auth::isAdmin();

$id = $_GET["id"];
$role = $_GET["role"];

$table = new UserTable(new MySQL());
$table->changeRole($id, $role);

HTTP::redirect("/admin.php");
