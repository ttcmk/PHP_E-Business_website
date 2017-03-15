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

mysqli_query($conn, "update Business_Customer set name = '$name' where Business_CustomerID = '$id'");

mysqli_query($conn, "update Address set street = '$street' where AddressID = '$addressid'");

mysqli_query($conn, "update Business set business_category = '$businesscategory', company_name = '$companyname', company_gross_annual_income  = '$income' where BusinessID = '$businessid'");

if(checkZipcode($zipcode)){
    mysqli_query($conn, "insert into Zipcode values('$zipcode','$city','$state')");
    mysqli_query($conn, "update Address set zipcode = '$zipcode' where AddressID = '$addressid'");
}else{
    mysqli_query($conn, "update Address set zipcode = '$zipcode' where AddressID = '$addressid'");
}


function checkZipcode($zipcode)
{
    $query = "select zipcode from Zipcode";

    $conn = connectDB();
    $result = mysqli_query($conn, $query);
    $data_count = mysqli_num_rows($result);

    for ($i = 0; $i < $data_count; $i++) {
        $result_arr = mysqli_fetch_assoc($result);
        if ($zipcode == $result_arr['zipcode']) {
            return false;
        }
    }

    return true;
}

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
        <h1>Modification Succeed!</h1>
        <p>Please click Return for More Operations</p>
        <p><a class="btn btn-info btn-lg" role="button" target='_self' onclick="window.location.href='ManageUserB.php'">Return</a></p>
    </div>
</div>
</body>
</html>



