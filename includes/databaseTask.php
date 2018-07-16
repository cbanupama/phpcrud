<?php

define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASSWORD','');
define('DB_Name','phpcrud');
define('DB_PORT','3306');

function getConnection() {
    $connection =  mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_Name,DB_PORT);
    return $connection;
}
if(!getConnection()) {
    die('Database connection failed');
}
function setUp($connection) {
//    $createTaskTable = "create table tasks (id int auto_increment primary key, task varchar(255),start_date date ,end_date date)";
//    if (!mysqli_query($connection,$createTaskTable)) {
//        die('Error while creating table');
//    }
}
setup(getConnection());