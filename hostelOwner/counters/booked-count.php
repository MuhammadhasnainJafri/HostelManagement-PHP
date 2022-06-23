<?php
    include '../includes/dbconn.php';
    $id=$_SESSION['id'];
    $hostel="SELECT * from pm_hotel where `admin_id`='$id' ";
    $run=$mysqli->query($hostel);
    $hostel_id=$run->fetch_assoc()['id'];
    $sql = "SELECT id FROM registration where `hostel_id`='$hostel_id'";
                $query = $mysqli->query($sql);
                echo "$query->num_rows";
?>