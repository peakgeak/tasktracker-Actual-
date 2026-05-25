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

$error   = "";
$success = "";

if (isset($_POST["register"])) {

    $username        = trim($_POST["username"]);
    $password        = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    if ($username == "" || $password == "") {

        $error = "All fields are required.";

    } elseif ($password !== $confirm_password) {

        $error = "Passwords do not match.";

    } elseif (strlen($password) < 6) {

        $error = "Password must be at least 6 characters.";

    } else {

        if ($controller->register($username, $password)) {

            $success = "Account created! You can now login.";

        } else {

            $error = "Username already taken. Please choose another.";

        }

    }

}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Register</title>

    <link rel="stylesheet"
          href="assets/style.css">

</head>

<body>

<div class="flex-center auth-container">

    <div class="card auth-card">

        <h2 class="mb-2">Register</h2>

        <?php if ($error != "") { ?>

            <div class="alert alert-danger">
                <?php echo $error; ?>
            </div>

        <?php } ?>

        <?php if ($success != "") { ?>

            <div class="alert alert-success">
                <?php echo $success; ?>
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

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password"
                       name="confirm_password"
                       required>
            </div>

            <button class="btn btn-primary"
                    type="submit"
                    name="register">
                Register
            </button>

        </form>

        <p style="margin-top: 1rem; text-align: center;">
            Already have an account?
            <a href="login.php">Login here</a>
        </p>

    </div>

</div>

</body>

</html>