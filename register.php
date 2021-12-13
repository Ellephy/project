<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .wrap {
            width: 100%;
            max-width: 400px;
            margin: 40px auto;
        }

        #address {
            height: 100px;
        }
    </style>
</head>

<body class="text-center">
    <div class="wrap">
        <h1 class="h3 mb-3">Register</h1>

        <?php if (isset($_GET['error'])) : ?>
            <div class="alert alert-warning">
                Cannot create account. Please, try again!
            </div>
        <?php endif ?>

        <form action="_actions/create.php" method="POST">
            <div class="form-floating mb-2">
                <input type="text" name="name" class="form-control" placeholder="Name" required>
                <label for="name" class="text-muted">Name</label>
            </div>
            <div class="form-floating mb-2">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
                <label for="email" class="text-muted">Email</label>
            </div>
            <div class="form-floating mb-2">
                <input type="text" name="phone" class="form-control" placeholder="Phone" required>
                <label for="phone" class="text-muted">Phone</label>
            </div>
            <div class="form-floating mb-2">
                <textarea name="address" id="address" class="form-control" placeholder="Address" required></textarea>
                <label for="address" class="text-muted">Address</label>
            </div>

            <div class="form-floating mb-2">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <label for="password" class="text-muted">Password</label>
            </div>

            <button type="submit" class="w-100 btn btn-lg btn-primary">Register</button>
        </form>
        <br>

        <a href="index.php" class="fs-5">Login</a>
    </div>

</body>

</html>