<?php
include('connection.php');
 if(isset($_GET['deleteid'])){
$id=$_GET['deleteid'];

$sql="Delete from customer_reg where customer_id=$id";
$result=(mysqli_query($conn,$sql));
if($result){
    // echo " <script>Deleted successfully</script>";
    header('location:users.php');
}
 }
?>