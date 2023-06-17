<?php
session_start();


if (!isset($_SESSION['DRID'])) {
    header('Location:../logout.php');
}
include('../AdminLTE/header.php');
include_once('../includes/config.php');

$drid = $_SESSION['DRID'];

?>


<div class="reception-dashboard">
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


            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
                    <i class="fas fa fa-user"></i> Mr: <b> <?= $_SESSION['Name'] ?> </b>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar   elevation-4">
        <!-- Brand Logo -->
        <a href="dashboard.php" class="brand-link">
            <center><span class="brand-text center">CITY TAXI</span></center>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->

                    <li class="nav-item">
                        <a href="dashboard.php" class="nav-link active">

                            <i class=" nav-icon fas fa-tachometer-alt"></i>

                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="find-trip.php" class="nav-link ">
                            <i class="nav-icon fa fa-car"></i>
                            <p>
                                New Booking
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="history.php" class="nav-link ">
                            <i class="nav-icon 	fas fa-file-alt "></i>
                            <p>
                                Booking History
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="rating.php" class="nav-link ">
                            <i class="nav-icon 	fa fa-star "></i>
                            <p>
                              Driver Rating
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="profile.php" class="nav-link ">
                            <i class="nav-icon fas fa fa-user-plus "></i>
                            <p>
                                Profile
                            </p>
                        </a>
                    </li>

                    <li class="nav-item has-treeview">
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
                        <h1 class="m-0 text-dark">Driver Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard.php">Driver</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <!-- Main content -->
        <section class="content">

            <div class="container-fluid">

                <?php


                $query1 = mysqli_query($con, "select * from booking where drid ='$drid' and Status='Completed'");
                $totalcmptrips = mysqli_num_rows($query1);

                $query2 = mysqli_query($con, "select * from booking where drid ='$drid' and Status='Pending' and PickUpDate='CURDATE()'");
                $findtrip = mysqli_num_rows($query2);

                $query9 = mysqli_query($con, "select sum(Amount) as total from `booking` where drid ='$drid' and STATUS = 'Completed'");
                $row = mysqli_fetch_assoc($query9);
                $myearnings = $row['total'];

                // kulitha task - 80% goes to driver earning from entire earning

                ?>

                <div class="row">

                    <div class="no-print col-lg-6 col-6">
                        <!-- small box -->
                        <div class="small-box bg-blue ">
                            <div class="inner">

                                <h3>Rs.<?=  (0.8 * $myearnings) ?>/=</h3>
                                <p>Driver Earning</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-money"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="no-print col-lg-6 col-6">
                        <!-- small box -->
                        <div class="small-box bg-gradient-green ">
                            <div class="inner">

                                <h3><?= $findtrip ?></h3>
                                <p>Find Trip</p>
                            </div>
                            <div class="icon">
                                <i class="	fas fa-car"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>


                    <div class="no-print col-lg-6 col-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow ">
                            <div class="inner">

                                <h3>0</h3>
                                <p>Driver Rating</p>
                            </div>
                            <div class="icon">
                                <i class="	fas fa-star"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>


                    <div class="no-print col-lg-6 col-6">
                        <!-- small box -->
                        <div class="small-box bg-purple ">
                            <div class="inner">


                                <h3><?= $totalcmptrips ?></h3>
                                <p>Total Completed Trips</p>
                            </div>
                            <div class="icon">
                                <i class="fa  fa-users"></i>
                            </div>
                            <a href="manage-customer.php" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <!-- ./col -->
                </div>

            </div>
        </section>


        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>

<?php include('../AdminLTE/footer.php') ?>

