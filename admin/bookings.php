<?php
    session_start();
    include('../includes/dbconn.php');
    include('../includes/check-login.php');
    $error="";
    check_login();
    //code for registration
    if(isset($_POST['submit'])){
        $roomno=$_POST['room'];
        $hostel_id= $_POST['hostel_id'];
        $seater=$_POST['seater'];
        $feespm=$_POST['fpm'];
        $foodstatus=$_POST['foodstatus'];
        $stayfrom=$_POST['stayf'];
        $password=md5($_POST['password']);
        $regno=$_POST['regno'];
        $fname=$_POST['fname'];
        $mname=$_POST['mname'];
        $lname=$_POST['lname'];
        $name=$fname." ".$mname." ".$lname;
        $gender=$_POST['gender'];
        $contactno=$_POST['contact'];
        $emailid=$_POST['email'];
        $gurname=$_POST['gname'];
        $gurrelation=$_POST['grelation'];
        $gurcntno=$_POST['gcontact'];
        $caddress=$_POST['address'];
       $active='active';
        
        $query="INSERT into  studentbooking  (`name`, `email`, `reg_id`, `roomNumber`, `mess`, `seater`, `password`, `contactNumber`, `gender`, `fees`, `status`, `stayfrom`, `guardianName`, `guardianRelation`, `guardianContactno`, `corresAddress`,`hostel_id`) 
        values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $mysqli->prepare($query);
        $rc=$stmt->bind_param('ssisssssssssssssi',$name,$emailid,$regno,$roomno,$foodstatus,$seater,$password,$contactno,$gender,$feespm,$active,$stayfrom,$gurname,$gurrelation,$gurcntno,$caddress,$hostel_id);
        
        $stmt->execute();
        echo"<script>alert('Success: Booked!');</script>";
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

    <script>
    function getSeater(val) {
        $.ajax({
        type: "POST",
        url: "get-seater.php",
        data:'roomid='+val,
        success: function(data){
        //alert(data);
        $('#seater').val(data);
        }
        });

        $.ajax({
        type: "POST",
        url: "get-seater.php",
        data:'rid='+val,
        success: function(data){
        //alert(data);
        $('#fpm').val(data);
        }
        });
    }
    </script>
    
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
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Hostel Bookings</h4>
                        <div class="d-flex align-items-center">
                            <!-- <nav aria-label="breadcrumb">
                                
                            </nav> -->
                        </div>
                    </div>
                    
                </div>
            </div>
           
            <div class="container-fluid">

            <form method="POST">
                
                <?php
                    $stmt=$mysqli->prepare("SELECT emailid FROM registration WHERE emailid=? ");
                    $stmt->bind_param('s',$uid);
                    $stmt->execute();
                    $stmt -> bind_result($email);
                    $rs=$stmt->fetch();
                    $stmt->close();

                    if($rs){ ?>
                    <div class="alert alert-primary alert-dismissible bg-primary text-white border-0 fade show"
                        role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                        </button>
                                <strong>Info: </strong> You have already booked a hostel!
                    </div>
                    <?php }
                    else{
						echo "";
					}			
				?>	


             

                
                <div class="row">



                <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">



                                    <h4 class="card-title">Hostel</h4>
                                    <h5 class="h5 text-danger">
                                        <?php
                                                        echo $error;
                                                                ?></h5>
                                    <div class="form-group mb-4">
                                        <select class="custom-select mr-sm-2" onchange="updateroom(this.value)" id="hostel_id" name="hostel_id" required="required">
                                            <option value="0" selected>Choose...</option>
                                            <?php
                                            $ret = "SELECT * from pm_hotel;";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            $cnt = 1;
                                            while ($row = $res->fetch_object()) {
                                            ?>

                                                <option value="<?php echo $row->id; ?>"><?php echo $row->title; ?></option>


                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>
<script>
function updateroom(value){
var hostel_id=document.getElementById('hostel_id').value;
document.getElementById("room").innerHTML = "";
const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("room").innerHTML = this.responseText;
    }
  xhttp.open("GET", "roomdata.php?hostel_id="+value, true);
  xhttp.send();
}
</script>




                    <div class="col-sm-12 col-md-6 col-lg-4" id="roomdiv">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Room Number</h4>
                                    <div class="form-group mb-4">
                                        <select class="custom-select mr-sm-2" name="room" id="room" onChange="getSeater(this.value);" onBlur="checkAvailability()" required id="inlineFormCustomSelect">
                                            
                                            
                                        </select>
                                        <span id="room-availability-status" style="font-size:12px;"></span>
                                    </div>
                              
                            </div>
                        </div>
                    </div>

                
 
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Start Date</h4>
                                    <div class="form-group">
                                        <input type="date" name="stayf" id="stayf" class="form-control" required>
                                    </div>
                                
                            </div>
                        </div>
                    </div>



                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Seater</h4>
                                    <div class="form-group">
                                        <input type="text" id="seater" name="seater" placeholder="Enter Seater No." required class="form-control">
                                    </div>
                            </div>
                        </div>
                    </div>


                    
                    

                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                        <div class="card-body">
                                <h4 class="card-title">Mess and laundary  Status</h4>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio1" value="1" name="foodstatus"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1">Required 
                                        <!-- <code>Extra RS 6000 Per Month</code> -->
                                    </label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" value="0" name="foodstatus"
                                        class="custom-control-input" checked>
                                    <label class="custom-control-label" for="customRadio2">Not Required</label>
                                </div>
                                
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Total Fees Per Month</h4>
                                    <div class="form-group">
                                        <input type="text" name="fpm" id="fpm" placeholder="Your total fees" class="form-control">
                                    </div>
                            </div>
                        </div>
                    </div>
                    

                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Total Amount</h4>
                                    <div class="form-group">
                                        <input type="text" name="ta"  id="ta" placeholder="Total Amount here.." required class="form-control">
                                    </div>
                            </div>
                        </div>
                    </div>
                  
                
                </div>

                <h4 class="card-title mt-5">Student's Personal Information</h4>

                <div class="row">

                
                    <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Registration Number</h4>
                                        <div class="form-group">
                                            <input type="text" name="regno" id="regno" placeholder="Enter registration number" class="form-control" required>
                                        </div>
                                </div>
                            </div>
                        </div>


                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">First Name</h4>
                                    <div class="form-group">
                                        <input type="text" name="fname" id="fname" placeholder="Enter first name" class="form-control" required>
                                    </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Middle Name</h4>
                                    <div class="form-group">
                                        <input type="text" name="mname" id="mname" placeholder="Enter middle name" class="form-control" required>
                                    </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Last Name</h4>
                                    <div class="form-group">
                                        <input type="text" name="lname" id="lname" placeholder="Enter last name" class="form-control" required>
                                    </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Email</h4>
                                    <div class="form-group">
                                        <input type="email" name="email" id="email" placeholder="Enter email address" class="form-control" required>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">password</h4>
                                    <div class="form-group">
                                        <input type="text" name="password" id="email" placeholder="Enter Student Password " class="form-control" required>
                                    </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Gender</h4>
                                    <div class="form-group">
                                    <select name="gender" class="form-control" required="required">
                                        <option value="">Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                       
                                    </select>
                                    </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Contact Number</h4>
                                    <div class="form-group">
                                        <input type="number" name="contact" id="contact" placeholder="Enter contact number" class="form-control" required>
                                    </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Emergency Contact Number</h4>
                                    <div class="form-group">
                                        <input type="number" name="econtact" id="econtact" placeholder="Enter emergency contact number" class="form-control" required>
                                    </div>
                            </div>
                        </div>
                    </div>


                    
                              
                </div>

                <h4 class="card-title mt-5">Guardian's Information</h4>

                    <div class="row">
                    
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Guardian Name</h4>
                                        <div class="form-group">
                                            <input type="text" name="gname" id="gname" class="form-control" placeholder="Enter Guardian's Name" required>
                                        </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Relation</h4>
                                        <div class="form-group">
                                            <input type="text" name="grelation" id="grelation" required class="form-control" placeholder="Student's Relation with Guardian">
                                        </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Contact Number</h4>
                                        <div class="form-group">
                                            <input type="text" name="gcontact" id="gcontact" required class="form-control" placeholder="Enter Guardian's Contact No.">
                                        </div>
                                </div>
                            </div>
                        </div>
                    
                    </div>

                    <h4 class="card-title mt-5">Current Address Information</h4>

                    <div class="row">
                    
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Address</h4>
                                        <div class="form-group">
                                            <input type="text" name="address" id="address" class="form-control" placeholder="Enter Address" required>
                                        </div>
                                </div>
                            </div>
                        </div>


                       


                       

                    
                    </div>


                 


                 
                    
                   


                       
                    
                    
                    </div>


                    <div class="form-actions">
                        <div class="text-center">
                            <button type="submit" name="submit" class="btn btn-success">Submit</button>
                            <button type="reset" class="btn btn-dark">Reset</button>
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

    <!-- Custom Ft. Script Lines -->
<script type="text/javascript">
	$(document).ready(function(){
        $('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
                $('#paddress').val( $('#address').val() );
                $('#pcity').val( $('#city').val() );
                $('#ppincode').val( $('#pincode').val() );
            } 
            
        });
    });
    </script>
    
    <script>
        function checkAvailability() {
        $("#loaderIcon").show();
        jQuery.ajax({
        url: "check-availability.php",
        data:'roomno='+$("#room").val(),
        type: "POST",
        success:function(data){
            $("#room-availability-status").html(data);
            $("#loaderIcon").hide();
        },
            error:function (){}
            });
        }
    </script>


    <script type="text/javascript">

    $(document).ready(function() {
        $('#duration').keyup(function(){
            var fetch_dbid = $(this).val();
            $.ajax({
            type:'POST',
            url :"ins-amt.php?action=userid",
            data :{userinfo:fetch_dbid},
            success:function(data){
            $('.result').val(data);
            }
            });
            

    })});
    </script>

</body>

</html>