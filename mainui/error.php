<?php 
require_once("../includes/dbconn.php");
$query = "SELECT * FROM `pm_hotel`";
$result=mysqli_query($mysqli, $query);
print_r($result) ;
?>