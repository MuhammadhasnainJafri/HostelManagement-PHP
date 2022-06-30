<?php
session_start();
include('../includes/dbconn.php');
$id="";
if(isset($_GET['id'])){
    $id=$_GET['id'];
}
if (isset($_POST['submit'])) {

    $recipy_eve = $_POST['recipy_eve'];
    $recipy_morning = $_POST['recipy_morning'];
    $recipy_noon = $_POST['recipy_noon'];
    $id=$_POST['id'];
    $query="UPDATE `mess` SET `recipy_eve`='$recipy_eve',`recipy_morning`='$recipy_morning',`recipy_noon`='$recipy_noon' WHERE `id`='$id'";
 
    
    if (mysqli_query($mysqli, $query)) {
    header("Location:manage-mess.php");
    }


}
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

    <script type="text/javascript">
        function valid() {
            if (document.registration.password.value != document.registration.cpassword.value) {
                alert("Password and Confirm Password does not match");
                document.registration.cpassword.focus();
                return false;
            }
            return true;
        }
    </script>

</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
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
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">hostel Registration Form</h4>
                        <div class="d-flex align-items-center">
                            <!-- <nav aria-label="breadcrumb">
                                
                            </nav> -->
                        </div>
                    </div>

                </div>
            </div>

            <div class="container-fluid">

                <form method="POST" name="registration" onSubmit="return valid();">
<input type="hidden" name="id" value="<?php echo $id ?>">
                    <div class="row">

<?php 
 $ret="SELECT * from mess WHERE id ='$id';";
 $stmt= $mysqli->prepare($ret) ;
 $stmt->execute() ;//ok
 $res=$stmt->get_result();
 $result=$res->fetch_assoc();
?>

                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Breakfast recipe</h4>
                                    <div class="form-group">
                                        <input type="text" name="recipy_morning" value="<?php 
                                        echo $result['recipy_morning'];
                                        ?>" class="form-control" required>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Lunch recipe</h4>
                                    <div class="form-group">
                                        <input type="text" name="recipy_noon" value="<?php 
                                        echo $result['recipy_noon'];
                                        ?>" class="form-control" required>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Dinner recipe</h4>
                                    <div class="form-group">
                                        <input type="text" name="recipy_eve" value="<?php 
                                        echo $result['recipy_eve'];
                                        ?>" class="form-control" required>
                                    </div>

                                </div>
                            </div>
                        </div>
                       
                       


                      



                     
                        


                        











                    </div>


                    <div class="form-actions">
                        <div class="text-center">
                            <button type="submit" name="submit" class="btn btn-success">Update</button>
                           
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

    <!-- customs -->
    <script>
        function checkAvailability() {

            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check-availability.php",
                data: 'emailid=' + $("#email").val(),
                type: "POST",
                success: function(data) {
                    $("#user-availability-status").html(data);
                    $("#loaderIcon").hide();
                },
                error: function() {
                    event.preventDefault();
                    alert('error');
                }
            });
        }
    </script>
</body>

</html>