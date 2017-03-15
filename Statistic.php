<?php
require_once 'functions.php';

$conn = connectDB();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Statics</title>
    <link rel="stylesheet" href="Bootstrap/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-inverse" role="navigation"">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Statistic of the Shop</a>
        </div>
    </div>
    </div>
</nav>

<div class="container">

<!--    Home Customer-->
    <div class="panel panel-primary">
        <div class="panel-heading">
            Home Customers
        </div>
        <div class="panel-body">
    <div class="panel panel-info">
        <div class="panel-heading">
            Profit Ranking of Individual Product
        </div>
        <div class="panel-body">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr class="active">
                        <th>Ranking</th>
                        <th>Product Number</th>
                        <th>Product Name</th>
                        <th>Product Kind</th>
                        <th>Quantity Saled</th>
                        <th>($)Price</th>
                        <th>($)Profit</th>
                        <th>Other Options</th>
                    </tr>
                    </thead>
        <?php
        $result_profit = mysqli_query($conn, "select P.ProductID, P.kind ,P.name, sum(T.quantity) as quantity, P.price, sum(P.price * T.quantity) as profit from Product P, Home_Transaction T where P.ProductID = T.ProductID group by P.ProductID order by profit DESC");
        $data_number = mysqli_num_rows($result_profit);

        for($i=0;$i<$data_number;$i++) {
            $ranking = $i + 1;
            $result_profit_arr = mysqli_fetch_assoc($result_profit);
            $productID = $result_profit_arr['ProductID'];
            $productName = $result_profit_arr['name'];
            $kind = $result_profit_arr['kind'];
            $quantity = $result_profit_arr['quantity'];
            $price = $result_profit_arr['price'];
            $profit = $result_profit_arr['profit'];

            echo "<tr>
                        <td>$ranking</td>
                        <td>$productID</td>
                        <td>$productName</td>
                        <td>$kind</td>
                        <td>$quantity</td>
                        <td>$price</td>
                        <td>$profit</td>
                        <td>
                        <form action='Stat_Customer.php' method='post'>
                <input type='hidden' value='$productID' name='productID'>
                <input type='hidden' value='$productName' name='productName'>
                <input type='hidden' value='$price' name='price'>
                <input type='hidden' value='Home' name='customerType'>
                <button type='submit' class='btn btn-success btn-block'>View the Buyer Ranking</button>
                </form>
                </td>
                  </tr>";


        }
        ?>

        </table>
        </div>
    </div>


            <div class="panel panel-info">
                <div class="panel-heading">
                    Profit Ranking of Product Category
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr class="active">
                            <th>Ranking</th>
                            <th>Product Category</th>
                            <th>Total Quantity Saled</th>
                            <th>Total Profit</th>
                        </tr>
                        </thead>
                        <?php
                        $result_profit = mysqli_query($conn, "select P.kind , sum(T.quantity) as quantity, sum(P.price * T.quantity) as profit from Product P, Home_Transaction T where P.ProductID = T.ProductID group by P.kind order by profit DESC");
                        $data_number = mysqli_num_rows($result_profit);

                        for($i=0;$i<$data_number;$i++) {
                            $ranking = $i + 1;
                            $result_profit_arr = mysqli_fetch_assoc($result_profit);
                            $kind = $result_profit_arr['kind'];
                            $quantity = $result_profit_arr['quantity'];
                            $profit = $result_profit_arr['profit'];

                            echo "<tr>
                        <td>$ranking</td>
                        <td>$kind</td>
                        <td>$quantity</td>
                        <td>$profit</td>";
                        }
                        ?>

                    </table>
                </div>
            </div>

            <!--        Region-->
            <div class="panel panel-info">
                <div class="panel-heading">
                    Sales Volume Ranking of Region
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr class="active">
                            <th>Ranking</th>
                            <th>Region Name</th>
                            <th>Total Quantity Saled</th>
                        </tr>
                        </thead>
                        <?php
                        $result_profit = mysqli_query($conn, "select R.region_name, sum(T.quantity) as quantity from Home_Transaction T, Salesperson S, Region R, Store St where T.SalespersonID = S.SalespersonID and S.StoreID = St.StoreID and St.RegionID = R.RegionID group by R.region_name order by quantity DESC");
                        $data_number = mysqli_num_rows($result_profit);

                        for($i=0;$i<$data_number;$i++) {
                            $ranking = $i + 1;
                            $result_profit_arr = mysqli_fetch_assoc($result_profit);
                            $regionName = $result_profit_arr['region_name'];
                            $quantity = $result_profit_arr['quantity'];

                            echo "<tr>
                        <td>$ranking</td>
                        <td>$regionName</td>
                        <td>$quantity</td>";
                        }
                        ?>

                    </table>
                </div>
            </div>

    </div>
    </div>


