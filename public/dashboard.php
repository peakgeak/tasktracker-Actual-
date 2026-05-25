<?php

session_start();

require 'controllers/TaskController.php';
require_once 'database.config.php';

if (!isset($_SESSION["account_id"])) {

    header("Location: /tasktracker/public/login.php");
    exit;

}

$taskController = new TaskController(
    $server_name,
    $username,
    $password,
    $db_name
);

$account_id = $_SESSION["account_id"];


// ADD TASK
if (isset($_POST["add"])) {

    $title       = trim($_POST["title"]);
    $description = trim($_POST["description"]);

    if ($title !== "") {

        $taskController->addTask(
            $account_id,
            $title,
            $description
        );

    }

    header("Location: dashboard.php");
    exit;

}


// COMPLETE TASK
if (isset($_GET["complete"])) {

    $taskController->completeTask(
        (int) $_GET["complete"]
    );

    header("Location: dashboard.php");
    exit;

}


// DELETE TASK
if (isset($_GET["delete"])) {

    $taskController->deleteTask(
        (int) $_GET["delete"]
    );

    header("Location: dashboard.php");
    exit;

}


// UPDATE TASK
if (isset($_POST["update"])) {

    $task_id    = (int) $_POST["task_id"];
    $title      = trim($_POST["title"]);
    $description = trim($_POST["description"]);

    if ($title !== "") {

        $taskController->updateTask(
            $task_id,
            $title,
            $description
        );

    }

    header("Location: dashboard.php");
    exit;

}


// GET TASK FOR EDITING
$editTask = null;

if (isset($_GET["edit"])) {

    $editTask = $taskController->getTaskById(
        (int) $_GET["edit"]
    );

}


$tasks = $taskController->getTasks($account_id);

?>

<?php require 'assets/header.php'; ?>


<h1 class="mb-2">Dashboard</h1>


<div class="card mb-2">

    <?php if ($editTask) { ?>

        <h2>Edit Task</h2>

        <form method="POST">

            <input type="hidden"
                   name="task_id"
                   value="<?php echo $editTask["id"]; ?>">

            <div class="form-group">

                <label>Task Title</label>

                <input type="text"
                       name="title"
                       value="<?php
                            echo htmlspecialchars(
                                $editTask["title"]
                            );
                       ?>"
                       required>

            </div>

            <div class="form-group">

                <label>Description</label>

                <textarea name="description"><?php
                    echo htmlspecialchars(
                        $editTask["description"]
                    );
                ?></textarea>

            </div>

            <button class="btn btn-primary"
                    name="update">

                Update Task

            </button>

        </form>

    <?php } else { ?>

        <h2>Add Task</h2>

        <form method="POST">

            <div class="form-group">

                <label>Task Title</label>

                <input type="text"
                       name="title"
                       required>

            </div>

            <div class="form-group">

                <label>Description</label>

                <textarea name="description"></textarea>

            </div>

            <button class="btn btn-primary"
                    name="add">

                Add Task

            </button>

        </form>

    <?php } ?>

</div>


<div class="card">

    <h2 class="mb-2">Your Tasks</h2>

    <table class="table">

        <tr>

            <th>Title</th>
            <th>Description</th>
            <th>Status</th>
            <th>Actions</th>

        </tr>

        <?php while ($task = $tasks->fetch_assoc()) { ?>

        <tr>

            <td>

                <?php
                    echo htmlspecialchars(
                        $task["title"]
                    );
                ?>

            </td>

            <td>

                <?php
                    echo htmlspecialchars(
                        $task["description"]
                    );
                ?>

            </td>

            <td>

                <?php echo $task["status"]; ?>

            </td>

            <td>

                <?php if ($task["status"] !== "Completed") { ?>

                    <a class="btn btn-success"
                       href="?complete=<?php echo $task["id"]; ?>">

                        Complete

                    </a>

                <?php } ?>


                <a class="btn btn-primary"
                   href="?edit=<?php echo $task["id"]; ?>">

                    Edit

                </a>


                <a class="btn btn-danger"
                   href="?delete=<?php echo $task["id"]; ?>">

                    Delete

                </a>

            </td>

        </tr>

        <?php } ?>

    </table>

</div>

<?php require 'assets/footer.php'; ?>