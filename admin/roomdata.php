<?php
    include('../includes/dbconn.php');
    include('../includes/check-login.php');
    $hostel_id=$_GET['hostel_id'];
$query = "SELECT * FROM `rooms` where `hostel_id` = '$hostel_id'";
$stmt2 = $mysqli->prepare($query);
$stmt2->execute();
$res = $stmt2->get_result();
echo "<option selected>Select...</option>";
while ($row = $res->fetch_object()) {
?>
    <option value="<?php echo $row->room_no; ?>"> <?php echo $row->room_no; ?></option>
<?php } 

?>