<!DOCTYPE html>
<html>
<head>

    <title>Task Tracker</title>

    <link rel="stylesheet"
          href="assets/style.css">

</head>

<body>

<nav class="navbar">

    <div class="container flex-between">

        <div class="nav-brand">
            Task Tracker
        </div>

        <div class="nav-links">

            <?php if(isset($_SESSION["username"])) { ?>

                <span>
                    Welcome,
                    <?php echo $_SESSION["username"]; ?>
                </span>

                <a href="/tasktracker/public/logout.php">
                    Logout
                </a>

            <?php } else { ?>

                <a href="/tasktracker/public/login.php">Login</a>
                <a href="/tasktracker/public/register.php">Register</a>

            <?php } ?>

        </div>

    </div>

</nav>

<div class="container section">