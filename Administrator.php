<?php
require_once 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Administrator</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Administrative Site</a>
        </div>


        <form class="navbar-form navbar-left" role="search" action="ManageUsers.php" method="post">
            <button type="submit" class="btn btn-primary">Manage Home Consumers</button>
        </form>
        <form class="navbar-form navbar-left" role="search" action="ManageUserB.php" method="post">
            <button type="submit" class="btn btn-primary">Manage Business Consumers</button>
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

$query = "select * from product";

$conn = connectDB();
$result = mysqli_query($conn, $query);
$data_count = mysqli_num_rows($result);

echo "<div class=\"container\" style='padding-bottom: 50px; padding-top: 60px'>
<form action=\"Admini_Add.php\" method=\"post\">
        <button type=\"submit\" class=\"btn btn-success\"><span class=\"glyphicon glyphicon-plus\"></span>Add Product</button>
    </form>
        <table class=\"table table-striped table-hover\">
            <thead>
                <tr class=\"active\">
                    <th>Product Number</th>
                    <th>Product Name</th>
                    <th>Inventory Amount</th>
                    <th>($)Price</th>
                    <th>Kind</th>
                    <th>Modify</th>
                    <th>Delete</th>
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

                <form action='Admini_Modify.php' method='post'>
                <td>
                <input type='hidden' value='$productID' name='productID'>
                <input type='hidden' value='$productName' name='productName'>
                <input type='hidden' value='$amount' name='amount'>
                <input type='hidden' value='$price' name='price'>
                <input type='hidden' value='$kind' name='kind'>
                <button type='submit' class='btn btn-info btn-block'>Modify</button>
                </form>
                </td>


                <form action='Admini_Delete.php' method='post'>
                <td> 
                <input type='hidden' value='$productID' name='productID'>
                
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
                                Are you sure to delete <b><i>$productName</i></b>
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