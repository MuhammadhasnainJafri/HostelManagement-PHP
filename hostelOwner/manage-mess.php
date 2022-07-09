<?php
    session_start();
    include('../includes/dbconn.php');
    include('../includes/check-login.php');
    check_login();
   
    
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
     <!-- This page plugin CSS -->
     <link href="../assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
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
   
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
       
        <header class="topbar" data-navbarbg="skin6">
            <?php include 'includes/navigation.php'?>
        </header>
       
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <?php include 'includes/sidebar.php'?>
            </div>
            <!-- End Sidebar scroll-->
        </aside>
       
        <div class="page-wrapper">
            
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Messs Management</h4>
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
                          
                            <hr>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-hover table-bordered no-wrap">
                                    <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Day</th>
                                                <th>morning recipe</th>
                                                <th>noon recipe</th>
                                                <th>evening recipe</th>
                                                
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php	
                                       
                                            $aid=$_SESSION['id'];
                                            $hostel="SELECT * from pm_hotel where `admin_id`='$aid' ";
                                            $run=$mysqli->query($hostel);
                                            $hostel_id=$run->fetch_assoc()['id'];
                                            $ret="SELECT * from mess where hostel_id='$hostel_id' ";
                                            $stmt= $mysqli->prepare($ret) ;
                                            //$stmt->bind_param('i',$aid);
                                            $stmt->execute() ;//ok
                                            $res=$stmt->get_result();
                                            $cnt=1;
                                            if($res->num_rows>0){
                                            while($row=$res->fetch_object())
                                                {
                                                    ?>
                                        <tr><td><?php echo $cnt;;?></td>
                                        <td><?php echo $row->day;?></td>
                                        <td><?php echo $row->recipy_morning;?></td>
                                        <td><?php echo $row->recipy_noon;?></td>
                                        <td><?php echo $row->recipy_eve;?></td>
                                        
                                        
                                        <td><a href="edit-Mess.php?id=<?php echo $row->id;?>" title="Edit"><i class="icon-note"></i></a>&nbsp;&nbsp;
                                        </td>
                                        </tr>
                                            <?php
                                                $cnt=$cnt+1;
                                            }}else{

                                                    $monday="INSERT INTO `mess`(`hostel_id`, `admin_id`, `day`, `recipy_morning`, `recipy_noon`, `recipy_eve`) VALUES ('$hostel_id','$aid','Monday','NULL','NULL','NULL')";
                                                    $monday=mysqli_query($mysqli, $monday);

                                                    $Tuesday="INSERT INTO `mess`(`hostel_id`, `admin_id`, `day`, `recipy_morning`, `recipy_noon`, `recipy_eve`) VALUES ('$hostel_id','$aid','Tuesday','NULL','NULL','NULL')";
                                                    $Tuesday=mysqli_query($mysqli, $Tuesday);

                                                    $Wednesday="INSERT INTO `mess`(`hostel_id`, `admin_id`, `day`, `recipy_morning`, `recipy_noon`, `recipy_eve`) VALUES ('$hostel_id','$aid','Wednesday','NULL','NULL','NULL')";
                                                    $Wednesday=mysqli_query($mysqli, $Wednesday);

                                                    $Thursday="INSERT INTO `mess`(`hostel_id`, `admin_id`, `day`, `recipy_morning`, `recipy_noon`, `recipy_eve`) VALUES ('$hostel_id','$aid','Thursday','NULL','NULL','NULL')";
                                                    $Thursday=mysqli_query($mysqli, $Thursday);

                                                    $Friday="INSERT INTO `mess`(`hostel_id`, `admin_id`, `day`, `recipy_morning`, `recipy_noon`, `recipy_eve`) VALUES ('$hostel_id','$aid','Friday','NULL','NULL','NULL')";
                                                    $Friday=mysqli_query($mysqli, $Friday);

                                                    $Saturday="INSERT INTO `mess`(`hostel_id`, `admin_id`, `day`, `recipy_morning`, `recipy_noon`, `recipy_eve`) VALUES ('$hostel_id','$aid','Saturday','NULL','NULL','NULL')";
                                                    $Saturday=mysqli_query($mysqli, $Saturday);

                                                    $Sunday="INSERT INTO `mess`(`hostel_id`, `admin_id`, `day`, `recipy_morning`, `recipy_noon`, `recipy_eve`) VALUES ('$hostel_id','$aid','Sunday','NULL','NULL','NULL')";
                                                    $Sunday=mysqli_query($mysqli, $Sunday);
                                                    header('location:manage-mess.php');

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