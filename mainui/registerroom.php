<?php 
require_once("../includes/dbconn.php");
$id=$_GET['id'];
if(isset($_POST['name'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_no = $_POST['phone_no'];
    $gender = $_POST['gender'];
    $registrationNumber = $_POST['registrationNumber'];
    $password = $_POST['password'];
    $password = md5($password);
    date_default_timezone_set("Asia/Karachi");
    $date=date("y-m-d");;
   
    $mess = $_POST['mess'];
    $seater=$_POST['roomseater'];

    $roomNumber = $_POST['roomNumber'];//
    $fees = $_POST['roomfees'];
   
    $query = "INSERT INTO `studentbooking`( `name`, `email`, `reg_id`, `password`, `contactNumber`, `gender`,`mess`,`seater`,`fees`,`roomNumber`,`stayfrom`) VALUES 
    ('$name','$email','$registrationNumber','$password','$phone_no','$gender','$mess','$seater','$fees','$roomNumber','$date')";
    if (mysqli_query($mysqli, $query)) {
        $_SESSION['email']=$email;
        $_SESSION['password']=$password;
        $message = urlencode(" room is successfully registered ");
        header("location:../login.php?message=".$message);
    }else{
        echo $query;
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


<input type="hidden" value="<?php echo $id ?>" name="hostel_id">


                        <div class="col-sm-12 col-md-6 col-lg-6 ">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Name</h4>
                                    <div class="form-group mt-3">
                                        <input type="text" name="name"  id='name' class="form-control field required" placeholder="Please Enter your name" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">email</h4>
                                    <div class="form-group mt-3">
                                        <input type="text" name="email" id="email" class="form-control field required" placeholder="Please Enter your email" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mt-3">Register Number</h4>
                                    <div class="form-group mt-3">
                                        <input type="text" id="registrationNumber" name="registrationNumber" class="form-control field required" placeholder="Please Enter your Registration Numer" required>
                                    </div>
                                </div>
                            </div>
                        </div>


                        

                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mt-3">Room Number</h4>
                                    <div class="form-group mt-3">
                                    <select class="form-control field required" name="roomNumber" id="room" onChange="getSeater(this.value);"  required id="inlineFormCustomSelect" >
                                            <?php 
                                             
                                             $query = "SELECT * FROM `rooms` where `hostel_id` = '$id'";
                                             $stmt2 = $mysqli->prepare($query);
                                             $stmt2->execute();
                                             $res = $stmt2->get_result();
                                            //  echo "<option selected>Select...</option>";
                                             while ($row = $res->fetch_object()) {
                                             ?>
                                                 <option value="<?php echo $row->room_no; ?>"> <?php echo $row->room_no; ?></option>
                                             <?php } 
                                             
                                             ?>
                                        </select>
                                        
                                     </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="roomseater" id="roomseater">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mt-3">Seater</h4>
                                    <div class="form-group mt-3">
                                    <input type="text" id="seater" onchange="roomseater(this.value)" name="seater" 
                                    placeholder="Enter Seater No."  class="form-control field "   disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mt-3">MESS</h4>
                                    <div class="form-group mt-3">
                                    <select class="form-control field required" name="mess" id="mess" onChange="getmess(document.getElementById('room').value,this.value);"  required >
                                        <option value="1">Yes</option>
                                        <option value="0" selected >No</option>
                                    </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                       





                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mt-3">Password</h4>
                                    <div class="form-group mt-3">
                                        <input type="password" id="password" name="password" class="form-control field required" placeholder="Please Enter your Password" required>
                                    </div>
                                </div>
                            </div>
                        </div>
               
                    <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mt-3">Contact Number</h4>
                                    <div class="form-group mt-3">
                                        <input type="text" id="phone_no" name="phone_no" class="form-control field required" placeholder="Please Enter your Phone Number" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                   

                    <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mt-3">Gender</h4>
                                    <div class="form-group mt-3">
                                    <select class="form-control field required" id="gender" name="gender" required>  
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                  
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="roomfees" id="roomfees">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                <h4 class="card-title mt-3">Total Fees Per Month</h4>
                                    <div class="form-group">
                                        <input type="text" name="fees" id="fpm" placeholder="Your total fees" class="mt-3 form-control field "  disabled>
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

    var val= $('#seater').val()
    $('#roomseater').val(val);

    var fees= $('#fpm').val()
    $('#roomfees').val(fees);

    

    if(!$('#name').val() && !$('#email').val() && !$('#registrationNumber').val() && !$('#seater').val() && !$('#mess').val() && !$('#password').val()  && !$('#fpm').val() ){


        alert("Please fill the form first");
    }else{
    //     form=document.getElementById('myForm');
    // const submitFormFunction = Object.getPrototypeOf(form).submit;
    // submitFormFunction.call(form);

        pay(fees)
   
    
    }
}

</script>
<script src="js/common.min.js"></script>
        <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
<script>
 
function getmess(val,status){

    $.ajax({
        type: "POST",
        url: "get-seater.php",
        data:'messfee='+val,
        success: function(data){
        // alert(data);
        if(status==1){
            var hostelfee=Number($('#fpm').val());
            var messfee=Number(data);
            
        $('#fpm').val(hostelfee+messfee);
        }else if(status==0){
            getSeater(val);
        }
        }
        });
}


    function getSeater(val) {
        $.ajax({
        type: "POST",
        url: "get-seater.php",
        data:'roomid='+val,
        success: function(data){
        //alert(data);
        $('#seater').val(data.trim());
        }
        });

       

        $.ajax({
        type: "POST",
        url: "get-seater.php",
        data:'rid='+val,
        success: function(data){
        //alert(data);
        $('#fpm').val(data.trim());
        }
        });
        $('#mess').val(0);
    }

    getSeater( $('#room').val())
    </script>







<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://checkout.stripe.com/checkout.js"></script>
 
<script type="text/javascript">
 
  function pay(amount) {
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
          url:"payment.php",
          method: 'post',
          data: { tokenId: token.id, amount: amount },
          dataType: "json",
          success: function( response ) {
            
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




            </div>
            </div>
        </main>
        <!-- rooms page content end -->
        <?php 
        include 'partials/footer.php';
        ?>
       
    </body>
</html>
