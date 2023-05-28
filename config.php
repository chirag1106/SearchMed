<?php

require_once 'error.php';

$con = new mysqli('localhost','root','','medicine');

if($con->connect_error){
    die('connection failed'.$con->connect_errno);
}

?>