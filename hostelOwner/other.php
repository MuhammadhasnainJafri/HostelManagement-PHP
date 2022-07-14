<?php
session_start();
include('../includes/dbconn.php');
include('../includes/pdoconfig.php');
include('../includes/check-login.php');
check_login();
$aid = $_SESSION['id'];
$hostel = "SELECT * from pm_hotel where `admin_id`='$aid' ";
$run = $mysqli->query($hostel);
$hostel_id = $run->fetch_assoc()['id'];
if (isset($_POST['submit'])) {
    $query = "DELETE FROM `facilities` Where `hostel_id`='$hostel_id'";
    $oresult = mysqli_query($mysqli, $query);
    if (isset($_POST['WIFI'])) {
        $facility = $_POST['WIFI'];
        $query = "INSERT INTO `facilities` ( `hostel_id`, `admin_id`, `facilityName`) VALUES ('$hostel_id', '$aid', '$facility');";
        $oresult = mysqli_query($mysqli, $query);
    }
    if (isset($_POST['CarpetedRooms'])) {
        $facility = $_POST['CarpetedRooms'];
        $query = "INSERT INTO `facilities` ( `hostel_id`, `admin_id`, `facilityName`) VALUES ('$hostel_id', '$aid', '$facility');";
        $oresult = mysqli_query($mysqli, $query);
    }
    if (isset($_POST['TV'])) {
        $facility = $_POST['TV'];
        $query = "INSERT INTO `facilities` ( `hostel_id`, `admin_id`, `facilityName`) VALUES ('$hostel_id', '$aid', '$facility');";
        $oresult = mysqli_query($mysqli, $query);
    }
    if (isset($_POST['bathroom'])) {
        $facility = $_POST['bathroom'];
        $query = "INSERT INTO `facilities` ( `hostel_id`, `admin_id`, `facilityName`) VALUES ('$hostel_id', '$aid', '$facility');";
        $oresult = mysqli_query($mysqli, $query);
    }
    if (isset($_POST['laundry'])) {
        $facility = $_POST['laundry'];
        $query = "INSERT INTO `facilities` ( `hostel_id`, `admin_id`, `facilityName`) VALUES ('$hostel_id', '$aid', '$facility');";
        $oresult = mysqli_query($mysqli, $query);
    }
    if (isset($_POST['security'])) {
        $facility = $_POST['security'];
        $query = "INSERT INTO `facilities` ( `hostel_id`, `admin_id`, `facilityName`) VALUES ('$hostel_id', '$aid', '$facility');";
        $oresult = mysqli_query($mysqli, $query);
    }
    if (isset($_POST['AirConditioning'])) {
        $facility = $_POST['AirConditioning'];
        $query = "INSERT INTO `facilities` ( `hostel_id`, `admin_id`, `facilityName`) VALUES ('$hostel_id', '$aid', '$facility');";
        $oresult = mysqli_query($mysqli, $query);
    }
    if (isset($_POST['Camera'])) {
        $facility = $_POST['Camera'];
        $query = "INSERT INTO `facilities` ( `hostel_id`, `admin_id`, `facilityName`) VALUES ('$hostel_id', '$aid', '$facility');";
        $oresult = mysqli_query($mysqli, $query);
    }
    
}

$error = "";
?>




<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Hostel Management System</title>
    <!-- Custom CSS -->
    <link href="../assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="../assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../dist/css/style.min.css" rel="stylesheet">

</head>

<body>

    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

        <header class="topbar" data-navbarbg="skin6">
            <?php include 'includes/navigation.php' ?>
        </header>

        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <?php include 'includes/sidebar.php' ?>
            </div>
            <!-- End Sidebar scroll-->
        </aside>

        <div class="page-wrapper">

            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Edit Room Details</h4>
                        <div class="d-flex align-items-center">
                            <!-- <nav aria-label="breadcrumb">
                                
                            </nav> -->
                        </div>
                    </div>

                </div>
            </div>


            <div class="container-fluid">

                <form method="POST">

                    <div class="row">






                        <div>
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Hostel Facilities</h4>
                                    <div class="form-group mb-4 row">

                                    <?php

// $ret = "SELECT * from facilities where `hostel_id`='$hostel_id' ";
// $stmt = $mysqli->prepare($ret);
// $stmt->execute();
// $res = $stmt->get_result();
// $cnt = 1;
// $checkbox=array();
// $i=0;
// while ($row = $res->fetch_object()) {
//     $checkbox[$i]=$row['facilityName'];
//     $i++;
    
// }
?>


                                        <div class="col-5"> <input type="checkbox" name="WIFI" value="Wifi"> Wifi
                                        </div>
                                        <div class="col-5"> <input type="checkbox" name="CarpetedRooms" value="Carpeted Rooms"> Carpeted Rooms</div>
                                        <div class="col-5"> <input type="checkbox" name="TV"    value="TV"> TV
                                        </div>
                                        <div class="col-5"> <input type="checkbox" name="bathroom"  value="Attached Bathroom"> Attached Bathroom
                                        </div>
                                        <div class="col-5"> <input type="checkbox" name="laundry"   value="Laundry"> Laundry
                                        </div>
                                        
                                        <div class="col-5"> <input type="checkbox" name="security"  value="24 Hour Security"> 24 Hour Security
                                        </div>
                                        <div class="col-5"> <input type="checkbox" name="AirConditioning"   value="Air Conditioning"> Air Conditioning</div>
                                        
                                        <div class="col-5"> <input type="checkbox" name="Camera"    value="CCTV Camera"> CCTV Camera
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>






                    </div>






            </div>


            <div class="form-actions">
                <div class="text-center">
                    <button type="submit" name="submit" class="btn btn-success">Update facilities</button>
                    <!-- <button type="reset" class="btn btn-danger">Reset</button> -->
                </div>
            </div>

            </form>


        </div>

        <?php include '../includes/footer.php' ?>

    </div>

    </div>

    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="../dist/js/app-style-switcher.js"></script>
    <script src="../dist/js/feather.min.js"></script>
    <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <script src="../assets/extra-libs/c3/d3.min.js"></script>
    <script src="../assets/extra-libs/c3/c3.min.js"></script>
    <script src="../assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="../assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="../dist/js/pages/dashboards/dashboard1.min.js"></script>

</body>

</html>