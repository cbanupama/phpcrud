<?php

define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASSWORD', '');
define('DB_NAME', 'phpcrud');
define('DB_PORT', 3306);

function getConnection() {
    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);
    return $connection;
}

if(!getConnection()) {
    die('Database connection failed');
}

// after creating phpcrud database
// run this code to create users table;
function setup($connection) {
//    $createUsersTable = "create table users (id int auto_increment primary key, full_name varchar(255), email varchar(255), phone varchar(255))";
//    if(!mysqli_query($connection, $createUsersTable)) {
//        die('Error while creating users table');
//    }
//    $createTasksTable = "create table tasks (id int auto_increment primary key, task varchar(255), start_date date, end_date date)";
//    if(!mysqli_query($connection, $createTasksTable)) {
//        die('Error while creating tasks table');
//    }
}

setup(getConnection());

