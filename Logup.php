<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="Bootstrap/bootstrap.min.css">
</head>
<body>

<!--<div class="jumbotron">-->
<!--    <div class="container">-->
<!--        <h1>Failed!</h1>-->
<!--        <p>The username has been used, please change another username</p>-->
<!--        <p><a class="btn btn-info btn-lg" href="#" role="button" onclick="javascript:history.back(-1);">Return</a></p>-->
<!--    </div>-->
<!--</div>-->

<?php
require_once 'functions.php';

$username = $_POST['username'];
$password = $_POST['password'];
$repassword = $_POST['repassword'];
$street = $_POST['street'];
$zipcode = $_POST['zipcode'];
$city = $_POST['city'];
$state = $_POST['state'];
$cusomertype = $_POST['customerType'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$marriage = $_POST['marriage'];
$income = $_POST['income'];
$companyName = $_POST['companyName'];
$companyCategory = $_POST['companyCategory'];
$companyIncome = $_POST['companyIncome'];

if($username == "" || $street == "" || $zipcode == "" || $city == "" || $state == ""){
    echo "<div class=\"jumbotron\">
                <div class=\"container\">
                    <h1>Failed!</h1>
                    <p>The infomation you entered is not enough, please return and check!</p>
                    <p><a class=\"btn btn-info btn-lg\" role=\"button\" onclick=\"javascript:history.back(-1);\">Return</a></p>
                </div>
              </div>";
    die();
}

$zipcode = intval($zipcode);
$age = intval($age);
$income = intval($income);
$companyIncome = intval($companyIncome);

$zipcode = abs($zipcode);
$age = abs($age);
$income = abs($income);
$companyIncome = abs($companyIncome);

if (checkPassword($password, $repassword)) {
    if ($cusomertype == 'Home') { //customer = home_customer
        if (checkHomeUsername($username)) { //username does not duplicate
            if (checkZipcode($zipcode)) { //zipcode does not exist in the database
                addZipcode($zipcode, $city, $state);
                $AddressID = checkAddress($street, $zipcode);
                if ($AddressID == 0) { //AddressID does not exist
                    $AddressID = addAddress($street, $zipcode);
                }
                $HomeID = checkHome($gender, $age, $marriage, $income);
                if ($HomeID == 0) { //Home id not exist
                    $HomeID = addHome($gender, $age, $marriage, $income);
                    addHomeCustomer($username, $AddressID, $HomeID, $password);
                } else { //Home id already exist
                    addHomeCustomer($username, $AddressID, $HomeID, $password);
                }

            } else { //zipcode already exist in the database
                $AddressID = checkAddress($street, $zipcode);
                if ($AddressID == 0) { //AddressID does not exist
                    $AddressID = addAddress($street, $zipcode);
                }
                $HomeID = checkHome($gender, $age, $marriage, $income);
                if ($HomeID == 0) { //Home id not exist
                    $HomeID = addHome($gender, $age, $marriage, $income);
                    addHomeCustomer($username, $AddressID, $HomeID, $password);
                } else { //Home id already exist
                    addHomeCustomer($username, $AddressID, $HomeID, $password);
                }

            }

        } else {
            //username duplicated
            echo "<div class=\"jumbotron\">
                <div class=\"container\">
                    <h1>Failed!</h1>
                    <p>The username has been used, please change another username</p>
                    <p><a class=\"btn btn-info btn-lg\" role=\"button\" onclick=\"javascript:history.back(-1);\">Return</a></p>
                </div>
              </div>";
            die();
        }
    } else {//customer = business customer

        if (checkBusinessUsername($username)) { //username does not duplicate
            if (checkZipcode($zipcode)) { //zipcode does not exist in the database
                addZipcode($zipcode, $city, $state);
                $AddressID = checkAddress($street, $zipcode);
                if ($AddressID == 0) { //AddressID does not exist
                    $AddressID = addAddress($street, $zipcode);
                }
                $BusinessID = checkBusiness($companyCategory, $companyName, $companyIncome);
                if ($BusinessID == 0) { //Business id not exist
                    $BusinessID = addBusiness($companyCategory, $companyName, $companyIncome);
                    addBusinessCustomer($username, $AddressID, $BusinessID, $password);
                } else { //Business id already exist
                    aaddBusinessCustomer($username, $AddressID, $BusinessID, $password);
                }

            } else { //zipcode already exist in the database
                $AddressID = checkAddress($street, $zipcode);
                if ($AddressID == 0) { //AddressID does not exist
                    $AddressID = addAddress($street, $zipcode);
                }
                $BusinessID = checkBusiness($companyCategory, $companyName, $companyIncome);
                if ($BusinessID == 0) { //Business id not exist
                    $BusinessID = addBusiness($companyCategory, $companyName, $companyIncome);
                    addBusinessCustomer($username, $AddressID, $BusinessID, $password);
                } else { //Business id already exist
                    addBusinessCustomer($username, $AddressID, $BusinessID, $password);
                }
            }

        } else {
            //username duplicated
            echo "<div class=\"jumbotron\">
                <div class=\"container\">
                    <h1>Failed!</h1>
                    <p>The username has been used, please change another username</p>
                    <p><a class=\"btn btn-info btn-lg\" role=\"button\" onclick=\"javascript:history.back(-1);\">Return</a></p>
                </div>
              </div>";
        }
    }

    //Log up successful
    echo "<div class=\"jumbotron\">
                <div class=\"container\">
                    <h1>Success!</h1>
                    <p>Please click Return and Login</p>
                    <p><a class=\"btn btn-info btn-lg\" role=\"button\" target='_self' onclick=\"window.location.href='Login.html'\">Return</a></p>
                </div>
              </div>";

} else {
    //passwords do not match
    echo "<div class=\"jumbotron\">
                <div class=\"container\">
                    <h1>Failed!</h1>
                    <p>Password do not match each other, please enter again</p>
                    <p><a class=\"btn btn-info btn-lg\" role=\"button\" onclick=\"javascript:history.back(-1);\">Return</a></p>
                </div>
              </div>";
}


function checkHomeUsername($username)
{
    $query = "select name from Home_Customer";

    $conn = connectDB();
    $result = mysqli_query($conn, $query);
    $data_count = mysqli_num_rows($result);

    for ($i = 0; $i < $data_count; $i++) {
        $result_arr = mysqli_fetch_assoc($result);
        if ($username == $result_arr['name']) {
            return false;
        }
    }

    return true;
}

function checkBusinessUsername($username)
{
    $query = "select name from Business_Customer";

    $conn = connectDB();
    $result = mysqli_query($conn, $query);
    $data_count = mysqli_num_rows($result);

    for ($i = 0; $i < $data_count; $i++) {
        $result_arr = mysqli_fetch_assoc($result);
        if ($username == $result_arr['name']) {
            return false;
        }
    }

    return true;
}

function checkPassword($password, $repassword)
{
    if ($password == $repassword) {
        return true;
    } else {
        return false;
    }
}

function checkZipcode($zipcode)
{
    $query = "select zipcode from Zipcode";

    $conn = connectDB();
    $result = mysqli_query($conn, $query);
    $data_count = mysqli_num_rows($result);

    for ($i = 0; $i < $data_count; $i++) {
        $result_arr = mysqli_fetch_assoc($result);
        if ($zipcode == $result_arr['zipcode']) {
            return false;
        }
    }

    return true;
}

function checkAddress($street, $zipcode)
{
    $query = "select * from Address";

    $conn = connectDB();
    $result = mysqli_query($conn, $query);
    $data_count = mysqli_num_rows($result);

    for ($i = 0; $i < $data_count; $i++) {
        $result_arr = mysqli_fetch_assoc($result);
        if ($street == $result_arr['street'] && $zipcode == $result_arr['zipcode']) {
            return $result_arr['AddressID'];
        }
    }

    return 0;
}

function addAddress($street, $zipcode)
{
    $queryForID = "select max(AddressID) as maxID from Address";

    $conn = connectDB();
    $result = mysqli_query($conn, $queryForID);
    $resultID = mysqli_fetch_assoc($result);
    $maxID = $resultID['maxID'];
    $AddressID = $maxID + 1;

    $query = "insert into Address values('$AddressID','$street','$zipcode')";
    mysqli_query($conn, $query);

    return $AddressID;
}

function addZipcode($zipcode, $city, $state)
{
    $query = "insert into Zipcode values('$zipcode','$city','$state')";

    $conn = connectDB();
    mysqli_query($conn, $query);
}

function checkHome($gender, $age, $marriage, $income)
{
    $query = "select * from Home";

    $conn = connectDB();
    $result = mysqli_query($conn, $query);
    $data_count = mysqli_num_rows($result);

    for ($i = 0; $i < $data_count; $i++) {
        $result_arr = mysqli_fetch_assoc($result);
        if ($gender == $result_arr['gender'] && $age == $result_arr['age'] && $marriage == $result_arr['marriage_status'] && $income == $result_arr['income']) {
            return $result_arr['HomeID'];
        }
    }

    return 0;
}

function addHome($gender, $age, $marriage, $income)
{
    $queryForID = "select max(HomeID) as maxID from Home";

    $conn = connectDB();
    $result = mysqli_query($conn, $queryForID);
    $resultID = mysqli_fetch_assoc($result);
    $maxID = $resultID['maxID'];
    $HomeID = $maxID + 1;

    $query = "insert into Home values('$HomeID','$gender','$age','$marriage', '$income')";
    mysqli_query($conn, $query);

    return $HomeID;
}

function addHomeCustomer($username, $AddressID, $HomeID, $password)
{
    $queryForID = "select max(Home_CustomerID) as maxID from Home_Customer";

    $conn = connectDB();
    $result = mysqli_query($conn, $queryForID);
    $resultID = mysqli_fetch_assoc($result);
    $maxID = $resultID['maxID'];
    $Home_CustomerID = $maxID + 1;

    $query = "insert into Home_Customer values('$Home_CustomerID','$username','$AddressID','$HomeID','$password')";
    mysqli_query($conn, $query);
}

function checkBusiness($companyCategory, $companyName, $companyIncome)
{
    $query = "select * from Business";

    $conn = connectDB();
    $result = mysqli_query($conn, $query);
    $data_count = mysqli_num_rows($result);

    for ($i = 0; $i < $data_count; $i++) {
        $result_arr = mysqli_fetch_assoc($result);
        if ($companyCategory == $result_arr['business_category'] && $companyName == $result_arr['company_name'] && $companyIncome == $result_arr['company_gross_annual_income']) {
            return $result_arr['BusinessID'];
        }
    }

    return 0;
}

function addBusiness($companyCategory, $companyName, $companyIncome)
{
    $queryForID = "select max(BusinessID) as maxID from Business";

    $conn = connectDB();
    $result = mysqli_query($conn, $queryForID);
    $resultID = mysqli_fetch_assoc($result);
    $maxID = $resultID['maxID'];
    $BusinessID = $maxID + 1;

    $query = "insert into Business values('$BusinessID','$companyCategory','$companyName','$companyIncome')";
    mysqli_query($conn, $query);

    return $BusinessID;
}

function addBusinessCustomer($username, $AddressID, $BusinessID, $password)
{
    $queryForID = "select max(Business_CustomerID) as maxID from Business_Customer";

    $conn = connectDB();
    $result = mysqli_query($conn, $queryForID);
    $resultID = mysqli_fetch_assoc($result);
    $maxID = $resultID['maxID'];
    $Business_CustomerID = $maxID + 1;

    $query = "insert into Business_Customer values('$Business_CustomerID','$username','$AddressID','$BusinessID','$password')";
    mysqli_query($conn, $query);

}
//echo 'username: ' . $username . '<br/>';
//echo 'password: ' . $password . '<br/>';
//echo 'repassword: ' . $repassword . '<br/>';
//echo 'street: ' . $street . '<br/>';
//echo 'zipcode: ' . $zipcode . '<br/>';
//echo 'city: ' . $city . '<br/>';
//echo 'state: ' . $state . '<br/>';
//echo 'TYPE: ' . $cusomertype . '<br/>';
//echo 'age: ' . $age . '<br/>';
//echo 'gender: ' . $gender . '<br/>';
//echo 'marriage: ' . $marriage . '<br/>';
//echo 'income: ' . $income . '<br/>';
//echo 'companyname: ' . $companyName;
//echo 'companycategory: ' . $companyCategory . '<br/>';
//echo 'companyIncome: ' . $companyIncome . '<br/>';
?>

<script src="Bootstrap/jquery-2.1.1.min.js"></script>
<script src="Bootstrap/bootstrap.min.js"></script>
</body>
</html>
