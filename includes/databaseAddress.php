<?php

define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASSWORD','');
define('DB_NAME','phpcrud');
define('DB_PORT',3306);

function getConnection() {
    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);
    return $connection;
}
if(!getConnection()) {
    die('Database connection failed');
}
function setUp($connection) {
//    $createAddressTable = "create table address (id int(11) auto_increment primary key, line1 varchar(255) , line2 varchar(255) , city varchar(255) , state varchar(255) , post_code int (11) ,country varchar(255)) ";
//    if (!mysqli_query($connection, $createAddressTable)){
//        die('Error while Creating address table');
//    }

}
setUp(getConnection());