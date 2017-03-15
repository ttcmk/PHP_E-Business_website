<?php
require_once 'functions.php';

$conn = connectDB();

$productID = $_POST['productID'];
$productName = $_POST['productName'];
$amount = $_POST['amount'];
$price = $_POST['price'];
$kind = $_POST['kind'];

$price = intval($price);
$amount = intval($amount);

$price = abs($price);
$amount = abs($amount);



mysqli_query($conn, "update Product set name = '$productName', inventory_amount = $amount, price = $price, kind = '$kind' where ProductID = '$productID'");

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Administrator</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="jumbotron">
    <div class="container">
        <h1>Modification Succeed!</h1>
        <p>Please click Return for More Operations</p>
        <p><a class="btn btn-info btn-lg" role="button" target='_self'
              onclick="window.location.href='Administrator.php'">Return</a></p>
    </div>
</div>
</body>
</html>



