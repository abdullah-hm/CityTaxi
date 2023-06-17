<?php

session_start();
error_reporting(0);

if (!isset($_SESSION['DRID'])) {
    header('Location:../logout.php');
}
$drid = $_SESSION['DRID'];

include('../AdminLTE/header.php');
include_once('../includes/config.php');

if ($_GET['action'] == 'accept') {

    $bid = intval($_GET['ftid']);
    $drid = $_SESSION['DRID'];



    $query1 = mysqli_query($con, "select * from driver where drid='$drid'");
    $cnt = 1;
    while ($row = mysqli_fetch_array($query1)) {

        $DrvName = $row['FlName'];
        $ContactNo = $row['ContactNo'];
        $VRNo = $row['VehicleRegNo'];
        $cnt++;
    }

    $query3 = mysqli_query($con, "select * from booking where bid='$bid'");
    $cntt = 1;
    while ($row1 = mysqli_fetch_array($query3)) {

        $pid = $row1['pid'];
        $cntt++;
    }

    $query = "insert into sms(drid,pid,DvrName,ContactNo,VrNo,Date) values('$drid','$pid','$DrvName','$ContactNo',CURRENT_DATE)";

    $query2 = "update booking set Status='Accepted' where bid='$bid'";

    $query4 = "update driver set Availability='Busy' where drid='$drid'";

    $result1 = mysqli_query($con, $query);
    $result2 = mysqli_query($con, $query2);
    $result3 = mysqli_query($con, $query4);

    if ($result1 && $result2 && $result3) {
        echo '<script>alert("Trip Successfully Accepted.")</script>';
        echo "<script>window.location.href='find-trip.php'</script>";
    } else {
        echo '<script>alert("Trip Successfully Accepted.")</script>';
        echo "<script>window.location.href='find-trip.php'</script>";
    }

}

if ($_GET['action'] == 'decline') {

    $bid = intval($_GET['ftid']);


    $query = "update booking set Status='Decline' where bid='$bid'";
    $result = mysqli_query($con, $query);
    if ($result) {
        echo '<script>alert("Trip Successfully Declined")</script>';
        echo "<script>window.location.href='find-trip.php'</script>";
    } else {
        echo "<script>alert('Something went wrong. Please try again.');</script>";
        echo "<script>window.location.href='find-trip.php'</script>";
    }
}

if ($_GET['action'] == 'complete') {

    $bid = intval($_GET['ftid']);


    $query = "update booking set Status='Completed' where bid='$bid'";
    $query1 = "update driver set Availability='Available' where drid='$drid'";
    $result = mysqli_query($con, $query);
    $result1 = mysqli_query($con, $query1);

    if ($result && $result2) {
        echo '<script>alert("Trip Successfully Completed")</script>';
        echo "<script>window.location.href='find-trip.php'</script>";
    } else {
        echo '<script>alert("Trip Successfully Completed")</script>';
        echo "<script>window.location.href='find-trip.php'</script>";
    }
}



