<?php

include("../vendor/autoload.php");

use Helpers\Auth;
use Helpers\HTTP;
use Libs\Database\MySQL;
use Libs\Database\UserTable;

$auth = Auth::check();

$table = new UserTable(new MySQL());

$name = $_FILES["photo"]["name"];
$error = $_FILES["photo"]["error"];
$tmp = $_FILES["photo"]["tmp_name"];
$type = $_FILES["photo"]["type"];

if ($error) {
    HTTP::redirect("/profile.php?error=file");
}

if ($type === "image/jpeg" || $type === "image/png") {
    $table->updatePhoto($auth->id, $name);

    move_uploaded_file($tmp, "photos/$name");

    $auth->photo = $name;

    HTTP::redirect("/profile.php");
} else {
    HTTP::redirect("/profile.php?error=type");
}
