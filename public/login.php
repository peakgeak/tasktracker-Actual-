<?php

session_start();

require_once 'database.config.php';
require_once 'controllers/AccountController.php';

$controller = new AccountController(
    $server_name,
    $username,
    $password,
    $db_name
);

$error = "";

if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($controller->login($username, $password)) {

        header("Location: /tasktracker/public/dashboard.php");
        exit();

    } else {

        $error = "Invalid username or password.";

    }
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Login</title>

    <link rel="stylesheet"
          href="assets/style.css">

</head>

<body>

<div class="flex-center auth-container">

    <div class="card auth-card">

        <h2 class="mb-2">
            Login
        </h2>

        <?php if ($error != "") { ?>

            <div class="alert alert-danger">

                <?php echo $error; ?>

            </div>

        <?php } ?>

        <form method="POST">

            <div class="form-group">

                <label>Username</label>

                <input type="text"
                       name="username"
                       required>

            </div>

            <div class="form-group">

                <label>Password</label>

                <input type="password"
                       name="password"
                       required>

            </div>

            <button class="btn btn-primary"
                    type="submit"
                    name="login">

                Login

            </button>

        </form>
<p style="margin-top: 1rem; text-align: center;">
    Don't have an account?
    <a href="register.php">Register here</a>
</p>
    </div>

</div>

</body>

</html>