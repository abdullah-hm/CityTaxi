

<?php

session_start();
error_reporting(0);

if (!isset($_SESSION['PID'])) {
    header('Location:../logout.php');
}

 $pid = $_SESSION['PID'];

include('../AdminLTE/header.php');
include_once('../includes/config.php');


if ($_GET['action'] == 'delete') {
    $rid = intval($_GET['rid']);
    $query = mysqli_query($con, "delete from rating where rid='$rid'");
    echo '<script>alert("Record deleted")</script>';
    echo "<script>window.location.href='manage-rating.php'</script>";
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
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" >
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
                        <h1 class="m-0 text-dark">SMS Notification</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
<!--                            <li class="breadcrumb-item"><a href="dashboard.php">Admin</a></li>-->
<!--                            <li class="breadcrumb-item active">Rating</li>-->
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


    <!-- ./col -->

    <div class="card col-lg-12 col-sm-12">
        <div class="card-header ">
            <h3>List of All SMS Notification
                <a href="#" onClick="window.print()" class="no-print btn btn-warning float-right"><i
                            class="fas fa-print"></i> Print
                </a>
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class=" table table-bordered table-hover">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Driver Name</th>
                        <th>Contact No</th>
                        <th>Vehicle Reg No</th>
                        <th>DateTime</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $query = mysqli_query($con, "select * from sms where pid='$pid'");
                    $cnt = 1;
                    while ($row = mysqli_fetch_array($query)) {
                        ?>

                        <tr>
                            <td><?php echo $cnt; ?></td>
                            <td><?php echo $row['DvrName']; ?></td>
                            <td><?php echo $row['ContactNo']; ?></td>
                            <td><?php echo $row['VrNo']; ?></td>
                            <td><?php echo $row['SendDT']; ?></td>
                        </tr>

                        <?php $cnt++;
                    } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Driver Name</th>
                        <th>Contact No</th>
                        <th>Vehicle Reg No</th>
                        <th>DateTime</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>


</div>


</div><!-- /.container-fluid -->
        
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

</div>

<?php include('../AdminLTE/footer.php') ?>

