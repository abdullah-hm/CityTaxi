<?php

require_once("../includes/config.php");
// Check for Branch Code validation

if (!empty($_POST["location_name"])) {
    $lcname = $_POST["location_name"];

    $result = mysqli_query($con, "select * from location where LocationName='$lcname'");
    $count = mysqli_num_rows($result);
    if ($count > 0) {

        echo "<span class='text-danger text-bold'>Location Name already exists. Please try Again.</span>";
        echo "<script>$('#submit').prop('disabled',true);</script>";
    } else {

        echo "<span class='text-success text-bold'>Location Name Available for Registration .</span>";
        echo "<script>$('#submit').prop('disabled',false);</script>";
    }
}

if (!empty($_POST["vr_no"])) {
    $vr = $_POST["vr_no"];

    $result = mysqli_query($con, "select * from vehicle where RegNo='$vr'");
    $count = mysqli_num_rows($result);
    if ($count > 0) {

        echo "<span class='text-danger text-bold'>Vehicle Reg No already exists. Please try Again.</span>";
        echo "<script>$('#submit').prop('disabled',true);</script>";
    } else {

        echo "<span class='text-success text-bold'>Vehicle Reg No Available for Registration .</span>";
        echo "<script>$('#submit').prop('disabled',false);</script>";
    }
}

if (!empty($_POST["email"])) {
    $mail = $_POST["email"];

    $result = mysqli_query($con, "select * from driver where Email='$mail'");
    $count = mysqli_num_rows($result);
    if ($count > 0) {

        echo "<span class='text-danger text-bold'>Driver Email ID already exists. Please try Again.</span>";
        echo "<script>$('#submit').prop('disabled',true);</script>";
    } else {

        echo "<span class='text-success text-bold'>Driver Email ID Available for Registration .</span>";
        echo "<script>$('#submit').prop('disabled',false);</script>";
    }
}


?>