<!--    Business Customer-->
    <div class="panel panel-primary">
    <div class="panel-heading">
        Business Customers
    </div>
    <div class="panel-body">
    <div class="panel panel-info">
        <div class="panel-heading">
            Profit Ranking of Business Customers
        </div>
        <div class="panel-body">
            <table class="table table-striped table-hover">
                <thead>
                <tr class="active">
                    <th>Ranking</th>
                    <th>Product Number</th>
                    <th>Product Name</th>
                    <th>Product Kind</th>
                    <th>Quantity Saled</th>
                    <th>($)Price</th>
                    <th>($)Profit</th>
                    <th>Other Options</th>
                </tr>
                </thead>
                <?php
                $result_profit = mysqli_query($conn, "select P.ProductID, P.kind ,P.name, sum(T.quantity) as quantity, P.price, sum(P.price * T.quantity) as profit from Product P, Business_Transaction T where P.ProductID = T.ProductID group by P.ProductID order by profit DESC");
                $data_number = mysqli_num_rows($result_profit);

                for($i=0;$i<$data_number;$i++) {
                    $ranking = $i + 1;
                    $result_profit_arr = mysqli_fetch_assoc($result_profit);
                    $productID = $result_profit_arr['ProductID'];
                    $productName = $result_profit_arr['name'];
                    $kind = $result_profit_arr['kind'];
                    $quantity = $result_profit_arr['quantity'];
                    $price = $result_profit_arr['price'];
                    $profit = $result_profit_arr['profit'];

                    echo "<tr>
                        <td>$ranking</td>
                        <td>$productID</td>
                        <td>$productName</td>
                        <td>$kind</td>
                        <td>$quantity</td>
                        <td>$price</td>
                        <td>$profit</td>
                        <td>
                        <form action='Stat_Customer.php' method='post'>
                <input type='hidden' value='$productID' name='productID'>
                <input type='hidden' value='$productName' name='productName'>
                <input type='hidden' value='$price' name='price'>
                <input type='hidden' value='Business' name='customerType'>
                <button type='submit' class='btn btn-success btn-block'>View the Buyer Ranking</button>
                </form>
                </td>
                  </tr>";


                }
                ?>

            </table>
        </div>
    </div>

        <div class="panel panel-info">
            <div class="panel-heading">
                Profit Ranking of Product Category
            </div>
            <div class="panel-body">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr class="active">
                        <th>Ranking</th>
                        <th>Product Category</th>
                        <th>Total Quantity Saled</th>
                        <th>Total Profit</th>
                    </tr>
                    </thead>
                    <?php
                    $result_profit = mysqli_query($conn, "select P.kind , sum(T.quantity) as quantity, P.price, sum(P.price * T.quantity) as profit from Product P, Business_Transaction T where P.ProductID = T.ProductID group by P.kind order by profit DESC");
                    $data_number = mysqli_num_rows($result_profit);

                    for($i=0;$i<$data_number;$i++) {
                        $ranking = $i + 1;
                        $result_profit_arr = mysqli_fetch_assoc($result_profit);
                        $kind = $result_profit_arr['kind'];
                        $quantity = $result_profit_arr['quantity'];
                        $profit = $result_profit_arr['profit'];

                        echo "<tr>
                        <td>$ranking</td>
                        <td>$kind</td>
                        <td>$quantity</td>
                        <td>$profit</td>";
                    }
                    ?>

                </table>
            </div>
        </div>

<!--        Region-->
        <div class="panel panel-info">
            <div class="panel-heading">
                Sales Volume Ranking of Region
            </div>
            <div class="panel-body">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr class="active">
                        <th>Ranking</th>
                        <th>Region Name</th>
                        <th>Total Quantity Saled</th>
                    </tr>
                    </thead>
                    <?php
                    $result_profit = mysqli_query($conn, "select R.region_name, sum(T.quantity) as quantity from Business_Transaction T, Salesperson S, Region R, Store St where T.SalespersonID = S.SalespersonID and S.StoreID = St.StoreID and St.RegionID = R.RegionID group by R.region_name order by quantity DESC");
                    $data_number = mysqli_num_rows($result_profit);

                    for($i=0;$i<$data_number;$i++) {
                        $ranking = $i + 1;
                        $result_profit_arr = mysqli_fetch_assoc($result_profit);
                        $regionName = $result_profit_arr['region_name'];
                        $quantity = $result_profit_arr['quantity'];

                        echo "<tr>
                        <td>$ranking</td>
                        <td>$regionName</td>
                        <td>$quantity</td>";
                    }
                    ?>

                </table>
            </div>
        </div>
    </div>
    </div>
</div>

</body>
</html>