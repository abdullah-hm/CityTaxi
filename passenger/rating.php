<?php

session_start();
error_reporting(0);

if (!isset($_SESSION['PID'])) {
    header('Location:../logout.php');
}
include_once('../includes/config.php');

$pid = $_SESSION['PID'];

?>

<?php
if (isset($_POST['submit'])) {
    //getting post values

    $pid = $_SESSION['PID'];
    $driver = $_POST['driver'];
    $level = $_POST['level'];
    $query = "insert into `rating`(`PsgrId`, `DriverName`, `Level`) VALUES ('$pid','$driver','$level')";
    $result = mysqli_query($con, $query);
    if ($result) {
        echo '<script>alert("Rated Successfully.")</script>';
        echo "<script>window.location.href='driver-rating.php'</script>";
    } else {
        echo "<script>alert('Something went wrong. Please try again.');</script>";
        echo "<script>window.location.href='rating.php'</script>";
    }
}
?>

<head>
    <!--driver rating start css-->
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css"/>


</head>

<div class="row">

    <div class="no-print col-lg-3 col-3">
    </div>
    <div class="no-print col-lg-6 col-6">
        <br><br><br><br><br><br>
        <!-- small box -->
        <div class="shadow p-3 mb-5 bg-white rounded">
            <form method="post">
                <div class="form-group">
                    <select class="select2" type="text" name="driver"
                            data-placeholder=" Rate Your Driver " style="width: 100%" required>
                        <option value=""></option>
                        <?php
                        $vehicles = mysqli_query($con, "select * from booking as b inner join driver as d on d.drid = b.drid and b.Status='Completed'");
                        foreach ($vehicles as $vehicle) {
                            if ($vehicle) {
                                ?>
                                <option value="<?= $vehicle['drid']; ?>"><?= $vehicle['FlName'];; ?></option>
                                <?php
                            } else {
                                ?>
                                <option value="error"></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>


                <div class="form-group">
                    <input id="ratinginput" class="rating rating-loading" data-min="0" data-max="5"
                           data-step="1" name="level">
                </div>
                <button class="btn btn-warning btn-lg btn-block" name="submit"> Rate</button>
                <br><br>

                <script>
                    $("#ratinginput").rating();
                </script>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>