<?php
require_once 'functions.php';

$productID = $_POST['productID'];

$conn = connectDB();

mysqli_query($conn, "delete from Product where ProductID = '$productID'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Administrator</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="jumbotron">
    <div class="container">
        <h1>Deletion Succeed!</h1>
        <p>Please click Return for More Operations</p>
        <p><a class="btn btn-info btn-lg" role="button" target='_self' onclick="window.location.href='Administrator.php'">Return</a></p>
    </div>
</div>
</body>
</html>
