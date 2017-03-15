<?php
require_once 'functions.php';

$conn = connectDB();

$id = $_POST['id'];
$addressid = $_POST['addressid'];
$homeid = $_POST['homeid'];
$name = $_POST['name'];
$street = $_POST['street'];
$zipcode = $_POST['zipcode'];
$city = $_POST['city'];
$state = $_POST['state'];
$gender = $_POST['gender'];
$age = $_POST['age'];
$marriage = $_POST['marriage'];
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
            <a class="navbar-brand" href="#">Modify Home Customer</a>
        </div>

        <form class="navbar-form navbar-left" role="search" action="ManageUsers.php" method="post">
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-menu-left"></span>Return</button>
        </form>
    </div>
</nav>

<div class="container">
    <?php

    echo "<form action='User_Modify_Comfirm.php' method='post'>
                <input type='hidden' value='$id' name='id'>
                <input type='hidden' value='$homeid' name='homeid'>
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
                <h2><small>Gender</small></h2>
                <input type='text' name='gender' class='form-control' value='$gender' required>
                <h2><small>Age</small></h2>
                <input type='text' name='age' class='form-control' value='$age' required>
                <h2><small>Marriage status</small></h2>
                <input type='text' name='marriage' class='form-control' value='$marriage' required>
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
