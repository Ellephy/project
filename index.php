<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .wrap {
            width: 100%;
            max-width: 400px;
            margin: 40px auto;
        }
    </style>
</head>

<body class="text-center">
    <div class="wrap">
        <h1 class="h3 mb-3">Login</h1>
        <?php if (isset($_GET['incorrect'])) : ?>
            <div class="alert alert-warning">
                <span>Incorrect Email or Password!</span>
            </div>
        <?php endif ?>
        <?php if (isset($_GET['registered'])) : ?>
            <div class="alert alert-success">
                <span>Your account is created! Please login.</span>
            </div>
        <?php endif ?>
        <?php if (isset($_GET['suspended'])) : ?>
            <div class="alert alert-danger">
                <span>Your account is suspended!</span>
            </div>
        <?php endif ?>


        <form action="_actions/login.php" method="POST">
            <div class="form-floating mb-2">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
                <label for="email" class="text-muted">Email</label>
            </div>
            <div class="form-floating mb-2">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <label for="password" class="text-muted">Password</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
        </form>
        <br>

        <a href="register.php" class="fs-5">Register</a>
    </div>
</body>

</html>