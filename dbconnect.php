<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "iron";

$conn = new mysqli($servername,$username,$password, $database);
if(!$conn){
    die("Connection failed: ".$conn->connect_error);
}
