<?php

session_start();
error_reporting(0);

if (!isset($_SESSION['DRID'])) {
    header('Location:../logout.php');
}

include('../AdminLTE/header.php');
include_once('../includes/config.php');


$drid = $_SESSION['DRID'];


$query = mysqli_query($con, "select * from driver where drid='$drid'");
$cnt = 1;
while ($row = mysqli_fetch_array($query)) {

    $oldpass = $row['Password'];
    $cnt++;
}


if (isset($_POST['update'])) {
//getting post values

    if ($_POST['pwd']) {
        $pwd = md5($_POST['pwd']);
    } else {
        $pwd = $oldpass;
    }

    $email = $_POST['email'];
    $fullname = $_POST['fullname'];
    $dlc = $_POST['drlcno'];
    $vrno = $_POST['vrno'];
    $dob = $_POST['dob'];
    $addr = $_POST['address'];
    $mobile = $_POST['contactno'];


    $query = "update driver set FlName='$fullname',DrvLcNo='$dlc',Dob='$dob',Address='$addr',ContactNo='$mobile',VehicleRegNo='$vrno',Email='$email',Password='$pwd'  where drid='$drid'";

    $result = mysqli_query($con, $query);
    if ($result) {
        echo '<script>alert("Driver record updated successfully.")</script>';
        echo "<script>window.location.href='profile.php'</script>";
    } else {
        echo "<script>alert('Driver record went wrong. Please try again.');</script>";
        echo "<script>window.location.href='profile.php'</script>";
    }
}




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
                    <i class="fas fa fa-user"></i> Mr/Mrs: <b> <?= $_SESSION['Name'] ?> </b>
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
                        <a href="dashboard.php" class="nav-link ">

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
                        <a href="profile.php" class="nav-link active">
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
                        <h1 class="m-0 text-dark">ADMIN | Update Driver</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard.php">Admin</a></li>
                            <li class="breadcrumb-item active">Driver</li>
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

                    <form method="post" name="updatedriver">
                        <!-- SELECT2 EXAMPLE -->
                        <div class="card card-default">
                            <!-- /.card-header -->


                            <div class="card-body">

                                <div class="row">

                                    <?php

                                    $query = mysqli_query($con, "select * from driver where drid='$drid'");
                                    $branches = mysqli_query($con, "select * from vehicle");

                                    $cnt = 1;
                                    while ($row = mysqli_fetch_array($query)) {
                                        ?>
                                        <div class="form-group col-sm-6 col-md-6">
                                            <label>Email</label>
                                            <div class="input-group">
                                                <input type="email" placeholder="Enter Email Address"
                                                       name="email" value="<?= $row['Email']; ?>"
                                                       class="form-control" readonly="true" required>
                                                <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                            class="fas fa-envelope"></i></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-6 col-md-6">
                                            <label>Password</label>
                                            <div class="input-group">
                                                <input type="password" placeholder="******"
                                                       name="pwd"
                                                       class="form-control">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                            class="fas fa-lock"></i></span>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group col-sm-6 col-md-6">
                                            <label>Full Name</label>
                                            <div class="input-group">
                                                <input type="text" value="<?= $row['FlName']; ?>"
                                                       name="fullname"
                                                       class="form-control" required>
                                                <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                            class="fas fa-user"></i></span>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group col-sm-6 col-md-6">
                                            <label>Driving License No</label>
                                            <div class="input-group">
                                                <input type="text" value="<?= $row['DrvLcNo']; ?>"
                                                       name="drlcno" maxlength="12" minlength="8"
                                                       class="form-control" required>
                                                <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                            class=" fa fa-address-card"></i></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-6 col-md-6">
                                            <label>Vehicle Reg No</label>
                                            <div class="input-group">
                                                <input type="text" value="<?= $row['DrvLcNo']; ?>"
                                                       name="vrno" maxlength="12" minlength="4"
                                                       class="form-control" readonly required>
                                                <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                            class=" fa fa-car"></i></span>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group col-sm-6 col-md-6">
                                            <label>DOB</label>
                                            <div class="input-group date" id="empdob" data-target-input="nearest">
                                                <input value="<?= $row['Dob']; ?>" type="text" name="dob"
                                                       class="form-control datetimepicker-input"
                                                       data-target="#empdob"
                                                       required/>
                                                <div class="input-group-append" data-target="#empdob"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-calendar-alt"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-6 col-md-6">
                                            <label>Address</label>
                                            <div class="input-group">
                                                <input type="text" value="<?= $row['Address']; ?>"
                                                       name="address"
                                                       class="form-control" minlength="4" required>
                                                <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                            class="fas fa fa-map-pin"></i></span>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group col-sm-6 col-md-6">
                                            <label>Contact No</label>
                                            <div class="input-group">
                                                <input type="tel" value="<?= $row['ContactNo']; ?>"
                                                       name="contactno"
                                                       class="form-control" minlength="9" maxlength="10" required>
                                                <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                            class="fas fa-phone-alt"></i></span>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group offset-md-3  offset-sm-2 col-sm-6 col-md-6">
                                            <div class="text-center">
                                                <button type="submit" value="submit" name="update"
                                                        class="btn btn-block bg-gradient-info btn-lg ">
                                                    Update
                                                </button>
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                    <?php } ?>
                                </div>


                                <!-- /.row -->
                            </div>

                        </div>
                        <!-- /.card -->
                    </form>


                </div>


            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


</div>

<?php include('../AdminLTE/footer.php') ?>

