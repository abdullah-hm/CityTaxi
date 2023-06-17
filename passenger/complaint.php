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
//getting post values

    $pid = $_SESSION['PID'];
    $cid = 1;
    $title = $_POST['title'];
    $description = $_POST['description'];
    $email = $_POST['email'];
    $query = "insert into `complaint`(`cid`, `PsgrId`, `Title`, `Discription`) VALUES ('1','$pid','$title','$description')";
    $result = mysqli_query($con, $query);
    if ($result) {
        echo '<script>alert("Complaint added Successfully.")</script>';
        echo "<script>window.location.href='complaint.php'</script>";
    } else {
        echo "<script>alert('Something went wrong. Please try again.');</script>";
        echo "<script>window.location.href='complaint.php'</script>";
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
                        <a href="complaint.php" class="nav-link active">
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
                        <h1 class="m-0 text-dark">Add Complaint</h1>
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
            
            <div class="row">
                <div class="col-lg-2 col-2">    
                </div>
                <div class="no-print col-lg-8 col-8">
                    <!-- small box -->
                    <div class="shadow p-3 mb-5 bg-white rounded">
                        <form method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control " id="formGroupExampleInput2" name = "title" placeholder="Title" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" id="exampleFormControlTextarea1" required name="description" rows="5"></textarea>
                            </div>
                            <button type="submit" class="btn btn-warning btn-lg" name="submit"> SUBMIT </button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-2 col-2">    
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

</div>

<?php include('../AdminLTE/footer.php') ?>

