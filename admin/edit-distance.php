<?php

session_start();
error_reporting(0);
include_once('../includes/config.php');

include('../AdminLTE/header.php');
if (!isset($_SESSION['AID'])) {
    header('Location:../logout.php');
}


if (isset($_POST['update'])) {
    $dsid = intval($_GET['dsid']);
//getting post values

    $lcfrom = $_POST['lc_from'];
    $lcto = $_POST['lc_to'];
    $km = $_POST['km'];
    $per_km = $_POST['per_km'];
    $amount = $km * $per_km;

    $query = "update distance set LocationFrom='$lcfrom',LocationTo='$lcto',KM='$km',Amount='$amount' where dsid='$dsid'";
    $result = mysqli_query($con, $query);
    if ($result) {
        echo '<script>alert("Location Distance record updated successfully.")</script>';
        echo "<script>window.location.href='manage-distance.php'</script>";
    } else {
        echo "<script>alert('Something went wrong. Please try again.');</script>";
        echo "<script>window.location.href='manage-distance.php'</script>";
    }
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
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
                    <i class="fas fa fa-user"></i><b> <?= $_SESSION['Name'] ?> </b>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

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
                    <li class="nav-item has-treeview menu-open">
                        <a href="manage-distance.php" class="nav-link active">
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
                                <a href="manage-distance.php" class="nav-link active">
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
                        <a href="manage-passenger.php" class="nav-link ">
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
                        <h1 class="m-0 text-dark">Admin Dashboard | Update Branch</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard.php">Admin</a></li>
                            <li class="breadcrumb-item active">Branch</li>
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

                    <?php
                    $dsid = intval($_GET['dsid']);
                    $query = mysqli_query($con, "select * from distance where dsid='$dsid'");
                    $cnt = 1;
                    while ($row = mysqli_fetch_array($query)) {
                        ?>
                        <form method="post" name="updatedistance">
                            <!-- SELECT2 EXAMPLE -->

                            <!-- /.card-header -->


                            <div class="card col-md-6  col-sm-12 offset-md-3">
                                <div class="row card-body">

                                    <div class="form-group col-12">
                                        <label>Location From:</label>
                                        <div class="input-group">
                                            <input type="text"
                                                   name="lc_from"
                                                   class="form-control"
                                                   required value="<?php echo $row['LocationFrom']; ?>"
                                                   readonly="true">
                                            <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                                class="fas fa-map-pin"></i></span>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="form-group col-12">
                                        <label>Location To:</label>
                                        <div class="input-group">
                                            <input type="text"
                                                   name="lc_to"
                                                   class="form-control"
                                                   required value="<?php echo $row['LocationTo']; ?>"
                                                   readonly="true">
                                            <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                                class="fas fa-map-pin"></i></span>
                                            </div>

                                        </div>

                                    </div>


                                    <div class="form-group col-12">
                                        <label>KM (Distance)</label>
                                        <div class="input-group">
                                            <input type="number" value="<?php echo $row['KM']; ?>"
                                                   name="km"
                                                   class="form-control" required>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                            class="fas fa-map-pin"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-12">
                                        <label>Per KM Fee(Rs)</label>
                                        <select class="form-control" type="text" name="per_km"
                                                style="width: 100%" required>
                                            <option value="">Select Per KM Fee</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="75">75</option>
                                            <option value="100">100</option>
                                            <option value="200">200</option>
                                        </select>
                                    </div>


                                    <div class="form-group offset-md-3  offset-sm-2 col-sm-6 col-md-6">
                                        <div class="text-center ">
                                            <button type="submit" value="Update" name="update" id="update"
                                                    class=" py-2 btn btn-block bg-gradient-info btn-lg ">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                </div>

                                <!-- /.row -->


                            </div>
                            <!-- /.card -->
                        </form>
                    <?php } ?>

                </div>



            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

</div>

<?php include('../AdminLTE/footer.php') ?>

