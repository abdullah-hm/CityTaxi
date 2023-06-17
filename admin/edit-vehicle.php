<?php

session_start();
error_reporting(0);
include_once('../includes/config.php');

include('../AdminLTE/header.php');
if (!isset($_SESSION['AID'])) {
    header('Location:../logout.php');
}


if (isset($_POST['update'])) {
    $vid = intval($_GET['vid']);
//getting post values

    $regno = $_POST['regno'];
    $vname = $_POST['vname'];
    $mp = $_POST['maxperson'];
    $status = $_POST['status'];


    $query = "update vehicle set RegNo='$regno',VehicleName='$vname',MaxPerson='$mp',Availability='$status' where vid='$vid'";
    $result = mysqli_query($con, $query);
    if ($result) {
        echo '<script>alert("Vehicle record updated successfully.")</script>';
        echo "<script>window.location.href='manage-vehicle.php'</script>";
    } else {
        echo "<script>alert('Something went wrong. Please try again.');</script>";
        echo "<script>window.location.href='manage-vehicle.php'</script>";
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
                    <li class="nav-item has-treeview menu-close">
                        <a href="manage-distance.php" class="nav-link  ">
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
                                <a href="manage-distance.php" class="nav-link ">
                                    <i class="nav-icon fas fa-map-pin "></i>
                                    <p>Manage Distance</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item has-treeview menu-open">
                        <a href="manage-vehicle.php" class="nav-link active">
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
                                <a href="manage-vehicle.php" class="nav-link active">
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
                        <h1 class="m-0 text-dark">ADMIN | Update Vehicle</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard.php">Admin</a></li>
                            <li class="breadcrumb-item active">Vehicle</li>
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
                    $vid = intval($_GET['vid']);
                    $query = mysqli_query($con, "select * from vehicle where dsid='$vid'");
                    $cnt = 1;
                    while ($row = mysqli_fetch_array($query)) {
                    ?>
                    <form method="post" name="addlocation">
                        <!-- SELECT2 EXAMPLE -->
                        <div class="card card-default col-md-7 col-sm-12 offset-md-4">
                            <!-- /.card-header -->

                            <div class="card-header py-2 ">
                                <center><h5 class=" font-weight-bold text-primary">Add Location Information</h5>
                                </center>
                            </div>

                            <div class="card-body">

                                <div class="row">

                                    <div class="form-group col-12">
                                        <label>Vehicle Reg No</label>
                                        <div class="input-group">
                                            <input type="text" placeholder="Enter Vehicle Reg No"
                                                   name="vr_no" id="VRNo" minlength="4" maxlength="12"
                                                   class="form-control" onblur="vehicleRegNoAvailability()"
                                                   required>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                            class="fas fa-car-alt"></i></span>
                                            </div>
                                        </div>
                                        <span id="vrno-availability-status"></span>
                                    </div>


                                    <div class="form-group col-12">
                                        <label>Vehicle Name</label>
                                        <div class="input-group">
                                            <input type="text" placeholder="Enter Vehicle Name"
                                                   name="v_name" minlength="3"
                                                   class="form-control" required>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                            class="fas fa-car"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-12">
                                        <label>Maximum Person</label>
                                        <select class="form-control" type="text" name="max_person"
                                                style="width: 100%" required>
                                            <option value="">Select Max Person</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="8">8</option>
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
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.card-body -->


                        </div>
                        <!-- /.card -->
                    </form>

                    <?php } ?>

                </div>
                <div class="row">

                    <?php
                    $vid = intval($_GET['vid']);
                    $query = mysqli_query($con, "select * from vehicle where vid='$vid'");
                    $cnt = 1;
                    while ($row = mysqli_fetch_array($query)) {
                        ?>
                        <form method="post" name="updatevehicle">
                            <!-- SELECT2 EXAMPLE -->

                            <!-- /.card-header -->


                            <div class="card col-md-6  col-sm-12 offset-md-3">
                                <div class="row card-body">

                                    <div class="form-group col-12">
                                        <label>Vehicle Reg No:</label>
                                        <div class="input-group">
                                            <input type="text"
                                                   name="regno"
                                                   class="form-control"
                                                   required value="<?php echo $row['RegNo']; ?>"
                                                   readonly="true">
                                            <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                                class="fas fa-map-pin"></i></span>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="form-group col-12">
                                        <label>Vehicle Name:</label>
                                        <div class="input-group">
                                            <input type="text"
                                                   name="vname"
                                                   class="form-control"
                                                   required value="<?php echo $row['VehicleName']; ?>"
                                                   readonly="true">
                                            <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                                class="fas fa-map-pin"></i></span>
                                            </div>

                                        </div>

                                    </div>


                                    <div class="form-group col-12">
                                        <label>Max Person</label>
                                        <div class="input-group">
                                            <input type="text" value="<?php echo $row['MaxPerson']; ?>"
                                                   name="maxperson" maxlength="1"
                                                   class="form-control" required>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                            class="fas fa-map-pin"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-12">
                                        <label>Availability</label>
                                        <select class="form-control" type="text" name="status"
                                                style="width: 100%" required>
                                            <option value="">Select Availability</option>
                                            <option value="Available">Available</option>
                                            <option value="Unavailable">Unavailable</option>
                                        </select>
                                    </div>


                                    <div class="form-group offset-md-3  offset-sm-2 col-sm-6 col-md-6">
                                        <div class="text-center ">
                                            <button type="submit" value="Update" name="update" id="update"
                                                    class=" py-2 btn btn-block bg-gradient-info btn-lg ">
                                                Update
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

