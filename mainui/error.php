<?php
require_once("../includes/dbconn.php");
$ret = "SELECT title,lat,lng FROM `pm_hotel`";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
$cnt = 1;
$locationarray = array();
while ($row = $res->fetch_object()) {
    $locationarray[] = $row;
}

$location = json_encode($locationarray);



?>

<script>
    var data = <?php echo $location; ?>;
 
    
    for (x in data) {
        document.write(data[x].lat);
       
    }
    
</script>