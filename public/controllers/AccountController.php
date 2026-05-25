<?php

class AccountController {

    private $conn;

    function __construct($server_name, $username, $password, $db_name)
    {
        $this->conn = new mysqli(
            $server_name,
            $username,
            $password,
            $db_name
        );
    }

    function register($username, $password)
    {
        $hashed_password = password_hash(
            $password,
            PASSWORD_DEFAULT
        );

        $sql = "INSERT INTO accounts(username, password)
                VALUES('$username', '$hashed_password')";

        return $this->conn->query($sql);
    }

function login($username, $password)
{
    // Only search by username first, then verify password hash
    $sql = "SELECT * FROM accounts WHERE username='$username'";

    $result = $this->conn->query($sql);

    if ($result->num_rows > 0) {

        $account = $result->fetch_assoc();

        // Verify password against the hash
        if (password_verify($password, $account["password"])) {

            $_SESSION["account_id"] = $account["id"];   // changed from user_id
            $_SESSION["username"]   = $account["username"];

            return true;
        }
    }

    return false;
}
}