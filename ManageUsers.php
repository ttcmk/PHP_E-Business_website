<?php
require_once 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Home Customers</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Manage Home Customers</a>
        </div>

        <form class="navbar-form navbar-left" role="search" action="Administrator.php" method="post">
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-menu-left"></span>Return</button>
        </form>

    </div>
    </div>
</nav>

<nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
    <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
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

$query = "select HC.Home_CustomerID, HC.AddressID, HC.HomeID, HC.name, A.street, Z.city, Z.state, A.zipcode, H.gender, H.age, H.marriage_status, H.income from Home_Customer HC, Address A, Home H, Zipcode Z where HC.AddressID = A.AddressID and HC.HomeID = H.HomeID and Z.zipcode = A.zipcode ";

$conn = connectDB();
$result = mysqli_query($conn, $query);
$data_count = mysqli_num_rows($result);

echo "<div class=\"container\" style='padding-bottom: 50px; padding-top: 60px'>
<form action=\"Logup.html\" method=\"post\">
        <button type=\"submit\" class=\"btn btn-success\"><span class=\"glyphicon glyphicon-plus\"></span>Add User</button>
    </form>
        <table class=\"table table-striped table-hover\">
            <thead>
                <tr class=\"active\">
                    <th>Customer Name</th>
                    <th>Street</th>
                    <th>Zipcode</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Marriage status</th>
                    <th>($)Income</th>
                    <th>Modify</th>
                    <th>Delete</th>
                </tr>
            </thead>";
for ($i = 0; $i < $data_count; $i++) {
    $result_arr = mysqli_fetch_assoc($result);
    $id = $result_arr['Home_CustomerID'];
    $addressid = $result_arr['AddressID'];
    $homeid = $result_arr['HomeID'];
    $name = $result_arr['name'];
    $street = $result_arr['street'];
    $zipcode = $result_arr['zipcode'];
    $city = $result_arr['city'];
    $state = $result_arr['state'];
    $gender = $result_arr['gender'];
    $age = $result_arr['age'];
    $marriage = $result_arr['marriage_status'];
    $income = $result_arr['income'];

    echo "<tr><td>$name</td><td>$street</td><td>$zipcode</td><td>$city</td><td>$state</td><td>$gender</td><td>$age</td><td>$marriage</td><td>$income</td>

                <form action='User_Modify.php' method='post'>
                <td>
                <input type='hidden' value='$id' name='id'>
                <input type='hidden' value='$addressid' name='addressid'>
                <input type='hidden' value='$homeid' name='homeid'>
                <input type='hidden' value='$name' name='name'>
                <input type='hidden' value='$street' name='street'>
                <input type='hidden' value='$zipcode' name='zipcode'>
                <input type='hidden' value='$city' name='city'>
                <input type='hidden' value='$state' name='state'>
                <input type='hidden' value='$gender' name='gender'>
                <input type='hidden' value='$age' name='age'>
                <input type='hidden' value='$marriage' name='marriage'>
                <input type='hidden' value='$income' name='income'>
                <button type='submit' class='btn btn-info btn-block'>Modify</button>
                </form>
                </td>


                <form action='User_Delete.php' method='post'>
                <td> 
                <input type='hidden' value='$name' name='name'>
                
                <button type=\"button\" class=\"btn btn-danger btn-block\" data-toggle=\"modal\" data-target=\"#exampleModal$i\">
                Delete
                </button>
                <div class=\"modal fade\" id=\"exampleModal$i\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLable\" aria-hidden=\"false\">
                    <div class=\"modal-dialog\">
                     <div class=\"modal-content\">
                        <div class=\"modal-header\">
                            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                                <span aria-hidden=\"true\">&times;</span>
                            </button>
                         <h4 class=\"modal-title\" id=\"exampleModalLable\">Delete Infomation</h4>
                        </div>
                        <div class=\"modal-body\">
                            <lable class=\"control-label\">
                                Are you sure to delete user <b><i>$name</i></b>
                            </lable>
                        </div>
                        <div class=\"modal-footer\">
                            <button type=\"button\" class=\"btn btn-primary\" data-dismiss=\"modal\">
                                Cancel
                            </button>
                        <button type=\"submit\" class=\"btn btn-success\">Confirm</button>
                        </div>
                    </div>
                </div> 
                </form> 
                </td>
                </tr>";
}

echo "</table>
    </div>";
?>

<script src="jquery-2.1.1.min.js"></script>
<script src="bootstrap.min.js"></script>

</body>
</html>