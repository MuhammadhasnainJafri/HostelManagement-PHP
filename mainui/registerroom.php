<?php 
require_once("../includes/dbconn.php");
if(isset($_POST['name'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_no = $_POST['phone_no'];
    $gender = $_POST['gender'];
    $registrationNumber = $_POST['registrationNumber'];
    $password = $_POST['password'];
    $password = md5($password);
    $query = "INSERT INTO `registrationrequest`( `name`, `email`, `reg_id`, `password`, `contactNumber`, `gender`) VALUES 
    ('$name','$email','$registrationNumber','$password','$phone_no','$gender')";
    if (mysqli_query($mysqli, $query)) {
        $_SESSION['email']=$email;
        $_SESSION['password']=$password;
        $message = urlencode("Applied for room successfully ");
        header("location:rooms.php?message=".$message);
    }
    exit;
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





                        <div class="col-sm-12 col-md-6 col-lg-6 ">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Name</h4>
                                    <div class="form-group mt-3">
                                        <input type="text" name="name" class="form-control field required" placeholder="Please Enter your name">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">email</h4>
                                    <div class="form-group mt-3">
                                        <input type="text" name="email" class="form-control field required" placeholder="Please Enter your email">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mt-3">Register Number</h4>
                                    <div class="form-group mt-3">
                                        <input type="text" name="registrationNumber" class="form-control field required" placeholder="Please Enter your Registration Numer">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mt-3">Password</h4>
                                    <div class="form-group mt-3">
                                        <input type="password" name="password" class="form-control field required" placeholder="Please Enter your Password">
                                    </div>
                                </div>
                            </div>
                        </div>
               
                    <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mt-3">Contact Number</h4>
                                    <div class="form-group mt-3">
                                        <input type="text" name="phone_no" class="form-control field required" placeholder="Please Enter your Phone Number">
                                    </div>
                                </div>
                            </div>
                        </div>

                   

                    <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mt-3">Gender</h4>
                                    <div class="form-group mt-3">
                                    <select class="form-control field required" name="gender">  
                                        <option value="0">Male</option>
                                        <option value="1">Female</option>
                                    </select>
                                  
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
   
    form=document.getElementById('myForm');
    const submitFormFunction = Object.getPrototypeOf(form).submit;
    submitFormFunction.call(form);
}

</script>

            </div>
            </div>
        </main>
        <!-- rooms page content end -->
        <?php 
        include 'partials/footer.php';
        ?>
        <script src="js/common.min.js"></script>
    </body>
</html>
