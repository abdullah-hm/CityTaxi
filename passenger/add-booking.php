<?php

session_start();
error_reporting(0);

if (!isset($_SESSION['PID'])) {
    header('Location:../logout.php');
}

include('../AdminLTE/header.php');
include_once('../includes/config.php');


if (isset($_POST['submit'])) {
//getting post values

    $drid = $_POST['driver'];
    $pid = $_SESSION['PID'];
    $pickup = $_POST['pickuplocation'];
    $drop = $_POST['droplocation'];
    $pickupdate = $_POST['pickup_date'];
    $pickuptime = $_POST['pickup_time'];
    $ava = "Pending";

    $query1 = mysqli_query($con, "select * from distance where  LocationFrom='$pickup' and LocationTo='$drop' ");
    $cnt = 1;
    $amount = 0;
    while ($row = mysqli_fetch_array($query1)) {
        $amount = $row['Amount'];
        $cnt++;
    }

    if ($pickup != $drop) {
        $query2 = "insert into `booking`(`drid`, `pid`, `PickUp`, `DropOff`, `PickUpDate`, `PickUpTime`, `Amount`, `Status`) VALUES ('$drid','$pid','$pickup','$drop','$pickupdate','$pickuptime', '$amount' ,'$ava')";
        $result = mysqli_query($con, $query2);
        if ($result) {
            echo '<script>alert("Book your ride Successfully.")</script>';
            echo "<script>window.location.href='manage-booking.php'</script>";
        } else {
            echo "<script>alert('Something went wrong. Please try again.');</script>";
            echo "<script>window.location.href='add-booking.php'</script>";
        }
    } else {
        echo "<script>alert('Can not add same location. Please try again.');</script>";
        echo "<script>window.location.href='add-booking.php'</script>";
    }

}
?>



<div class="reservation-dashboard">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>

        </ul>


        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <?php

            $pid = $_SESSION['PID'];

            $query1 = mysqli_query($con, "select * from sms where pid ='$pid' and Date=CURDATE()");
            $totalsms = mysqli_num_rows($query1);
            ?>
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge"><?= $totalsms ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                    <div class="dropdown-divider"></div>
                    <a href="notification.php" class="dropdown-item dropdown-footer">See SMS Notifications</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
                    <i class="fas fa fa-user"></i><b> <?= $_SESSION['Name'] ?> </b>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar     elevation-4">
        <!-- Brand Logo -->
        <a href="search-distance.php" class="brand-link">

            <center><span class="brand-text center">CITY TAXI</span></center>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">

                    <li class="nav-item">
                        <a href="search-distance.php" class="nav-link ">

                            <i class=" nav-icon fa fa-search"></i>

                            <p>
                                Search
                            </p>
                        </a>
                    </li>


                    <li class="nav-item has-treeview menu-open">
                        <a href="manage-booking.php" class="nav-link active">
                            <i class="nav-icon fas fa-car-side"></i>
                            <p>
                                Booking
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="add-booking.php" class="nav-link active">
                                    <i class="nav-icon  fa fa-plus "></i>
                                    <p>Add Booking</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="manage-booking.php" class="nav-link">
                                    <i class="nav-icon fas fa-car-side "></i>
                                    <p>Booking Status</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item ">
                        <a href="driver-rating.php" class="nav-link">
                            <i class="nav-icon fa fa-star"></i>
                            <p>
                                Driver Rating
                            </p>
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a href="complaint.php" class="nav-link ">
                            <i class="nav-icon fa fa-sticky-note"></i>
                            <p>
                                Complaint
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="history.php" class="nav-link ">

                            <i class=" nav-icon fas fa-tachometer-alt"></i>

                            <p>
                                History
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="logout.php" class="nav-link ">
                            <i class="nav-icon  fas fa-sign-out-alt "></i>
                            <p>
                                Logout
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Add New Booking.</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <!--                            <li class="breadcrumb-item"><a href="search-distance.php">Admin</a></li>-->
                            <!--                            <li class="breadcrumb-item active">Search</li>-->
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="no-print col-lg-3 col-3">
                    </div>
                    <div class="no-print col-lg-6 col-6">
                        <!-- small box -->

                        <div class="shadow p-3 mb-5 bg-white rounded">
                            <form method="POST">

                                <div class="form-group">
                                    <label>Driver</label>
                                    <select class="select2" type="text" name="driver"
                                            data-placeholder="Search Driver Near You" style="width: 100%" required>
                                        <option value=""></option>
                                        <?php
                                        $drivers = mysqli_query($con, "select * from driver where Availability = 'Available'");
                                        foreach ($drivers as $driver) {

                                            if ($driver) {
                                                ?>
                                                <option value="<?= $driver['drid']; ?>"><?= $driver['FlName'];; ?></option>
                                                <?php
                                            } else {
                                                ?>
                                                <option value="0">No Driver Found</option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>PickUp Location</label>
                                    <select class="select2" type="text" name="pickuplocation"
                                            data-placeholder="Search Pickup Location " style="width: 100%" required>
                                        <option value=""> Pickup Location</option>
                                        <?php
                                        $pickuplocations = mysqli_query($con, "select * from location");
                                        foreach ($pickuplocations as $pickuplocation) {

                                            if ($pickuplocation) {
                                                ?>
                                                <option value="<?= $pickuplocation['LocationName']; ?>"><?= $pickuplocation['LocationName'];; ?></option>
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
                                    <label>Drop Location</label>
                                    <select class="select2" type="text" name="droplocation"
                                            data-placeholder="Search Drop Location " style="width: 100%" required>
                                        <option value=""> Drop Location</option>
                                        <?php
                                        $droplocations = mysqli_query($con, "select * from location");
                                        foreach ($droplocations as $droplocation) {

                                            if ($droplocation) {
                                                ?>
                                                <option value="<?= $droplocation['LocationName']; ?>"><?= $droplocation['LocationName'];; ?></option>
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
                                    <label>PickUp Date</label>
                                    <div class="input-group date" id="drvdob" data-target-input="nearest">
                                        <input type="text" name="pickup_date" placeholder="PickUp Date"
                                               class="form-control datetimepicker-input"
                                               data-target="#drvdob" required/>
                                        <div class="input-group-append" data-target="#drvdob"
                                             data-toggle="datetimepicker">
                                            <div class="input-group-text">
                                                <i class="fa fa-calendar-alt"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>PickUp Time</label>

                                    <div class="input-group date" id="arrivaltimepicker"
                                         data-target-input="nearest">
                                        <input type="text" name="pickup_time" placeholder="PickUp Time"
                                               class="form-control datetimepicker-input"
                                               data-target="#arrivaltimepicker" required/>
                                        <div class="input-group-append" data-target="#arrivaltimepicker"
                                             data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                        </div>
                                    </div>
                                    <!-- /.input group -->
                                </div>

                                <button type="submit" class="btn btn-info btn-lg btn-block" name="submit"> Book Your
                                    Ride
                                </button>
                            </form>
                        </div>
                    </div>

                </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
</div>
<!-- /.content-wrapper -->

</div>

<?php include('../AdminLTE/footer.php') ?>

