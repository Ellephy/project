<?php

include("../vendor/autoload.php");

use Helpers\Auth;
use Helpers\HTTP;
use Libs\Database\MySQL;
use Libs\Database\UserTable;

Auth::check();
Auth::isAdmin();

$table = new UserTable(new MySQL());

$id = $_GET["id"];
$table->unsuspend($id);

HTTP::redirect("/admin.php");
