<?php
require_once("../includes/dbconn.php");
if (isset($_POST['submit'])) {
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone_no = $_POST['phone_no'];
    $address = $_POST['address'];
    $hostel_id = NULL;
    $password = $_POST['password'];
    $password = md5($password);
    $query = "INSERT into hostel_owner(`username`, `email`, `password`, `phone_no`, `address`) values('$username','$email','$password','$phone_no','$address')";
    if (mysqli_query($mysqli, $query)) {

        $last_id = $mysqli->insert_id;
        $admin_id = $last_id;
        $title = $_POST['title'];
        $subtitle = $_POST['subtitle'];
        $address = $_POST['address'];
        $lat = $_POST['lat'];
        $lng = $_POST['lng'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $city = $_POST['city'];

        $query = "INSERT INTO `pm_hotel`(`admin_id`, `title`, `subtitle`, `address`, `lat`, `lng`, `email`, `phone`,`city`) VALUES ('$admin_id', '$title', '$subtitle', '$address', '$lat',' $lng', '$email', '$phone','$city')";




        $owner = "Select * from hostel_owner where id='$admin_id'";
        $oresult = mysqli_query($mysqli, $owner);
        if ($oresult) {
            if ($oresult->fetch_assoc()['hostel_id'] == NULL) {
                if (mysqli_query($mysqli, $query)) {
                    $last_id = $mysqli->insert_id;
                    echo $last_id;
                    $sql = "UPDATE `hostel_owner` SET `hostel_id`='$last_id' where `id`='$admin_id'";
                    $result = mysqli_query($mysqli, $sql);
                }

                echo "<script>alert('hostel has been Registered!');</script>";
                header("Location:../hostelOwner");
            } 
        }
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Rooms | Hosteller</title>
    <script id="www-widgetapi-script" src="https://s.ytimg.com/yts/jsbin/www-widgetapi-vflS50iB-/www-widgetapi.js" async=""></script>
    <script src="https://www.youtube.com/player_api"></script>
    <link rel="stylesheet preload" as="style" href="css/preload.min.css" />
    <link rel="stylesheet preload" as="style" href="css/libs.min.css" />

    <link rel="stylesheet" href="css/rooms.min.css" />
</head>

<body>
    <?php
    include 'partials/header.php';
    ?>
    <header class="page">
        <div class="container">
            <ul class="breadcrumbs d-flex flex-wrap align-content-center">
                <li class="list-item">
                    <a class="link" href="index.php">Home</a>
                </li>

                <li class="list-item">
                    <a class="link" href="#">Hostel</a>
                </li>
            </ul>
            <h1 class="page_title">Register</h1>
        </div>
    </header>
    <!-- rooms page content start -->
    <main class="rooms section">
        <div class="container col-8">
            <div class="container-fluid">

                <form method="POST" id="myForm">
                    <div class="row">



                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Username</h4>
                                    <div class="form-group">
                                        <input type="text" name="username" placeholder="Enter Username" id="regno" class="form-control mt-3 mb-2 field" required>
                                    </div>

                                </div>
                            </div>
                        </div>



                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">email</h4>
                                    <div class="form-group">
                                        <input type="text" name="email" placeholder="Enter email" required class="form-control mt-3 mb-2 field">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Password</h4>
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" placeholder="Enter Password" required="required" class="form-control mt-3 mb-2 field">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Confirm Password</h4>
                                    <div class="form-group">
                                        <input type="password" name="cpassword" id="cpassword" placeholder="Enter Confirmation Password" required="required" class="form-control mt-3 mb-2 field">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Phone Number</h4>
                                    <div class="form-group">
                                        <input type="text" name="phone_no" id="lname" placeholder="Enter Phone NUmner" required class="form-control mt-3 mb-2 field">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Address</h4>
                                    <div class="form-group">
                                        <input type="text" name="address" id="contact" placeholder="Your Address" required="required" class="form-control mt-3 mb-2 field ">
                                    </div>
                                </div>
                            </div>
                        </div>














                    </div>

                    <div class="row">



                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">hostel title</h4>
                                    <div class="form-group">
                                        <input type="text" name="title" placeholder="Enter hostel title" id="regno" class="form-control mt-3 mb-2 field" required>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Register hostel email</h4>
                                    <div class="form-group">
                                        <input type="text" name="email" placeholder="Enter hostel email" id="regno" class="form-control mt-3 mb-2 field" required>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Hostel Phone Number</h4>
                                    <div class="form-group">
                                        <input type="text" name="phone" placeholder="Enter hostel Phone Number" id="regno" class="form-control mt-3 mb-2 field" required>
                                    </div>

                                </div>
                            </div>
                        </div>



                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">subtitle</h4>
                                    <div class="form-group">
                                        <input type="text" name="subtitle" placeholder="Enter hostel subtitle" required class="form-control mt-3 mb-2 field">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">address</h4>
                                    <div class="form-group">
                                        <input type="text" name="address" placeholder="Enter hostel address" required="required" class="form-control mt-3 mb-2 field">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Hostel City</h4>
                                    <div class="form-group">
                                        <input type="text" name="city" placeholder="Enter Hostel city" required class="form-control mt-3 mb-2 field">
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Hostel Latitude</h4>
                                    <div class="form-group">
                                        <input type="text" name="lat" placeholder="Enter Hostel latitude" required class="form-control mt-3 mb-2 field">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Hostel Longitude</h4>
                                    <div class="form-group">
                                        <input type="text" name="lng" placeholder="Enter Hostel Longitude" required class="form-control mt-3 mb-2 field">
                                    </div>
                                </div>
                            </div>
                        </div>















                    </div>


            </div>


            <div class="form-actions">
                <div class="text-center">

                    <button type="submit" name="submit" class="btn btn-success field  mt-3" onclick="
                            submitform()">Submit</button>

                </div>
            </div>

            </form>
            <script>
                function submitform() {

                    form = document.getElementById('myForm');
                    const submitFormFunction = Object.getPrototypeOf(form).submit;
                    submitFormFunction.call(form);
                }
            </script>
            <script src="js/common.min.js"></script>
            <script src="../assets/libs/jquery/dist/jquery.min.js"></script>









            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>







        </div>
        </div>
    </main>
    <!-- rooms page content end -->
    <?php
    include 'partials/footer.php';
    ?>

</body>

</html>