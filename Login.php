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

<?php
require_once 'functions.php';

$conn = connectDB();

$username = $_POST['username'];
$password = $_POST['password'];
$customerType = $_POST['customerType'];

if ($customerType == 'Home'){
    $result = mysqli_query($conn, "select * from Home_Customer where name = '$username' and password = '$password'");
    $data_count = mysqli_num_rows($result);

    if (!$data_count) {//username or password is wrong
        echo "<div class=\"container\">
            <div class=\"alert alert-danger\" role=\"alert\">
                Username or Password is wrong. Please return and try again!
            <p><a class=\"alert-link\" href=\"#\" role=\"button\" onclick=\"window.open('Login.html')\">Return</a></p>

            </div>";
        die();
    }

    $result_arr = mysqli_fetch_assoc($result);
    $userID = $result_arr['Home_CustomerID'];

}else {//customer type is Business
    $result = mysqli_query($conn, "select * from Business_Customer where name = '$username' and password = '$password'");
    $data_count = mysqli_num_rows($result);

    if (!$data_count) {//username or password is wrong
        echo "<div class=\"container\">
            <div class=\"alert alert-danger\" role=\"alert\">
                Username or Password is wrong. Please return and try again!
            <p><a class=\"alert-link\" href=\"#\" role=\"button\" onclick=\"window.open('Login.html')\">Return</a></p>

            </div>";
        die();
    }

    $result_arr = mysqli_fetch_assoc($result);
    $userID = $result_arr['Business_CustomerID'];
}

echo "<nav class=\"navbar navbar-inverse\" role=\"navigation\">
    <div class=\"container-fluid\">
        <div class=\"navbar-header\">
            <a class=\"navbar-brand\" href=\"#\">Choose Region</a>
        </div>
        <div class=\"collapse navbar-collapse\">

            <ul class=\"nav navbar-nav navbar-right\">
                <li><a>$username</a></li>
                <li class=\"dropdown\">
                    <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Action<span class=\"caret\"></span></a>
                    <ul class=\"dropdown-menu\" role=\"menu\">
                        <li><a href=\"Login.html\">Log out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>";

$query = "select R.RegionID,R.region_name as Region, S.name as Manager from Region R, Salesperson S where R.region_managerID = S.SalespersonID";
$result = mysqli_query($conn, $query);
$data_count = mysqli_num_rows($result);

echo "<div class=\"container\">
            <div class=\"alert alert-info\" role=\"alert\">
                Welcome $username. Please choose a region.
            </div>

       <div class=\"container\" id=\"thiscontainer\" style='padding-bottom: 50px'>
        <table class=\"table table-striped table-bordered table-hover\">
            <thead>
                <tr class=\"active\">
                    <th>Region</th>
                    <th>Manager</th>
                    <th>Operation</th>
                </tr>
            </thead>";

for ($i = 0; $i < $data_count; $i++) {
    $result_arr = mysqli_fetch_assoc($result);
    $regionID = $result_arr['RegionID'];
    $region = $result_arr['Region'];
    $manager = $result_arr['Manager'];

    echo "<tr><td>$region</td><td>$manager</td><td>
                <form action='ChooseSalesperson.php' method='post'>
                <input type='hidden' value='$regionID' name='regionID'>
                <input type='hidden' value='$region' name='region'>
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



//echo "userID: $userID <br/>";
//echo "username: $username <br/>";
//echo "password: $password <br/>";
//echo "customerType: $customerType <br/>";
?>

<script src="Bootstrap/jquery-2.1.1.min.js"></script>
<script src="Bootstrap/bootstrap.min.js"></script>
</body>
</html>
