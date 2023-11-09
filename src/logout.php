<?php
session_start();
require_once '../dbconnect.php';
require_once '../Iron.php';
if(isset($_SESSION['user']) && ($_SESSION['user'])){
    unset($_SESSION['user']);
    header('location: ./login.php');
}

