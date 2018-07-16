<?php

require_once 'includes/functions.php';

if(isset($_GET['action']) && !empty($_GET['action']) && isset($_GET['id']) && !empty($_GET['id'])) {
    if($_GET['action'] === 'delete') {
        deleteUser($_GET['id']);
    }
    if($_GET['action'] === 'edit') {
        $userToEdit = mysqli_fetch_row(getUser($_GET['id']));
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $fullName = $email = $phone = null;
    $errors = [];

    // validation for full name
    if (isset($_POST['full_name']) && !empty($_POST['full_name'])) {
        $fullName = $_POST['full_name'];
    } else {
        $errors['full_name'] = 'Please enter name';
    }

    //validation for email
    if (isset($_POST['email']) && !empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $email = $_POST['email'];
    } else {
        $errors['email'] = 'Please enter a valid email';
    }

    //validation for phone
    if (isset($_POST['phone']) && !empty($_POST['phone']) && strlen($_POST['phone']) == 10) {
        $phone = $_POST['phone'];
    } else {
        $errors['phone'] = 'Please enter a valid 10 digit number';
    }

    if (count($errors) == 0) {
        if(isset($_POST['method']) && $_POST['method'] === 'put') {
            $id = $_POST['id'];
            updateUser($id, $fullName, $email, $phone);
        } else {
            $queryResult = createUser($fullName, $email, $phone);
            if (!$queryResult) {
                die('Error while creating user');
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
    <title>PHP Crud</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        html, body {
            padding-top: 60px;
            background-color: white;
        }
    </style>
</head>
<body>
<div class="container">
    <form class="form-inline" method="post" action="index.php">
        <input type="hidden" name="method" value="<?php if(isset($userToEdit) && !empty($userToEdit)) { echo 'put'; } ?>">
        <input type="hidden" name="id" value="<?php if(isset($userToEdit) && !empty($userToEdit)) { echo $userToEdit[0]; } ?>">
        <div class="form-group <?php if (isset($errors['full_name']) && !empty($errors['full_name'])) { echo 'has-error'; } ?>">
            <label class="sr-only" for="full_name">Full name</label>
            <input type="text" required class="form-control" id="full_name" placeholder="Full name" name="full_name" value="<?php if(isset($userToEdit) && !empty($userToEdit)) { echo $userToEdit[1]; } ?>">
        </div>
        <div class="form-group <?php if (isset($errors['email']) && !empty($errors['email'])) { echo 'has-error'; } ?>">
            <label class="sr-only" for="email">Email</label>
            <input type="email" required class="form-control" id="email" placeholder="Email" name="email" value="<?php if(isset($userToEdit) && !empty($userToEdit)) { echo $userToEdit[2]; } ?>">
        </div>
        <div class="form-group <?php if (isset($errors['phone']) && !empty($errors['phone'])) { echo 'has-error'; } ?>">
            <label class="sr-only" for="phone">Phone</label>
            <input type="tel" required class="form-control" id="phone" placeholder="Phone" name="phone" value="<?php if(isset($userToEdit) && !empty($userToEdit)) { echo $userToEdit[3]; } ?>">
        </div>
        <button type="submit" class="btn btn-default">Save</button>
    </form>
</div>
<br>
<div class="container">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php $users = getAllUsers(); ?>
        <?php while ($user = mysqli_fetch_assoc($users)): ?>
            <tr>
                <td><?php echo $user['full_name'] ?></td>
                <td><?php echo $user['email'] ?></td>
                <td><?php echo $user['phone'] ?></td>
                <td>
                    <a href="index.php?action=edit&id=<?php echo $user['id']; ?>">
                        <span class="glyphicon glyphicon-edit text-warning"></span>
                    </a>
                    <a href="index.php?action=delete&id=<?php echo $user['id']; ?>">
                        <span class="glyphicon glyphicon-remove text-danger"></span>
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>