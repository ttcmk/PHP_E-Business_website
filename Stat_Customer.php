<?php
require_once 'functions.php';

$conn = connectDB();

$productID = $_POST['productID'];
$productName = $_POST['productName'];
$price = $_POST['price'];
$customerType = $_POST['customerType'];

if($customerType == 'Home'){
    $query = "select C.name as customerName, sum(T.quantity) as quantity, sum(P.price * T.quantity) as totalAmount from Home_Customer C, Product P, Home_Transaction T where P.ProductID = '$productID' and C.Home_CustomerID = T.Home_CustomerID and T.ProductID = P.ProductID group by C.Home_CustomerID order by totalAmount DESC";
}else{//customerType = Business
    $query = "select C.name as customerName, sum(T.quantity) as quantity, sum(P.price * T.quantity) as totalAmount from Business_Customer C, Product P, Business_Transaction T where P.ProductID = '$productID' and C.Business_CustomerID = T.Business_CustomerID and T.ProductID = P.ProductID group by C.Business_CustomerID order by totalAmount DESC";
}
?>

<?php
require_once 'functions.php';

$conn = connectDB();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Ranking</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-inverse" role="navigation"">
<div class="container-fluid">
    <div class="navbar-header">
        <a class="navbar-brand" onclick="javascript:history.back(-1);"><span class="glyphicon glyphicon-menu-left"></span>Return</a>
    </div>
</div>
</div>
</nav>

<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Customer Ranking of <?php echo $productName?>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-hover">
                <thead>
                <tr class="active">
                    <th>Customer Name</th>
                    <th>Quantity Bought</th>
                    <th>Total Amount</th>
                </tr>
                </thead>
                <?php
                $result = mysqli_query($conn, $query);
                $data_number = mysqli_num_rows($result);

                for($i=0;$i<$data_number;$i++) {
                    $result_arr = mysqli_fetch_assoc($result);
                    $customerName = $result_arr['customerName'];
                    $quantity = $result_arr['quantity'];
                    $total = $result_arr['totalAmount'];

                    echo "<tr>
                        <td>$customerName</td>
                        <td>$quantity</td>
                        <td>$total</td>
                  </tr>";


                }
                ?>

            </table>
        </div>
    </div>

</body>
</html>
