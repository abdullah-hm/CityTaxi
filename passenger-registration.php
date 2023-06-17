<?php
error_reporting(0);
include('includes/config.php');

if (isset($_POST['submit'])) {
//getting post values

    $fullname = $_POST['fullname'];
    $address = $_POST['address'];
    $contactno = $_POST['contactno'];
    $email = $_POST['email'];
    $np = md5($_POST['np']);
    $cp = md5($_POST['cp']);
    $ep = $_POST['cp'];


    if ($np === $cp) {

        $query = mysqli_query($con, "select * from passenger where Email='$email'");

        if ($row = mysqli_fetch_array($query)) {
            echo "<script>alert('Email Already Already Exists. Please try again.');</script>";
            echo "<script>window.location.href='passenger-registration.php'</script>";
        } else {
            $query = "insert into passenger(FlName,Address,ContactNo,Email,Password) values('$fullname','$address','$contactno','$email','$cp')";
            $result = mysqli_query($con, $query);
            if ($result) {
                require "phpmailer/PHPMailerAutoload.php";
                $mail = new PHPMailer;

                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 587;
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'tls';

                $mail->Username = 'system.citytaxi@gmail.com';
                $mail->Password = 'Citytaxi@123';

                $mail->setFrom('system.citytaxi@gmail.com', 'system.citytaxi@gmail.com');
                $mail->addAddress($_POST["email"]);

                $mail->isHTML(true);
                $mail->Subject = "CityTaxi Passenger Credentials";
                $mail->Body = "<p>Dear user, <br> 
                Your Username is <b> $email </b><br>
                Password is <b> $ep </b> <br> </p> 
                <br><br>
                <p>With regards,</p>
                <b>System Admin ,<br> 
                City-Taxi pvt Ltd</b><br>
                <i><a href='https://citytaxi.cf/login.php'>citytaxi.cf</a></i>
                ";

                if (!$mail->send()) {
                    ?>
                    <script>
                        alert("<?php echo "Register Failed, Invalid Email "?>");
                    </script>
                    <?php
                } else {
                    ?>
                    <script>
                        alert("<?php echo "Passenger Registered Successfully, User Name and Password sent to " . $email ?>");
                        window.location.replace('index.php');
                    </script>
                    <?php
                }

            } else {
                echo "<script>alert('Something went wrong. Please try again.');</script>";
                echo "<script>window.location.href='passenger-registration.php'</script>";
            }
        }

    } else {
        echo "<script>alert('New Password And Confirm Password Does Not Match. Please try again.');</script>";
        echo "<script>window.location.href='passenger-registration.php'</script>";
    }

}
?>

<?php include('includes/login-header.php'); ?>

    <script>
        function passengerAvailability() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check_availability.php",
                data: 'email=' + $("#pemail").val(),
                type: "POST",
                success: function (data) {
                    $("#passenger-availability-status").html(data);
                    $("#loaderIcon").hide();
                },
                error: function () {
                }
            });
        }
    </script>
    <body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="row">
                <div class="col-12 p-2">
                    <h1 align="center" style="margin-top:4%;color:#fff">Welcome To CityTaxi (pvt) Ltd</h1>
                    <br>

                </div>
                <div class="card col-md-6 col-sm-12 offset-md-3">

                    <div class="card-body ">

                        <form class="passenger" method="post">

                            <center><h1 class="h4 text-gray-900 mb-4"><b> Passenger Registration</b></h1></center>
                            <div class="form-group">
                                <input type="text" name="fullname"
                                       placeholder="Enter Full Name" class="form-control" required="true">
                            </div>
                            <div class="form-group">
                                <input type="text" name="address" placeholder="Enter Address"
                                       autocomplete="off" class="form-control" required="true">
                            </div>
                            <div class="form-group">
                                <input type="tel" name="contactno" placeholder="Enter Contact No"
                                       minlength="9" maxlength="10"
                                       autocomplete="off" class="form-control" required="true">
                            </div>

                            <div class="form-group">
                                <input type="email" name="email" placeholder="Enter Email ID" id="pemail"
                                       onblur="passengerAvailability()"
                                       autocomplete="off" class="form-control" required="true">
                                <span id="passenger-availability-status"></span>
                            </div>
                            <div class="form-group">
                                <input type="password" name="np" placeholder="New Password"
                                       autocomplete="off" class="form-control" required="true">
                            </div>

                            <div class="form-group">
                                <input type="password" name="cp" placeholder="Confirm Password"
                                       autocomplete="off" class="form-control" required="true">
                            </div>

                            <div class="text-center">
                                <input type="submit" name="submit" id="submit"
                                       class="btn btn-primary btn-user btn-block"
                                       value="S u b m i t">

                                <br>
                                <a class="medium" href="login.php" style="font-weight:bold"><i
                                            class="fa fa-arrow-alt-circle-right" aria-hidden="true"></i>
                                    Signin</a>

                            </div>


                    </div>


                    </form>


                </div>

            </div>

        </div>

    </div>

<?php include('includes/login-footer.php'); ?>