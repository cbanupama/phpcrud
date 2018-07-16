<?php
require_once 'databaseTask.php';
function createTask($task,$startDate,$endDate) {
    $createTaskQuery = "INSERT INTO tasks(task,start_date,end_date) VALUES  ('{$task}','{$startDate}','{$endDate}')";
    return mysqli_query(getConnection() ,$createTaskQuery);
}
function getTask($id)
{
    $getTaskQuery = "SELECT * FROM tasks where id = $id";
    return mysqli_query(getConnection(), $getTaskQuery);
}

function updateTask($id, $task, $startDate, $endDate)
{
    $updateTaskQuery = "UPDATE tasks SET task = '{$task}', start_date = '{$startDate}', end_date = '{$endDate}' where id = $id";
    return mysqli_query(getConnection(), $updateTaskQuery);
}

function deleteTask($id)
{
    $deleteTaskQuery = "DELETE from tasks where id=$id";
    return mysqli_query(getConnection(), $deleteTaskQuery);
}

function getAllTasks()
{
    $allTasksQuery = "SELECT * FROM tasks";
    return mysqli_query(getConnection(), $allTasksQuery);
}

