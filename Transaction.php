<?php
require_once 'functions.php';

$conn = connectDB();

$userID = $_POST['userID'];
$username = $_POST['username'];
$customerType = $_POST['customerType'];
$productID = $_POST['productID'];
$productName = $_POST['productName'];
$amount = $_POST['amount'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];
$salespersonID = $_POST['salespersonID'];
$regionID = $_POST['regionID'];
$time = date('Y-m-d h:m:s', time());

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="Bootstrap/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-inverse" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Transaction</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li><a href=""><?php echo $username?></a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Action<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="Login.html">Log out</a></li>
                </ul>
            </li>
        </ul>
    </div>
    </div>
</nav>

<script src="Bootstrap/jquery-2.1.1.min.js"></script>
<script src="Bootstrap/bootstrap.min.js"></script>
<script>
    $("#mytab a").click(function (e) {
        e.preventDefault();
        $(this).tab("show");
    })
</script>


<?php

$find_salespersonName = mysqli_query($conn, "select name from Salesperson where SalespersonID = $salespersonID");
$result_salespersonName = mysqli_fetch_assoc($find_salespersonName);
$salespersonName = $result_salespersonName['name'];

$find_inventoryAmount = mysqli_query($conn, "select inventory_amount from Product where ProductID = $productID");
$result_inventoryAmount = mysqli_fetch_assoc($find_inventoryAmount);
$amount = $result_inventoryAmount['inventory_amount'];

//judge whether the buying quantity is less than the inventory amount
$value = $amount - $quantity;
if($value < 0){
echo "<div class='container'>
            <div class='alert alert-danger' role='alert'>
                <p>Sorry, the inventory amount is not enough for your purchase. Current inventory amount is $amount.
                <p>Please
                <a class='alert-link' onclick='javascript:history.back(-1);'>return</a>
                and select another quantity or other products.
                </p>
            </div>";
    die();
}

if($customerType == 'Home'){
    $findID = mysqli_query($conn, "select max(orderID) as maxID from Home_Transaction");
    $result_ID = mysqli_fetch_assoc($findID);
    $maxID = $result_ID['maxID'] + 1;

    $insert_query = "insert into Home_Transaction values('$maxID','$time','$salespersonID','$productID', $quantity,'$userID')";
    $update_query = "update Product set inventory_amount = inventory_amount - $quantity where ProductID = $productID";
}else{
    $findID = mysqli_query($conn, "select max(orderID) as maxID from Business_Transaction");
    $result_ID = mysqli_fetch_assoc($findID);
    $maxID = $result_ID['maxID'] + 1;

    $insert_query = "insert into Business_Transaction values('$maxID','$time','$salespersonID','$productID', $quantity,'$userID')";
    $update_query = "update Product set inventory_amount = inventory_amount - $quantity where ProductID = $productID";
}

mysqli_query($conn, $insert_query);
mysqli_query($conn, $update_query);

?>

<div class="container">
    <div class="jumbotron">
        <div class="container">
            <form action="allusers.php" method="post" target="_self">
                <h1>Thank You for Your Order</h1>
                <h3>Order details:</h3>
                <p>Order name: <?php echo $productName?></p>
                <p>Quantity: <?php echo $quantity?></p>
                <p>Total amount: $<?php echo $quantity * $price?></p>

                <input type='hidden' value='<?php echo $regionID?>' name='regionID'>
                <input type='hidden' value='<?php echo $salespersonID?>' name='salespersonID'>
                <input type='hidden' value='<?php echo $userID?>' name='userID'>
                <input type='hidden' value='<?php echo $username?>' name='username'>
                <input type='hidden' value='<?php echo $customerType?>' name='customerType'>

                <button class="btn btn-info btn-lg" type="submit">Continue Shopping</button>
            </form>

<!--            <p><a class="btn btn-info btn-lg" role="button" onclick="javascript:history.back(-1);">Continue shopping</a></p>-->
        </div>
    </div>
</div>

</body>
</html>

