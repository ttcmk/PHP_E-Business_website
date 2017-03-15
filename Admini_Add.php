<?php
require_once 'functions.php';

$conn = connectDB();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Administrator</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Add Product</a>
        </div>

        <form class="navbar-form navbar-left" role="search" action="Administrator.php" method="post">
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-menu-left"></span>Return</button>
        </form>
    </div>
</nav>

<div class="container">
    <?php

    echo "<form action='Admini_Add_Comfirm.php' method='post'>
                <h2><small>Product Name</small></h2>
                <input type='text' name='productName' class='form-control' required>
                <h2><small>Inventory Amount</small></h2>
                <input type='text' name='amount' class='form-control' required>
                <h2><small>Price</small></h2>
                <div class='input-group'>
                <span class='input-group-addon'>$</span>
                <input type='text' name='price' class='form-control' required>
                </div>
                <h2><small>Kind</small></h2>
                <input type='text' name='kind' class='form-control' required>
                <br/>
                <button type='submit' class='btn btn-info btn-lg'>Submit</button>
                </form>";

    ?>
</div>



<script src="jquery-2.1.1.min.js"></script>
<script src="bootstrap.min.js"></script>

</body>
</html>
