<?php

class TaskController {

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

    function addTask($account_id, $title, $description)
    {
        $sql = "INSERT INTO tasks(account_id, title, description)
                VALUES('$account_id', '$title', '$description')";

        return $this->conn->query($sql);
    }

    function getTasks($account_id)
    {
        $sql = "SELECT * FROM tasks
                WHERE account_id='$account_id'";

        return $this->conn->query($sql);
    }

function getTaskById($id)
{
    $sql = "SELECT * FROM tasks
            WHERE id='$id'";

    $result = $this->conn->query($sql);

    return $result->fetch_assoc();
}

function updateTask($id, $title, $description)
{
    $sql = "UPDATE tasks
            SET title = ?,
                description = ?
            WHERE id = ?";

    $stmt = $this->conn->prepare($sql);

    $stmt->bind_param(
        "ssi",
        $title,
        $description,
        $id
    );

    return $stmt->execute();
}

    function deleteTask($id)
    {
        $sql = "DELETE FROM tasks WHERE id='$id'";

        return $this->conn->query($sql);
    }

    function completeTask($id)
    {
        $sql = "UPDATE tasks
                SET status='Completed'
                WHERE id='$id'";

        return $this->conn->query($sql);
    }
}