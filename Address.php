<?php
require_once 'includes/functionAddress.php';
if(isset($_GET['action']) && !empty($_GET['action']) && isset($_GET['id']) && !empty($_GET['id'])) {
    if($_GET['action'] === 'delete') {
        deleteAddress($_GET['id']);
    }
    if($_GET['action'] === 'edit') {
        $AddressToEdit = mysqli_fetch_row(getAddress($_GET['id']));
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $line1 = $line2 = $city = $state = $post_code = $country = null;
    $errors = [];
//print_r($_POST);

//validation for link1
    if (isset($_POST['line1']) && !empty($_POST['line1'])) {
        $line1 = $_POST['line1'];
    } else {
        $errors['line1'] = 'Please Enter Link1';
    }

//validation for link2
    if (isset($_POST['line2']) && !empty($_POST['line2'])) {
        $line2 = $_POST['line2'];
    } else {
        $errors['line2'] = 'Please Enter Link2';
    }
//validation for city
    if (isset($_POST['city']) && !empty($_POST['city'])) {
        $city = $_POST['city'];
    } else {
        $errors['city'] = 'Please Enter city';
    }
//validation for state
    if (isset($_POST['state']) && !empty($_POST['state'])) {
        $state = $_POST['state'];
    } else {
        $errors['state'] = 'Please Enter State';
    }
//validation for postcode
    if (isset($_POST['post_code']) && !empty($_POST['post_code'])) {
        $post_code = $_POST['post_code'];
    } else {
        $errors['post_code'] = 'Please Enter Postcode';
    }
//validation for country
    if (isset($_POST['country']) && !empty($_POST['country'])) {
        $country = $_POST['country'];
    } else {
        $errors['country'] = 'Please Enter country';
    }

    if (count($errors) == 0) {
        if(isset($_POST['method']) && $_POST['method'] === 'put') {
            $id = $_POST['id'];
            updateAddress($id,$line1,$line2,$city,$state,$post_code,$country);
        } else {
            $queryResult =  createAddress($line1,$line2,$city,$state,$post_code,$country);
//            var_dump($queryResult);
            if (!$queryResult) {
                die('Error while creating address');
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
    <title>Address Details</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h1>Address Details</h1>
    <form class="form-horizontal" action="Address.php" method="post">

        <input type="hidden" name="method" value="<?php if(isset($AddressToEdit) && !empty($AddressToEdit)) { echo 'put'; } ?>">
        <input type="hidden" name="id" value="<?php if(isset($AddressToEdit) && !empty($AddressToEdit)) { echo $AddressToEdit[0]; } ?>">
        <div class="form-group <?php if (isset($errors['line1']) && !empty($errors['line1'])) { echo 'has-error'; } ?>">
            <label class="control-label col-sm-2" for="line1">Line 1</label>
            <div class="col-sm-10">
                <input type="text" name="line1" class="form-control" id="line1" placeholder="Address Line 1" value="<?php if (isset($AddressToEdit) && !empty($AddressToEdit)) { echo $AddressToEdit[1]; } ?>">
            </div>
        </div>

        <div class="form-group <?php if (isset($errors['line2']) && !empty($errors['line2'])) { echo 'has-error'; } ?>">
            <label class="control-label col-sm-2" for="line2">Line 2</label>
            <div class="col-sm-10">
                <input type="text" name="line2" class="form-control" id="line2" placeholder="Address Line 2" value="<?php if (isset($AddressToEdit) && !empty($AddressToEdit)) { echo $AddressToEdit[2]; } ?>">
            </div>
        </div>

        <div class="form-group <?php if (isset($errors['city']) && !empty($errors['city'])) { echo 'has-error' ;} ?>">
            <label class="control-label col-sm-2" for="city">City</label>
            <div class="col-sm-10">
                <input type="text" name="city" class="form-control" id="city" placeholder="City" value="<?php if (isset($AddressToEdit) && !empty($AddressToEdit)) { echo $AddressToEdit[3]; } ?>">
            </div>
        </div>

        <div class="form-group ">
            <label class="control-label col-sm-2" for="state">State</label>

                <div class="col-sm-4">
                <input type="text" name="state" class="form-control" id="state" placeholder="State" value="<?php if (isset($AddressToEdit) && !empty($AddressToEdit)) { echo $AddressToEdit[4]; } ?>">
                </div>
                <label class="control-label col-sm-2" for="postcode">Postcode</label>
                <div class="col-sm-4">
                    <input type="text" name="post_code" class="form-control" id="postcode" placeholder="Post Code" value="<?php if (isset($AddressToEdit) && !empty($AddressToEdit)) { echo $AddressToEdit[5]; } ?>">
                </div>

        </div>

        <div class="form-group <?php if (isset($errors['country']) && !empty($errors['country'])) {echo 'has-error'; } ?>">
            <label class="control-label col-sm-2" for="country">Country</label>
            <div class="col-sm-10">
                <input type="text" name="country" class="form-control" id="country" placeholder="Country" value="<?php if (isset($AddressToEdit) && !empty($AddressToEdit)) { echo $AddressToEdit[6]; } ?>">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10 ">
                <button type="submit" name="save" class="btn btn-primary pull-right">Save</button>
                <button type="submit" name="cancel" class="btn btn-default pull-right">Cancel</button>
            </div>
        </div>

    </form>
</div>
<br>
<div class="container">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Line1</th>
            <th>Line2</th>
            <th>City</th>
            <th>State</th>
            <th>postcode</th>
            <th>Country</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php $address1 = getAllAddress(); ?>
        <?php while ($address = mysqli_fetch_assoc($address1)): ?>

        <tr>
            <td><?php echo $address['line1'] ?></td>
            <td><?php echo $address['line2'] ?></td>
            <td><?php echo $address['city'] ?></td>
            <td><?php echo $address['state'] ?></td>
            <td><?php echo $address['post_code'] ?></td>
            <td><?php echo $address['country'] ?></td>
            <td>

                <a href="Address.php?action=edit&id=<?php echo $address['id']; ?>">
                <span class="glyphicon glyphicon-pencil text-info"></span>
                </a>
                <a href="Address.php?action=delete&id=<?php echo $address['id']; ?>">
                    <span class="glyphicon glyphicon-remove text-danger"></span>
                </a>
            </td>
        </tr>
        <?php endwhile; ?>
        </tbody>

    </table>
</div>



<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>