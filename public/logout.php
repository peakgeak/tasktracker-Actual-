<?php

session_start();
session_destroy();

header("Location: /tasktracker/public/login.php");
exit;