<?php
require_once 'functions.php';

$conn = connectDB();

$productName = $_POST['productName'];
$amount = $_POST['amount'];
$price = $_POST['price'];
$kind = $_POST['kind'];

$price = intval($price);
$amount = intval($amount);

$price = abs($price);
$amount = abs($amount);

$result_ID = mysqli_query($conn, "select max(ProductID) as ProductID from Product");
$result_ID_arr = mysqli_fetch_assoc($result_ID);
$productID = $result_ID_arr['ProductID'] + 1;

$duplicate = mysqli_query($conn, "select * from Product where name = '$productName'");
$duplicate_count = mysqli_num_rows($duplicate);

if($duplicate_count){
    echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>Administrator</title>
    <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\">
</head>
<body>
<div class=\"jumbotron\">
    <div class=\"container\">
        <h1>Addition Failed!</h1>
        <p>There already exits a product named $productName.</p>
        <p>Please click Return to modify</p>
        <p><a class=\"btn btn-danger btn-lg\" role=\"button\" target='_self' onclick=\"javascript: history.back(-1);\">Return</a></p>
    </div>
</div>
</body>
</html>";

    die();
}

mysqli_query($conn, "insert into Product values('$productID','$productName', $amount, $price, '$kind')");

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
        <h1>Addtion Succeed!</h1>
        <p>Please click Return for More Operations</p>
        <p><a class="btn btn-info btn-lg" role="button" target='_self' onclick="window.location.href='Administrator.php'">Return</a></p>
    </div>
</div>
</body>
</html>


