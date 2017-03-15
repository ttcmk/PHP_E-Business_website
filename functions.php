<?php
/**
 * Created by PhpStorm.
 * User: zhangyuxiao
 * Date: 11/21/16
 * Time: 18:50
 */
require_once 'config.php';

function connectDB(){
    return mysqli_connect(MYSQL_HOST,MYSQL_USER,MYSQL_PW,MYSQL_DB);
}