<?php
session_start();
include('../includes/dbconn.php');
include('../includes/check-login.php');
check_login();

if (isset($_POST['submit'])) {
    $seater = $_POST['seater'];
    $fees = $_POST['fees'];
    $id = $_GET['id'];
    $hostel_id=$_POST['hostel_id'];
    $query = "UPDATE rooms set seater=?,fees=?,hostel_id=? where id=?";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('iiii', $seater, $fees, $hostel_id,$id);
    $stmt->execute();
    echo "<script>alert('Room details has been updated');
        window.location.href='manage-rooms.php';
        </script>";
}
$error="";
?>


<?php 


    $id=1;
    $sql="SELECT * FROM `pm_hotel`  where `id`='$id'";
    $result=mysqli_query($mysqli,$sql);
   
    if($result){
        // print_r($result->fetch_assoc());
        if($result->fetch_assoc()['admin_id']!=NULL){
                echo "1";
        }else{
           echo "null";
        }
    }
exit;
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


                        <?php
                        $id = $_GET['id'];
                        $ret = "SELECT * from rooms where id=?";
                        $stmt = $mysqli->prepare($ret);
                        $stmt->bind_param('i', $id);
                        $stmt->execute(); //ok
                        $res = $stmt->get_result();
                        //$cnt=1;
                        while ($row = $res->fetch_object()) {
                        ?>


                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Room Number</h4>
                                        <div class="form-group">
                                            <input type="text" name="rmno" value="<?php echo $row->room_no; ?>" id="rmno" class="form-control" disabled>
                                        </div>

                                    </div>
                                </div>
                            </div>



                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Seater</h4>
                                        <div class="form-group mb-4">
                                            <select class="custom-select mr-sm-2" id="seater" name="seater" required="required">
                                                <option value="<?php echo $row->seater; ?>"><?php echo $row->seater; ?></option>
                                                <option value="1">Single Seater</option>
                                                <option value="2">Two Seater</option>
                                                <option value="3">Three Seater</option>
                                                <option value="4">Four Seater</option>
                                                <option value="5">Five Seater</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Total Fees</h4>
                                        <div class="form-group">
                                            <input type="number" name="fees" id="fees" value="<?php echo $row->fees; ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>

                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Hostel</h4>
                                <h5 class="h5 text-danger">
                                    <?php
                                    echo $error;
                                    ?></h5>
                                <div class="form-group mb-4">
                                    <select class="custom-select mr-sm-2" name="hostel_id" required="required">
                                       
                                        <?php
                                        $ret = "SELECT * from pm_hotel;";
                                        $stmt = $mysqli->prepare($ret);
                                        $stmt->execute(); //ok
                                        $res = $stmt->get_result();
                                        $cnt = 1;
                                        while ($row = $res->fetch_object()) {
                                        ?>
                                            <?php
                                            $hostel = "SELECT * from pm_hotel where id='$row->hostel_id'";

                                            $resulthostel = mysqli_query($mysqli, $hostel);
                                            if ($resulthostel) {
                                                if($resulthostel->fetch_assoc()['id']==$row->id){
?>
<option value="<?php echo $row->id; ?>" selected><?php echo $row->title; ?></option>
<?php 


                                                }else{?>
                                                    <option value="<?php echo $row->id; ?>"><?php echo $row->title; ?></option>
                                             <?php 
                                             
                                                }
                                                
                                            }
                                            ?>

                                            


                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>



            </div>


            <div class="form-actions">
                <div class="text-center">
                    <button type="submit" name="submit" class="btn btn-success">Update</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
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
