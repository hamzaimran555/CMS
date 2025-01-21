<?php
include ('connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head><body>
<table class="table">
  <thead>
    <tr>
      <th scope="col">customer_id</th>
      <th scope="col">customer_name</th>
      <th scope="col">customer_cnic</th>
      <th scope="col">customer_address</th>
      <th scope="col">customer_email</th>
      <th scope="col">customer_pass</th>
      <th scope="col">Operations</th>


    </tr>
  </thead>


    <?php
    $query = "SELECT * FROM customer_reg";
    $runn = mysqli_query($conn , $query);
    // $sno = 0;
    if($runn){
        while($rows = mysqli_fetch_assoc($runn) ){
     $id=$rows['customer_id'];
     $name=$rows['customer_name'];
     $cnic=$rows['customer_cnic'];
     $address=$rows['customer_address'];
     $email=$rows['customer_email'];
     $pass=$rows['customer_pass'];
     echo '
     <tr>
      <th scope="row">'.$id.'</th>
      <td>'.$name.'</td>
      <td>'.$cnic.'</td>
      <td>'.$address.'</td>
      <td>'.$email.'</td>
       <td>'.$pass.'</td>
  <td><button class="btn btn-danger"><a href="userdelete.php?deleteid='.$id.'" class="text-light" style="text-decoration:none;">delete</a></button>
         <button class="btn btn-primary"><a href="userupdate.php?updateid='.$id.'" class="text-light"style="text-decoration:none;" >update</a></button></td>    

    </tr>
     ';

    }
}
        ?>

       

       
    </tbody>

</table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</body>
</html>