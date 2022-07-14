<?php
    require_once("../includes/dbconn.php");
    if(!empty($_POST["emailid"])) {
        $email= $_POST["emailid"];
        if (filter_var($email, FILTER_VALIDATE_EMAIL)===false) {

            echo "error : You did not enter a valid email.";
        } else {
            $result ="SELECT count(*) FROM userRegistration WHERE email=?";
            $stmt = $mysqli->prepare($result);
            $stmt->bind_param('s',$email);
            $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    if($count>0){
    echo "<span style='color:red'> Email already exist .</span>";
        } else {
            echo "<span style='color:green'> Email available for registration .</span>";
        }
     }
    }

    if(!empty($_POST["oldpassword"])) {
    $pass=$_POST["oldpassword"];
    $result ="SELECT password FROM userregistration WHERE password=?";
    $stmt = $mysqli->prepare($result);
    $stmt->bind_param('s',$pass);
    $stmt->execute();
    $stmt -> bind_result($result);
    $stmt -> fetch();
    $opass=$result;
    if($opass==$pass) 
    echo "<span style='color:green'> Password  matched.</span>";
    else echo "<span style='color:red'>Password doesnot match!</span>";
    }


    if(!empty($_POST["roomno"])) { 
    $roomno=$_POST["roomno"];
    if(isset($_GET['hostel_id'])){
    $hostel_id=$_GET["hostel_id"];
    }
    $result ="SELECT * FROM `rooms` where `hostel_id` = '$hostel_id' AND `room_no` = '$roomno' AND `occupied`<`seater`";
    $stmt = $mysqli->query($result);
   
    if($stmt->num_rows>0)
    echo "<span style='color:red'>Seats Available</span>";
   
    else
        echo "<span style='color:red'>Seats already full.</span>";
    }
?>