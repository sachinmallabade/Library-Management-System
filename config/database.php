<?php
$con = new mysqli(server_name,username,password,database);

// check connection
if($con->connect_error){
    die("Connection Failed : " . $con->connect_error);
}