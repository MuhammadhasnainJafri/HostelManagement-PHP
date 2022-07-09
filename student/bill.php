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
        ('$row->id','$row->hostel_id','$row->stayfrom','$row->fees','$date','pending')" ;  
        mysqli_query($mysqli, $sql);
        
        
    }
}

if(isset($_POST['messID'])){
$messID = $_POST['messID'];
$sql="UPDATE `bill` SET `status`='paid' where `id`='$messID'";
$result=mysqli_query($mysqli, $sql);
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
        <?php include '../includes/student-navigation.php'?>
        </header>

        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
            <?php include '../includes/student-sidebar.php'?>
            </div>
            <!-- End Sidebar scroll-->
        </aside>

        <div class="page-wrapper">

            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">All bill Details</h4>
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
                                            $email="";
                                            
                                            $ret = "SELECT * from bill where `student_id`='$aid' ORDER BY status DESC ";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute();
                                            $res = $stmt->get_result();
                                            $cnt = 1;
                                            while ($row = $res->fetch_object()) {
                                            ?>
                                                <tr
                                                <?php 
                                                if($row->status=="pending"){
                                                    echo 'style="color:red"';
                                                }
                                                ?>
                                                
                                                >
                                                    <td><?php echo $cnt;; ?></td>
                                                    <?php
                                                    $studentname = "SELECT * from `studentbooking` where `id`='$row->student_id'";
                                                    $result = $mysqli->prepare($studentname);
                                                    $result->execute();
                                                    $result = $result->get_result();
                                                    $result = $result->fetch_assoc();
                                                    $email=$result['email'];



                                                    ?>

                                                    <td><?php echo $result['name']; ?></td>
                                                    <td><?php echo $row->start_from; ?></td>
                                                    <td><?php echo $row->bill; ?></td>
                                                    <td><?php echo $row->status; ?></td>


                                                    <td>
                                                        
                                                    <?php 
                                                    if($row->status=="pending"){
                                                       ?>
 <button class="btn btn-success" onclick="pay(<?php echo $row->bill; ?>,<?php echo $row->id; ?>)">Pay bill</button>
                                                       <?php
                                                    }
                                                    ?>
                                                   
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


<input type="hidden" name="email" id="email" value="<?php echo $email; ?>" />
<form name="myForm" method="post" id="myForm">
<input type="hidden" name="messID" id="messID">

</form>

                                            
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://checkout.stripe.com/checkout.js"></script>
 
<script type="text/javascript">
 
  function pay(amount,id) {
    var handler = StripeCheckout.configure({
      key: 'pk_test_51KSIZ6KsJbDsp0nKpyqSylxQiWUfEEAyAY6zc6EOr6QyD4iPPcFMrU46GvQDdwxTckANgnJXBDB03Q5TbNbB2Y6o00mRsVVXdL', // your publisher key id
      locale: 'auto',
      currency:'PKR',
      email:$('#email').val(),

      token: function (token) {
        // You can access the token ID with `token.id`.
        // Get the token ID to your server-side code for use.
        console.log('Token Created!!');
        console.log(token)
        $('#token_response').html(JSON.stringify(token));
 
        $.ajax({
          url:"../mainui/payment.php",
          method: 'post',
          data: { tokenId: token.id, amount: amount },
          dataType: "json",
          success: function( response ) {
           $('#messID').val(id);
            form=document.getElementById('myForm');
            const submitFormFunction = Object.getPrototypeOf(form).submit;
            submitFormFunction.call(form);



            console.log(response.data);
            $('#token_response').append( '<br />' + JSON.stringify(response.data));
            
          }
        })
      }
    });
  
    handler.open({
      name: 'Demo Site',
      description: '2 widgets',
      amount: amount * 100
    });
  }
</script>












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