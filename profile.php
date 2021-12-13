<?php

include("vendor/autoload.php");

use Helpers\Auth;

$auth = Auth::check();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container w-50 mt-5">
        <h1 class="mb-3 text-center">
            <?= $auth->name ?>
            <span class="fw-normal text-muted">
                (<?= $auth->role ?>)
            </span>
        </h1>

        <?php if (isset($_GET['error'])) : ?>
            <div class="alert alert-warning">
                Cannot upload file!
            </div>
        <?php endif ?>

        <?php if ($auth->photo) : ?>
            <img class="img-thumbnail mb-3 rounded mx-auto d-block" src="_actions/photos/<?= $auth->photo ?>" alt="Profile Photo" width="200">
        <?php endif ?>

        <form action="_actions/upload.php" method="post" enctype="multipart/form-data">
            <div class="input-group mb-3">
                <input type="file" name="photo" class="form-control">
                <button class="btn btn-secondary">Upload</button>
            </div>
        </form>

        <ul class="list-group">
            <li class="list-group-item">
                <b>Email:</b> <?= $auth->email; ?>
            </li>
            <li class="list-group-item">
                <b>Phone:</b> <?= $auth->phone; ?>
            </li>
            <li class="list-group-item">
                <b>Address:</b> <?= $auth->address; ?>
            </li>
        </ul>
        <br>

        <div class="text-center">
            <?php if ($auth->role_id === "3") : ?>
                <a href="admin.php" class="text-success fs-5">Manage Users</a>
                &nbsp; | &nbsp;
            <?php endif ?>
            <a href="_actions/logout.php" class="text-danger fs-5">Logout</a>
        </div>
    </div>
</body>

</html>