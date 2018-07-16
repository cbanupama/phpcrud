<?php
require_once 'databaseAddress.php';
//CRUD
//create
function createAddress($line1,$line2,$city,$state,$post_code,$country) {
    $createAddressQuery = "INSERT INTO address(line1,line2,city,state,post_code,country) VALUES ('{$line1}','{$line2}','{$city}','{$state}','{$post_code}','{$country}')";
    return mysqli_query(getConnection(),$createAddressQuery);
}
//read
function getAddress($id) {
    $getAddressQuery = "SELECT * FROM address WHERE id = $id";
    return mysqli_query(getConnection(),$getAddressQuery);
}
//update
function updateAddress($id,$line1,$line2,$city,$state,$post_code,$country) {
    $updateAddressQuery = "UPDATE address SET line1 = '{$line1}',line2 = '{$line2}',city = '{$city}',state = '{$state}',post_code = '{$post_code}',country = '{$country}' WHERE id = $id";
    return mysqli_query(getConnection(),$updateAddressQuery);
}
//delete
function deleteAddress($id) {
    $deleteAddressQuery = "DELETE FROM address WHERE id = $id";
    return mysqli_query(getConnection(),$deleteAddressQuery);

}
function getAllAddress()
{
    $allAddressQuery = "SELECT * FROM address";
    return mysqli_query(getConnection(), $allAddressQuery);
}
