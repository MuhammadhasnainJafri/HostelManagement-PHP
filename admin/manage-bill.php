<?php
session_start();
include('../includes/dbconn.php');
include('../includes/check-login.php');
check_login();
date_default_timezone_set("Asia/Karachi");
$date = date("Ym");

$newbill = "SELECT * from `bill` where `month`='$date'";
$result=mysqli_query($mysqli, $newbill);
if($result->num_rows==0){
    
    $ret = "SELECT * from studentbooking  where `status`='active' ";
    $stmt = $mysqli->prepare($ret);
    $stmt->execute();
    $res = $stmt->get_result();
    $cnt = 1;
    while ($row = $res->fetch_object()) {
       $sql="INSERT INTO `bill`(`student_id`, `hostel_id`, `start_from`, `bill`, `month`, `status`) VALUES
        ('$row->id','$row->hostel_id','$row->stayfrom','$row->fees','$date','unpaid')" ;  
        mysqli_query($mysqli, $sql);
        
        
    }
}   

?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Hostel Management System</title>

    <link href="../assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="../assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">

    <link href="../assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">

    <link href="../dist/css/style.min.css" rel="stylesheet">

</head>

<body>

    <!-- <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
     -->
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
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Course Management</h4>
                        <div class="d-flex align-items-center">
                            <!-- <nav aria-label="breadcrumb">
                                
                            </nav> -->

                        </div>
                    </div>

                </div>

            </div>

            <div class="container-fluid">

                <!-- Table Starts -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- <a href="add-courses.php"><button type="button" class="btn btn-block btn-md btn-success">Add New Course Details</button></a> -->
                                <hr>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-hover table-bordered no-wrap">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Student Name</th>
                                                <th>Start from</th>
                                                <th>Bill</th>
                                                <th>Bill status</th>

                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $aid = $_SESSION['id'];
                                            $ret = "SELECT * from bill ";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute();
                                            $res = $stmt->get_result();
                                            $cnt = 1;
                                            while ($row = $res->fetch_object()) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $cnt;; ?></td>
                                                    <?php
                                                    $studentname = "SELECT * from `studentbooking` where `id`='$row->student_id'";
                                                    $result = $mysqli->prepare($studentname);
                                                    $result->execute();
                                                    $result = $result->get_result();
                                                    $result = $result->fetch_assoc();



                                                    ?>

                                                    <td><?php echo $result['name']; ?></td>
                                                    <td><?php echo $row->start_from; ?></td>
                                                    <td><?php echo $row->bill; ?></td>
                                                    <td><?php echo $row->status; ?></td>


                                                    <td><a href="edit-bill.php?id=<?php echo $row->id; ?>&&name=<?php echo $result['name']; ?>" title="Edit"><i class="icon-note"></i></a>&nbsp;&nbsp;
                                                    </td>
                                                </tr>
                                            <?php
                                                $cnt = $cnt + 1;
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table Ends -->

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
    <script src="../assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../dist/js/pages/datatable/datatable-basic.init.js"></script>

</body>

</html>