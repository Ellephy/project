<?php

include("vendor/autoload.php");

use Helpers\Auth;
use Libs\Database\MySQL;
use Libs\Database\UserTable;

Auth::isAdmin();
$auth = Auth::check();

$table = new UserTable(new MySQL());
$all = $table->getAll();

?>


<!DOCTYPE html>
<html>

<head>
    <title>Manage Users</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .navbars {
            overflow: hidden;
            position: fixed;
            top: 0;
            width: 90%;
            padding: 10px 16px;
            background: #fff;
            z-index: 1;
        }

        main {
            padding: 16px;
            margin-top: 75px;
        }
    </style>
</head>

<body>
    <div class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <h1 class="navbar-nav">Manage Users
                <span class="badge bg-danger ms-3"><?= count($all) ?></span>
            </h1>
            <div class="navbar-nav">
                <a href="profile.php" class="fs-5">Profile</a>
                &nbsp; | &nbsp;
                <a href="_actions/logout.php" class="text-danger fs-5">Logout</a>
            </div>
        </div>
    </div>
    <main class="container">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($all as $user) : ?>
                    <tr>
                        <td><?= $user->id ?></td>
                        <td><?= $user->name ?></td>
                        <td><?= $user->email ?></td>
                        <td><?= $user->phone ?></td>
                        <td>
                            <?php
                            $bgColor = "bg-secondary";
                            if ($user->role_id === "3") $bgColor = "bg-success";
                            elseif ($user->role_id === "2") $bgColor = "bg-primary";
                            ?>
                            <span class="badge <?= $bgColor ?>"><?= $user->role ?></span>
                        </td>
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    Change Role
                                </button>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <li><a class="dropdown-item" href="_actions/role.php?id=<?= $user->id ?>&role=1">User</a></li>
                                    <li><a class="dropdown-item" href="_actions/role.php?id=<?= $user->id ?>&role=2">Manager</a></li>
                                    <li><a class="dropdown-item" href="_actions/role.php?id=<?= $user->id ?>&role=3">Admin</a></li>
                                </ul>

                                <?php if ($user->suspended) : ?>
                                    <a href="_actions/unsuspend.php?id=<?= $user->id ?>" class="btn btn-sm btn-outline-danger">Suspended</a>
                                <?php else : ?>
                                    <a href="_actions/suspend.php?id=<?= $user->id ?>" class="btn btn-sm btn-outline-danger">Alive</a>
                                <?php endif ?>
                                <?php if ($user->id !== $auth->id) : ?>
                                    <a href="_actions/delete.php?id=<?= $user->id ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                <?php endif ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </main>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>