<?php
require_once 'functions.php';

$conn = connectDB();

$id = $_POST['id'];
$addressid = $_POST['addressid'];
$businessid = $_POST['businessid'];
$name = $_POST['name'];
$street = $_POST['street'];
$zipcode = $_POST['zipcode'];
$city = $_POST['city'];
$state = $_POST['state'];
$businesscategory = $_POST['businesscategory'];
$companyname = $_POST['companyname'];
$income = $_POST['income'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Administrator</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Modify Business Customer</a>
        </div>

        <form class="navbar-form navbar-left" role="search" action="ManageUsers.php" method="post">
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-menu-left"></span>Return</button>
        </form>
    </div>
</nav>

<div class="container">
    <?php

    echo "<form action='UserB_Modify_Comfirm.php' method='post'>
                <input type='hidden' value='$id' name='id'>
                <input type='hidden' value='$businessid' name='businessid'>
                <input type='hidden' value='$addressid' name='addressid'>
                <h2><small>User Name</small></h2>
                <input type='text' name='name' class='form-control' value='$name'>
                <h2><small>Street</small></h2>
                <input type='text' name='street' class='form-control' value='$street' required>
                <h2><small>Zipcode</small></h2>
                <input type='text' name='zipcode' class='form-control' value='$zipcode' required>
                <h2><small>City</small></h2>
                <input type='text' name='city' class='form-control' value='$city' required>
                <h2><small>State</small></h2>
                <input type='text' name='state' class='form-control' value='$state' required>
                <h2><small>Business Category</small></h2>
                <input type='text' name='businesscategory' class='form-control' value='$businesscategory' required>
                <h2><small>Company Name</small></h2>
                <input type='text' name='companyname' class='form-control' value='$companyname' required>
                <h2><small>Income</small></h2>
                <div class='input-group'>
                <span class='input-group-addon'>$</span>
                <input type='text' name='income' class='form-control' value='$income' required>
                </div>
                <br/>
                <button type='submit' class='btn btn-info btn-lg'>Modify</button>
                </form>";

    ?>
</div>



<script src="jquery-2.1.1.min.js"></script>
<script src="bootstrap.min.js"></script>

</body>
</html>
