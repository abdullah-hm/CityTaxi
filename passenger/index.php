<?php
session_start();

if (strlen($_SESSION['PID'] == 0)) {
    header('location:../logout.php');
} else{
    header('location:search-distance.php');
}
?>
