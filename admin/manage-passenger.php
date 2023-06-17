<?php

session_start();
error_reporting(0);

if (!isset($_SESSION['AID'])) {
    header('Location:../logout.php');
}

include('../AdminLTE/header.php');
include_once('../includes/config.php');

if ($_GET['action'] == 'delete') {
    $pid = intval($_GET['pid']);
    $query = mysqli_query($con, "delete from passenger where pid='$pid'");
    echo '<script>alert("Record deleted")</script>';
    echo "<script>window.location.href='manage-passenger.php'</script>";
}

?>

<div class="admin-dashboard">
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
        <a href="dashboard.php" class="brand-link">

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
                        <a href="dashboard.php" class="nav-link ">

                            <i class=" nav-icon fas fa-tachometer-alt"></i>

                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="manage-location.php" class="nav-link ">
                            <i class="nav-icon fas fa-map-marker-alt"></i>
                            <p>
                                Location
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview menu-close">
                        <a href="manage-distance.php" class="nav-link ">
                            <i class="nav-icon fas fa-map-pin"></i>
                            <p>
                                Distance
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="add-distance.php" class="nav-link ">
                                    <i class="nav-icon fas fa-map-pin "></i>
                                    <p>Add Distance</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="manage-distance.php" class="nav-link">
                                    <i class="nav-icon fas fa-map-pin "></i>
                                    <p>Manage Distance</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item has-treeview menu-close">
                        <a href="manage-vehicle.php" class="nav-link">
                            <i class="nav-icon fas fa-car-side"></i>
                            <p>
                                Vehicle
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="add-vehicle.php" class="nav-link">
                                    <i class="nav-icon fas fa-car-side "></i>
                                    <p>Add Vehicle</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="manage-vehicle.php" class="nav-link">
                                    <i class="nav-icon fas fa-car-side "></i>
                                    <p>Manage Vehicle</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item has-treeview menu-close">
                        <a href="manage-driver.php" class="nav-link">
                            <i class="nav-icon fas fa-user-tie"></i>
                            <p>
                                Driver
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="add-driver.php" class="nav-link">
                                    <i class="nav-icon fas fa-user-plus "></i>
                                    <p>Add Driver</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="manage-driver.php" class="nav-link">
                                    <i class="nav-icon fas fa-user-shield "></i>
                                    <p>Manage Driver</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item ">
                        <a href="manage-passenger.php" class="nav-link active">
                            <i class="nav-icon fas fa-street-view"></i>
                            <p>
                                Passenger
                            </p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="manage-reservation.php" class="nav-link ">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                Reservation
                            </p>
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a href="manage-rating.php" class="nav-link">
                            <i class="nav-icon fa fa-star"></i>
                            <p>
                                Driver Rating
                            </p>
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a href="manage-complaint.php" class="nav-link ">
                            <i class="nav-icon fa fa-sticky-note"></i>
                            <p>
                                Complaint
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
                        <h1 class="m-0 text-dark">ADMIN | Passenger Management </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard.php">Admin</a></li>
                            <li class="breadcrumb-item active">Passenger</li>
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
            <h3>List of All Passenger
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
                    <th>Full Name</th>
                    <th>Address</th>
                    <th>Contact No</th>
                    <th>Email</th>
                    <th class="no-print">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php

                $query = mysqli_query($con, "select * from passenger");
                $cnt = 1;
                while ($row = mysqli_fetch_array($query)) {
                    ?>

                    <tr>
                        <td><?php echo $cnt; ?></td>
                        <td><?php echo $row['FlName']; ?></td>
                        <td><?php echo $row['Address']; ?></td>
                        <td><a href="tel:<?= $row['ContactNo']; ?>"><?php echo $row['ContactNo']; ?></a></td>
                        <td><a href="mailto:<?= $row['Email']; ?>"><?php echo $row['Email']; ?></a></td>
                        <td class="text-center no-print">
                            <a href="manage-passenger.php?pid=<?php echo $row['pid']; ?>&&action=delete"
                               onclick="return confirm('Do you really want to delete this record?');">
                                <i class="fas fa fa-trash " aria-hidden="true" style="color:red"
                                   title="Delete this record"></i>
                            </a>
                        </td>
                    </tr>

                    <?php $cnt++;
                } ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Address</th>
                    <th>Contact No</th>
                    <th>Email</th>
                    <th class="no-print">Action</th>
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

