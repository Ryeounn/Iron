<?php
session_start();
if(isset($_SESSION['useradmin']) && ($_SESSION['useradmin'])){
    unset($_SESSION['useradmin']);
    header('location:../src/login.php');
}