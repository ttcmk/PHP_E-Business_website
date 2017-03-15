<?php
require_once 'functions.php';

$userID = $_POST['userID'];
$username = $_POST['username'];
$customerType = $_POST['customerType'];
$region = $_POST['region'];
$regionID = $_POST['regionID'];

$conn = connectDB();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signin Template for Bootstrap</title>
    <link href="Bootstrap/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-inverse" role="navigation">
<div class="container-fluid">
    <div class="navbar-header">
        <a class="navbar-brand" href="#">Choose Store and Salesperson</a>
    </div>
    <div class="collapse navbar-collapse">

    <ul class="nav navbar-nav navbar-right">
    <li><a><?php echo $username?></a></li>
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

<?php
$query = "select St.StoreID, Sa.SalespersonID, Sa.name, Sa.jobtitle, A.street, A.zipcode, Z.city, Z.state from Store St, Salesperson Sa, Address A, Zipcode Z where St.RegionID = $regionID and Sa.StoreID = St.StoreID and St.AddressID = A.AddressID and A.zipcode = Z.zipcode";
$result = mysqli_query($conn, $query);
$data_count = mysqli_num_rows($result);

echo "<div class=\"container\">
            <div class=\"alert alert-info\" role=\"alert\">
                <p>You have chosen $region region.   Do you want to
                <a class=\"alert-link\" onclick=\"javascript:history.back(-1);\">change</a>
                ?
                </p>
                <p>Please choose a store and salesperson.</p>
            </div>

       <div class=\"container\" id=\"thiscontainer\" style='padding-bottom: 50px'>
        <table class=\"table table-striped table-bordered table-hover\">
            <thead>
                <tr class=\"active\">
                    <th>Store</th>
                    <th>Salesperson</th>
                    <th>Jobtitle</th>
                    <th>Store Address</th>
                    <th>Operation</th>
                </tr>
            </thead>";

for ($i = 0; $i < $data_count; $i++) {
    $result_arr = mysqli_fetch_assoc($result);
    $storeID = $result_arr['StoreID'];
    $salespersonID = $result_arr['SalespersonID'];
    $salesperson = $result_arr['name'];
    $jobtitle = $result_arr['jobtitle'];
    $street = $result_arr['street'];
    $zipcode = $result_arr['zipcode'];
    $city = $result_arr['city'];
    $state = $result_arr['state'];

    echo "<tr><td>$storeID</td><td>$salesperson</td><td>$jobtitle</td><td>$street, $city, $state, $zipcode</td><td>
                <form action='allusers.php' method='post'>
                <input type='hidden' value='$regionID' name='regionID'>
                <input type='hidden' value='$salespersonID' name='salespersonID'>
                <input type='hidden' value='$userID' name='userID'>
                <input type='hidden' value='$username' name='username'>
                <input type='hidden' value='$customerType' name='customerType'>
                <button type='submit'>Choose</button>
                </form>
                </td>
                </tr>";


}

echo "</table>
    </div>";

?>


<script src="Bootstrap/jquery-2.1.1.min.js"></script>
<script src="Bootstrap/bootstrap.min.js"></script>
</body>
</html>