if (isset($_POST['submit'])) {

    $vp = $_POST['vp'];

    echo "<script>window.location.href='view-passenger.php?vp=$vp'</script>";

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
                    <i class="fas fa fa-user"></i><b> <?= $_SESSION['Name'] ?> </b>
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
                        <a href="find-trip.php" class="nav-link active">
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
                    <div class="col-sm-8">
                        <h1 class="m-0 text-dark">Driver | Trip Management</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard.php">Driver</a></li>
                            <li class="breadcrumb-item active">Booking</li>
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
                    <!--                   today pending bookings-->
                    <div class="card col-lg-12 col-sm-12">
                        <div class="card-header ">
                            <h3 style="color:blue">List of Today's Pending Trip
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

                                    <th>Passenger ID</th>
                                    <th>PickUp</th>
                                    <th>DropOff</th>
                                    <th>PickUp Date</th>
                                    <th>PickUp Time</th>
                                    <th>View Passenger</th>
                                    <th>Accept</th>
                                    <th>Decline</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                $query = mysqli_query($con, "select * from booking where drid='$drid' and Status='Pending' and PickUpDate=CURDATE() ");
                                $cnt = 1;
                                while ($row = mysqli_fetch_array($query)) {
                                    $cnt;
                                    ?>

                                    <tr>
                                        <td><?php echo $row['pid']; ?></td>
                                        <td><?php echo $row['PickUp']; ?></td>
                                        <td><?php echo $row['DropOff']; ?></td>
                                        <td><?php echo $row['PickUpDate']; ?></td>
                                        <td><?php echo $row['PickUpTime']; ?></td>
                                        <td class="text-center no-print">
                                            <a href="view-passenger.php?vp=<?php echo $row['pid']; ?>">
                                                <i class=" fas fa fa-eye " aria-hidden="true"
                                                   style="color:green"
                                                   title="View Passenger Details"></i>
                                            </a>
                                        </td>
                                        <td class="text-center no-print ">
                                            <a href="find-trip.php?ftid=<?php echo $row['bid']; ?>&&action=accept"
                                               onclick="return confirm('Do you really want to Accept this Trip?');">
                                                <i class=" fas fa fa-check-square " aria-hidden="true"
                                                   style="color:dodgerblue"
                                                   title="Accept Trip"></i>
                                            </a>
                                        </td>
                                        <td class="text-center no-print">
                                            <a href="find-trip.php?ftid=<?php echo $row['bid']; ?>&&action=decline"
                                               onclick="return confirm('Do you really want to Decline this Trip?');">
                                                <i class="fas 	fa fa-times-circle " aria-hidden="true"
                                                   style="color:red"
                                                   title="Decline Trip"></i>
                                            </a>
                                        </td>


                                    </tr>

                                    <?php $cnt++;
                                } ?>
                                </tbody>
                                <tfoot>
                                <tr>


                                    <th>Passenger ID</th>
                                    <th>PickUp</th>
                                    <th>DropOff</th>
                                    <th>PickUp Date</th>
                                    <th>PickUp Time</th>
                                    <th>View Passenger</th>
                                    <th>Accept</th>
                                    <th>Decline</th>

                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <!--                    today accepted bookings-->
                    <div class="card col-lg-12 col-sm-12">
                        <div class="card-header ">
                            <h3 style="color:green">List of Today's Accepted Trip
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

                                    <th>Passenger ID</th>
                                    <th>PickUp</th>
                                    <th>DropOff</th>
                                    <th>PickUp Date</th>
                                    <th>PickUp Time</th>
                                    <th>Action</th>


                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                $query = mysqli_query($con, "select * from booking where drid='$drid' and Status='Accepted' and PickUpDate=CURDATE() ");
                                $cnt = 1;
                                while ($row = mysqli_fetch_array($query)) {
                                    $cnt;
                                    ?>

                                    <tr>
                                        <td><?php echo $row['pid']; ?></td>
                                        <td><?php echo $row['PickUp']; ?></td>
                                        <td><?php echo $row['DropOff']; ?></td>
                                        <td><?php echo $row['PickUpDate']; ?></td>
                                        <td><?php echo $row['PickUpTime']; ?></td>
                                        <td class="text-center no-print">
                                            <a href="find-trip.php?ftid=<?php echo $row['bid']; ?>&&action=complete"
                                               onclick="return confirm('Do you really want to Complete this Trip?');">
                                                <i class="fas fa fa-trash " aria-hidden="true" style="color:green"
                                                   title="Accept Trip"></i>
                                            </a>
                                        </td>


                                    </tr>

                                    <?php $cnt++;
                                } ?>
                                </tbody>
                                <tfoot>
                                <tr>


                                    <th>Passenger ID</th>
                                    <th>PickUp</th>
                                    <th>DropOff</th>
                                    <th>PickUp Date</th>
                                    <th>PickUp Time</th>
                                    <th>Action</th>

                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <!--                   today rejected bookings-->
                    <div class="card col-lg-12 col-sm-12">
                        <div class="card-header ">
                            <h3 style="color:red">List of Today's Decline Trip
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

                                    <th>Passenger ID</th>
                                    <th>PickUp</th>
                                    <th>DropOff</th>
                                    <th>PickUp Date</th>
                                    <th>PickUp Time</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $drid = $_SESSION['DRID'];
                                $query = mysqli_query($con, "select * from booking where drid='$drid' and Status='Decline' and PickUpDate=CURDATE() ");
                                $cnt = 1;
                                while ($row = mysqli_fetch_array($query)) {
                                    $cnt;
                                    ?>

                                    <tr>
                                        <td><?php echo $row['pid']; ?></td>
                                        <td><?php echo $row['PickUp']; ?></td>
                                        <td><?php echo $row['DropOff']; ?></td>
                                        <td><?php echo $row['PickUpDate']; ?></td>
                                        <td><?php echo $row['PickUpTime']; ?></td>
                                    </tr>

                                    <?php $cnt++;
                                } ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Passenger ID</th>
                                    <th>PickUp</th>
                                    <th>DropOff</th>
                                    <th>PickUp Date</th>
                                    <th>PickUp Time</th>
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

