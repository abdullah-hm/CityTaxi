<?php
session_start();

include('includes/config.php');

if (isset($_POST['login'])) {

    $utype = $_POST['usertype'];
    $email = $_POST['email'];
    $Password = md5($_POST['inputpwd']);

    if ($utype == 'admin') {

        $admin_query = mysqli_query($con, "select * from admin where  Email='$email' && Password='$Password' ");
        $result = mysqli_fetch_array($admin_query);
        if ($result > 0) {
            $_SESSION['AID'] = $result['aid'];
            $_SESSION['Name'] = $result['FlName'];
            header('location: admin/index.php');
        } else {
            echo "<script>alert('Invalid Admin Details.');</script>";
        }

    } elseif ($utype == 'driver') {

        $driver_query = mysqli_query($con, "select * from driver where  Email='$email' && Password='$Password' ");
        $result = mysqli_fetch_array($driver_query);
        if ($result > 0) {
            $_SESSION['DRID'] = $result['drid'];
            $_SESSION['Name'] = $result['FlName'];
            header('location: driver/index.php');
        } else {
            echo "<script>alert('Invalid Driver Details.');</script>";
        }
    } elseif ($utype == 'passenger') {

        $passenger_query = mysqli_query($con, "select * from passenger where  Email='$email' && Password='$Password'");
        $result = mysqli_fetch_array($passenger_query);
        if ($result > 0) {
            $_SESSION['PID'] = $result['pid'];
            $_SESSION['Name'] = $result['FlName'];
            header('location: passenger/index.php');
        } else {
            echo "<script>alert('Invalid Passenger Details.');</script>";
        }
    } else {
        echo "<script>alert('Invalid Details. Please Try Again..!');</script>";
    }

}
?>


<?php include('includes/login-header.php'); ?>

    <body class="bg-gradient-warning ">
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">
                <br>
                <h1 align="center" style="margin-top:4%;color:#000"><b>WELCOME TO CityTaxi (pvt) Ltd</b></h1>
                <div class="card o-hidden border-0 shadow-lg my-5">

                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <form name="login" method="post">
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block  ">
                                    <a href="index.php">
                                        <img src="https://www.citytaxi.al/sites/default/files/citytaxi-slider-2.jpg"
                                             width="460px" height="420px">
                                    </a>
                                </div>
                                <div class="col-lg-6">
                                    <div class="p-4">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Sign In</h1>
                                        </div>
                                        <form class="login">

                                            <div class="form-group">
                                                <select name="usertype" class="form-control" required>
                                                    <option value="">Select User Type</option>
                                                    <option value="admin">Admin</option>
                                                    <option value="driver">Driver</option>
                                                    <option value="passenger">Passenger</option>
                                                </select>
                                            </div>


                                            <div class="form-group">
                                                <input type="email" class="form-control" name="email"
                                                       id="email" placeholder="Enter Email ID" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control" name="inputpwd"
                                                       id="inputpwd" placeholder="Enter Password" required>
                                            </div>
                                            <input type="submit" name="login" class="btn btn-primary btn-user btn-block"
                                                   value="login">
                                        </form>
                                        <hr>
                                        <div class="text-center">
                                            <a class="medium" href="passenger-registration.php"
                                               style="font-weight:bold"> SignUp Passenger</a>
                                            <br>
                                            <br>

                                            For Manual  Booking <a class="medium" href="tel:94777511882"
                                               style="font-weight:bold">0777511882</a>

                                        </div>

                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>

            </div>

        </div>

    </div>


<?php include('includes/login-footer.php'); ?>