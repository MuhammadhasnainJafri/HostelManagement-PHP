
<?php 
if(isset($_POST['confirm'])){
include('../includes/dbconn.php');
$query=$_GET['query'];
$admin_id=$_GET['admin_id'];
$result=mysqli_query($mysqli,$query);
if($result){
$last_id = $mysqli->insert_id;
echo $last_id;
$sql="UPDATE `hostel_owner` SET `hostel_id`='$last_id' where `id`='$admin_id'";

$result=mysqli_query($mysqli,$sql);
if($result){
    header("location:manage-hostel.php");
}
}
}
?>
<form method="post">
<button type="submit" name="confirm" id="confirm"></button>
</form>
<script>
var conf=confirm("THis owner already have hostel.Do you want to change the hostel of that owner")
if(conf){
    document.getElementById('confirm').click();
}

</script>