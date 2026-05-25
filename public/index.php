<?php

session_start();

if (isset($_SESSION["account_id"])) {

    header("Location: /tasktracker/public/dashboard.php");

} else {

    header("Location: /tasktracker/public/login.php");

}