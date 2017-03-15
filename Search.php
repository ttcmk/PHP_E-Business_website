<?php
require_once 'functions.php';

$userID = $_POST['userID'];
$username = $_POST['username'];
$customerType = $_POST['customerType'];
$salespersonID = $_POST['salespersonID'];
$regionID = $_POST['regionID'];
$search = $_POST['search'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
<!--    <link rel="stylesheet" href="Bootstrap/bootstrap.min.css">-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-inverse" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Search Result</a>
        </div>
        <form action="Category.php" method="get">
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav active" id="mytab1">
                    <li><a onclick="javascript:history.back(-1);"><span class="glyphicon glyphicon-menu-left"></span>Return</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Product Category<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a name="category" href="Category.php?category=Appliances&username=<?php echo $username?>&userID=<?php echo $userID?>&customerType=<?php echo $customerType?>&salespersonID=<?php echo $salespersonID?>&regionID=<?php echo $regionID?>">Appliances</a></li>
                            <li><a name="category" href="Category.php?category=Book&username=<?php echo $username?>&userID=<?php echo $userID?>&customerType=<?php echo $customerType?>&salespersonID=<?php echo $salespersonID?>&regionID=<?php echo $regionID?>">Book</a></li>
                            <li><a name="category" href="Category.php?category=Computers&username=<?php echo $username?>&userID=<?php echo $userID?>&customerType=<?php echo $customerType?>&salespersonID=<?php echo $salespersonID?>&regionID=<?php echo $regionID?>">Computers</a></li>
                            <li><a name="category" href="Category.php?category=Electronics&username=<?php echo $username?>&userID=<?php echo $userID?>&customerType=<?php echo $customerType?>&salespersonID=<?php echo $salespersonID?>&regionID=<?php echo $regionID?>">Electronics</a></li>
                            <li><a name="category" href="Category.php?category=Fashion&username=<?php echo $username?>&userID=<?php echo $userID?>&customerType=<?php echo $customerType?>&salespersonID=<?php echo $salespersonID?>&regionID=<?php echo $regionID?>">Fashion</a></li>
                            <li><a name="category" href="Category.php?category=Furniture&username=<?php echo $username?>&userID=<?php echo $userID?>&customerType=<?php echo $customerType?>&salespersonID=<?php echo $salespersonID?>&regionID=<?php echo $regionID?>">Furniture</a></li>
                            <li><a name="category" href="Category.php?category=Games&username=<?php echo $username?>&userID=<?php echo $userID?>&customerType=<?php echo $customerType?>&salespersonID=<?php echo $salespersonID?>&regionID=<?php echo $regionID?>">Games</a></li>
                        </ul>
        </form>
        </li>

        <li><a href="Statistic.php" target="_blank">Statistic</a></li>
        </ul>


            <form class="navbar-form navbar-left" role="search" action="Search.php" method="post" target="_self">
                <div class="form-group">
                    <input type="text" class="form-control" value="<?php echo $search?>" name="search">
                    <input type='hidden' value='<?php echo $regionID?>' name='regionID'>
                    <input type='hidden' value='<?php echo $salespersonID?>' name='salespersonID'>
                    <input type='hidden' value='<?php echo $userID?>' name='userID'>
                    <input type='hidden' value='<?php echo $username?>' name='username'>
                    <input type='hidden' value='<?php echo $customerType?>' name='customerType'>
                </div>
                <button type="submit" class="btn btn-default">Search</button>
            </form>

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

$query = "select * from product where name like '%$search%'";

$conn = connectDB();
$result = mysqli_query($conn, $query);
$data_count = mysqli_num_rows($result);

echo "<div class=\"container\" style='padding-bottom: 50px'>
        <table class=\"table table-striped table-hover\">
            <thead>
                <tr class=\"active\">
                    <th>Product Number</th>
                    <th>Product Name</th>
                    <th>Inventory Amount</th>
                    <th>($)Price</th>
                    <th>Kind</th>
                    <th>Select Quantity</th>
                    <th>Operaion</th>
                </tr>
            </thead>";
for ($i = 0; $i < $data_count; $i++) {
    $result_arr = mysqli_fetch_assoc($result);
    $productID = $result_arr['ProductID'];
    $productName = $result_arr['name'];
    $amount = $result_arr['inventory_amount'];
    $price = $result_arr['price'];
    $kind = $result_arr['kind'];

    echo "<tr><td>$productID</td><td>$productName</td><td>$amount</td><td>$price</td><td>$kind</td>
                <form action='Transaction.php' method='post'>
                <td>
                <input type='number' name='quantity' min='0' max='$amount'><small>(inventory amount: $amount)</small>
                </td>
                <td>
                <input type='hidden' value='$productID' name='productID'>
                <input type='hidden' value='$productName' name='productName'>
                <input type='hidden' value='$amount' name='amount'>
                <input type='hidden' value='$price' name='price'>
                <input type='hidden' value='$kind' name='kind'>
                <input type='hidden' value='$regionID' name='regionID'>
                <input type='hidden' value='$salespersonID' name='salespersonID'>
                <input type='hidden' value='$userID' name='userID'>
                <input type='hidden' value='$username' name='username'>
                <input type='hidden' value='$customerType' name='customerType'>
                <button type='submit' class='btn btn-primary btn-block'>Buy</button>
                </form>
                </td>
                </tr>";
}

echo "</table>
    </div>";
?>

</body>
</html>