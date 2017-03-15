<?php
require_once 'functions.php';

$userID = $_GET['userID'];
$username = $_GET['name'];
$customerType = $_GET['customertype'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Past Orders</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-inverse" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Past Orders</a>
        </div>
         <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav" id="mytab1">
                    <li><a onclick="javascript:history.back(-1);"><span class="glyphicon glyphicon-menu-left"></span>Return</a></li>
                </ul>

        <form action="ViewOrders.php" method="get">
            <ul class="nav navbar-nav navbar-right">
                <li><a href=""><?php echo $username?></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Action<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="Login.html">Log out</a></li>
                    </ul>
                </li>
            </ul>
        </form>
    </div>
    </div>
</nav>

<nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
    <ol class="breadcrumb">
        <li><a href="#">Refresh</a></li>
        <li><a href="http://localhost:8888/phpMyAdmin/index.php">Data</a></li>
        <li><a href="#">Contact</a></li>
    </ol>
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
if($customerType == 'Home'){
    $query = "select T.orderID, T.order_date, T.quantity, P.name AS ProductName, P.price, P.kind, S.name AS SalespersonName, S.jobtitle, S.StoreID from Home_Transaction T, Salesperson S, Product P where T.Home_CustomerID = '$userID' and P.ProductID = T.ProductID and T.SalespersonID = S.SalespersonID ";
}else{
    $query = "select T.orderID, T.order_date, T.quantity, P.name AS ProductName, P.price, P.kind, S.name AS SalespersonName, S.jobtitle, S.StoreID from Business_Transaction T, Salesperson S, Product P where T.Business_CustomerID = '$userID' and P.ProductID = T.ProductID and T.SalespersonID = S.SalespersonID ";
}

$conn = connectDB();
$result = mysqli_query($conn, $query);
$data_count = mysqli_num_rows($result);

echo "<div class=\"container\" style='padding-bottom: 50px'>
        <table class=\"table table-striped table-hover\">
            <thead>
                <tr class=\"active\">
                    <th>Order Number</th>
                    <th>Order Date</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>($)Price</th>
                    <th>($)Total Amount</th>
                    <th>Kind</th>
                    <th>Salesperson Name</th>
                    <th>Jobtitle</th>
                    <th>Store</th>
                </tr>
            </thead>";
for ($i = 0; $i < $data_count; $i++) {
    $result_arr = mysqli_fetch_assoc($result);
    $orderid = $result_arr['orderID'];
    $orderdate = $result_arr['order_date'];
    $quantity = $result_arr['quantity'];
    $productName = $result_arr['ProductName'];
    $price = $result_arr['price'];
    $kind = $result_arr['kind'];
    $salespersonName = $result_arr['SalespersonName'];
    $jobtitle = $result_arr['jobtitle'];
    $storeid = $result_arr['StoreID'];
    $amount = $quantity * $price;


    echo "<tr><td>$orderid</td><td>$orderdate</td><td>$productName</td><td>$quantity</td><td>$price</td><td>$amount</td><td>$kind</td>
            <td>$salespersonName</td><td>$jobtitle</td><td>$storeid</td>
                </tr>";
}

echo "</table>
    </div>";
?>

</body>
</html>
