<?php

include 'connection.php';
$id = $_GET['updateid'];
if (isset($_POST['update'])) {

    $username = $_POST['name'];
    $cnic = $_POST['cnic'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $pass = $_POST['password'];



    $query = "UPDATE `customer_reg` SET `customer_name`='$username',`customer_cnic`=' $cnic',`customer_address`='$address',`customer_email`=' $email',`customer_pass`=' $pass' where customer_id=$id";

    $run = mysqli_query($conn, $query);

    if ($run) {
header('location:users.php') ;   
} 
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <main class="login w-50  mx-auto" style="height: 90vh; margin-top:200px;">
        <form action="" method="post">
            <h1 class="h3 mt-5 fw-normal text-center">User Registeration</h1>
            <div class="form-floating">
                <input type="text" name="name" class="form-control" id="floatinginput" placeholder="username">
                <label for="floatinginput">User Name</label>
            </div>
            <br>
            <div class="form-floating">
                <input type="text" name="cnic" class="form-control" id="floatinginput"
                    placeholder="cnicno">
                <label for="floatinginput">Cnic_no</label>
            </div>
            <br>
            <div class="form-floating">
                <input type="text" name="address" class="form-control" id="floatinginput"
                    placeholder=" Address ">
                <label for="floatinginput"> Address</label>
            </div>
            <br>
            <div class="form-floating">
                <input type="email" name="email" class="form-control" id="floatinginput" placeholder="name.example.com">
                <label for="floatinginput">Email</label>
            </div>
            <br>
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingpassword"
                    placeholder="Password">
                <label for="floatingpassword">Password</label>
            </div>
            <br>

            <br>
            <button name="update" class="w-100 btn btn-lg btn-primary" type="submit">Update</button>
        </form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>