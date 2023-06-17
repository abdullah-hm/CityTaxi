<?php

session_start();
error_reporting(0);

if (!isset($_SESSION['PID'])) {
    header('Location:../logout.php');
}

include('../AdminLTE/header.php');
include_once('../includes/config.php');

?>

<?php
if (isset($_POST['submit'])) {

    $dsid = $_POST['dsid'];

    echo "<script>window.location.href='view-distance.php?dsid=$dsid'</script>";

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
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="profile.php">
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
                        <a href="search-distance.php" class="nav-link active">

                            <i class=" nav-icon fa fa-search"></i>

                            <p>
                                Search
                            </p>
                        </a>
                    </li>


                    <li class="nav-item has-treeview menu-close">
                        <a href="manage-booking.php" class="nav-link">
                            <i class="nav-icon fas fa-car-side"></i>
                            <p>
                                Booking
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="add-booking.php" class="nav-link ">
                                    <i class="nav-icon  fa fa-plus "></i>
                                    <p>Add Booking</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="manage-booking.php" class="nav-link ">
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
                        <a href="history.php" class="nav-link">

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
                        <h1 class="m-0 text-dark"> Search Location Distance Details</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <!--<ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard.php">Admin</a></li>
                            <li class="breadcrumb-item active">Home</li>
                        </ol>-->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <br>
                <br>
                <br>
                <br>
                <div class="row">
                    <div class="no-print col-lg-3 col-3">
                    </div>
                    <div class="no-print col-lg-6 col-6">
                        <!-- small box -->

                        <div class="shadow p-3 mb-5 bg-white rounded">

                            <form method="POST" >

                                <div class="form-group">
                                    <label>Location From - To</label>
                                    <select class="select2" type="text" name="dsid"
                                            data-placeholder="Search Pickup Location & Drop Location"
                                            style="width: 100%" required>
                                        <option value=""> </option>
                                        <?php
                                        $dcs = mysqli_query($con, "select * from distance");
                                        foreach ($dcs as $dc) {

                                            if ($dc) {

                                                ?>

                                                <option value="<?= $dc['dsid']; ?>"><?= $dc['LocationFrom']; ?>
                                                    - <?= $dc['LocationTo']; ?> </option>

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

                                <div class="form-group offset-md-3  offset-sm-2 col-sm-6 col-md-6">
                                    <div class="text-center">
                                        <button type="submit" value="submit" name="submit" id="submit"
                                                class="btn btn-block bg-gradient-info btn-lg ">
                                            Submit
                                        </button>
                                    </div>
                                </div>


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

