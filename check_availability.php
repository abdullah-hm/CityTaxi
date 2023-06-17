<?php

require_once("includes/config.php");


if (!empty($_POST["email"])) {
    $mail = $_POST["email"];

    $result = mysqli_query($con, "select * from passenger where Email='$mail'");
    $count = mysqli_num_rows($result);
    if ($count > 0) {

        echo "<span class='text-danger text-bold'>Passenger Email ID already exists. Please try Again.</span>";
        echo "<script>$('#submit').prop('disabled',true);</script>";
    } else {

        echo "<span class='text-success text-bold'>Passenger Email ID Available for Registration .</span>";
        echo "<script>$('#submit').prop('disabled',false);</script>";
    }
}


?>
