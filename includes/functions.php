<?php

require_once 'database.php';

function createUser($fullName, $email, $phone)
{
    $createUserQuery = "INSERT INTO users(full_name, email, phone) VALUES ('{$fullName}', '{$email}', '{$phone}')";
    return mysqli_query(getConnection(), $createUserQuery);
}

function getUser($id)
{
    $getUserQuery = "SELECT * FROM users where id = $id";
    return mysqli_query(getConnection(), $getUserQuery);
}

function updateUser($id, $fullName, $email, $phone)
{
    $updateUserQuery = "UPDATE users SET full_name = '{$fullName}', email = '{$email}', phone = '{$phone}' where id = $id";
    return mysqli_query(getConnection(), $updateUserQuery);
}


function deleteUser($id)
{
    $deleteUserQuery = "DELETE from users where id=$id";
    return mysqli_query(getConnection(), $deleteUserQuery);
}

function getAllUsers()
{
    $allUsersQuery = "SELECT * FROM users";
    return mysqli_query(getConnection(), $allUsersQuery);
}


