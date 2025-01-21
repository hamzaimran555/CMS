<?php
$conn=mysqli_connect("localhost","root","","cms_db");
if(!$conn){
    echo "<script>
    alert ('Data base is not connected')
    </script>";
}
?>