<?php 
if(isset($_POST['billID'])){
    $billID=$_POST['billID'];
echo $billID;
}else{
    echo "errror";
}
?>