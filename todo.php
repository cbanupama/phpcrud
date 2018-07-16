<?php
require_once 'includes/functionsTask.php';
if(isset($_GET['action']) && !empty($_GET['action']) && isset($_GET['id']) && !empty($_GET['id'])) {
    if($_GET['action'] === 'delete') {
        deleteTask($_GET['id']);
    }
    if($_GET['action'] === 'edit') {
        $TaskToEdit = mysqli_fetch_row(getTask($_GET['id']));
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $task = $start_date = $end_date = null;
    $errors = [];

    // validation for task
    if (isset($_POST['task']) && !empty($_POST['task'])) {
        $task = $_POST['task'];
    } else {
        $errors['task'] = 'Please enter task';
    }

    //validation for start date
    if (isset($_POST['start_date']) && !empty($_POST['start_date'])) {
        $startDate = $_POST['start_date'];
    } else {
        $errors['start_date'] = 'Please enter start date';
    }

    //validation for end date
    if (isset($_POST['end_date']) && !empty($_POST['end_date'])) {
        $endDate = $_POST['end_date'];
    } else {
        $errors['end_date'] = 'Please enter end date';
    }

    if (count($errors) == 0) {
        if(isset($_POST['method']) && $_POST['method'] === 'put') {
            $id = $_POST['id'];
            updateTask($id, $task, $startDate, $endDate);
        } else {
            $queryResult = createTask($task, $startDate, $endDate);
            if (!$queryResult) {
                die('Error while creating tasks');
            }
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tasks</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <form class="form-inline" method="post" action="todo.php">
        <input type="hidden" name="method" value="<?php if(isset($TaskToEdit) && !empty($TaskToEdit)) { echo 'put'; } ?>">
        <input type="hidden" name="id" value="<?php if(isset($TaskToEdit) && !empty($TaskToEdit)) { echo $TaskToEdit[0]; } ?>">
        <div class="form-group <?php if (isset($errors['task']) && !empty($errors['task'])) { echo 'has-error'; } ?>">
            <label for="task" class="sr-only">Task:</label>
            <input type="text" name="task" class="form-control" id="task" placeholder="Task" value="<?php if(isset($TaskToEdit) && !empty($TaskToEdit)) { echo $TaskToEdit[1]; } ?>">
        </div>

        <div class="form-group <?php if (isset($errors['start_date']) && !empty($errors['start_date'])) { echo 'has-error'; } ?>">
            <label for="start" class="sr-only">Start Date:</label>
            <input type="date" name="start_date" class="form-control" id="start" placeholder="Start Date" value="<?php if(isset($TaskToEdit) && !empty($TaskToEdit)) { echo $TaskToEdit[2]; } ?>">
        </div>

        <div class="form-group <?php if (isset($errors['end_date']) && !empty($errors['end_date'])) { echo 'has-error'; } ?>">
            <label for="end" class="sr-only">End Date:</label>
            <input type="date" name="end_date" class="form-control" id="end" placeholder="End Date" value="<?php if(isset($TaskToEdit) && !empty($TaskToEdit)) { echo $TaskToEdit[3]; } ?>">
        </div>
        <input type="submit" class="btn btn-success" value="save">
    </form>

</div>
<br>
<div class="container">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Task</th>
            <th>start Date</th>
            <th>end Date</th>
            <th>Actions</th>

        </tr>
        </thead>
        <tbody>
        <?php $tasks = getAllTasks(); ?>
        <?php while ($task = mysqli_fetch_assoc($tasks)): ?>
            <tr>
                <td><?php echo $task['task'] ?></td>
                <td><?php echo $task['start_date'] ?></td>
                <td><?php echo $task['end_date'] ?></td>
                <td>
                    <a href="todo.php?action=edit&id=<?php echo $task['id']; ?>">
                        <span class="glyphicon glyphicon-edit text-warning"></span>
                    </a>
                    <a href="todo.php?action=delete&id=<?php echo $task['id']; ?>">
                        <span class="glyphicon glyphicon-remove text-danger"></span>
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>