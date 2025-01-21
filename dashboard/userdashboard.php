<?php
include('../connection.php');
session_start();

if(!$_SESSION['customerid']){
header('Location: ../userlogin.php');
}

$sendercnic = $_SESSION['sendercnic'];
$customerid = $_SESSION['customerid'];

// Fetch all couriers for the customer
$couriers = "SELECT `courier_id`, `sender_cnic`, `receiver_cnic`, `delivery_date`, `status`, `agent_id`, `branch_id` FROM `courier` WHERE sender_cnic='$sendercnic'";
$result = mysqli_query($conn, $couriers);

// Handle the form submission for tracking
if (isset($_POST['track'])) {
    $trackno = $_POST['tracking_number'];
    $sql = "SELECT * FROM courier WHERE courier_id = '$trackno'";
    $trackResult = mysqli_query($conn, $sql);
    if ($trackResult && mysqli_num_rows($trackResult) > 0) {
        $trackrow = mysqli_fetch_array($trackResult);
        echo json_encode([
            'status' => 'success',
            'data' => $trackrow
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'No shipment found with the given tracking number.'
        ]);
    }
    exit;
}

$customerquery = "SELECT * FROM `customer_reg` WHERE customer_id = '$customerid'";
$customerresult = mysqli_query($conn, $customerquery);
$customerdata = mysqli_fetch_array($customerresult);

if (isset($_REQUEST['updatecustomer'])) {
    $id = $_POST['id'];
    $username = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $query = "UPDATE `customer_reg` SET `customer_name`='$username',`customer_address`='$address',`customer_email`='$email',`customer_pass`='$pass' WHERE customer_id='$id'";
    $run = mysqli_query($conn, $query);
    if ($run) {
        echo "<script>
            alert('Your record is updated successfully!!');
        </script>";
        header('Location:userdashboard.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css' media='all' />
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .form-container, .courier-table, .customer-table {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
        }
        h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }
        button {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .action-buttons a.btn {
            border-radius: 4px;
            color: #ffffff;
            text-decoration: none;
        }
        .action-buttons a.btn-warning {
            background-color: #ffc107;
        }
        .action-buttons a.btn-warning:hover {
            background-color: #e0a800;
        }
        .action-buttons a.btn-danger {
            background-color: #dc3545;
        }
        .action-buttons a.btn-danger:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-virus"></i>
                </div>
                <div class="sidebar-brand-text mx-3">CMS</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="showSection('dashboard')">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Shipment Tracking -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTracking" aria-expanded="true" aria-controls="collapseTracking">
                    <i class="fas fa-fw fa-truck"></i>
                    <span>Shipment Tracking</span>
                </a>
                <div id="collapseTracking" class="collapse" aria-labelledby="headingTracking" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="#" onclick="showSection('track-shipment')">Track Shipment</a>
                        <a class="collapse-item" href="#" onclick="showSection('shipment-status')">Shipment Status</a>
                    </div>
                </div>
            </li>

            <!-- Print -->
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="showSection('print-tracking-details')">
                    <i class="fas fa-fw fa-print"></i>
                    <span>Print Tracking Details</span>
                </a>
            </li>

            <!-- Logout -->
            <li class="nav-item">
                <a class="nav-link" href="userlogout.php">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <?php include_once('includes/topbar.php'); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Sections -->
                    <div id="dashboard" class="content-section">
                        <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
                        <p>Welcome to the User Dashboard. Manage shipments, track status, and more.</p>
                    </div>

                    <div id="track-shipment" class="content-section" style="display:none;">
                        <div class="form-container" id="track-form">
                            <h2 class="h3 mb-4 text-gray-800">Track Shipment</h2>
                            <form id="trackingForm" method="post">
                                <div class="form-group">
                                    <label for="tracking_number">Tracking Number:</label>
                                    <input type="text" id="tracking_number" name="tracking_number" required>
                                </div>
                                <input type="submit" value="Track" name="track">
                            </form>
                        </div>

                        <div id="track-status" style="display: none;">
                            <div class="courier-table">
                                <h2 class="h3 mb-4 text-gray-800">Shipment Status</h2>
                                <table style="width: 100%;" id="track-result-table">
                                    <thead>
                                        <tr>
                                            <th>Courier ID</th>
                                            <th>Sender CNIC</th>
                                            <th>Receiver CNIC</th>
                                            <th>Delivery Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="track-result-body">
                                        <!-- Results will be appended here by JavaScript -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="shipment-status" class="content-section" style="display:none;">
                        <div class="courier-table">
                            <h2 class="h3 mb-4 text-gray-800">All Shipments</h2>
                            <table style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Courier ID</th>
                                        <th>Sender CNIC</th>
                                        <th>Receiver CNIC</th>
                                        <th>Delivery Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result && mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>{$row['courier_id']}</td>";
                                            echo "<td>{$row['sender_cnic']}</td>";
                                            echo "<td>{$row['receiver_cnic']}</td>";
                                            echo "<td>{$row['delivery_date']}</td>";
                                            echo "<td>{$row['status']}</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='5'>No shipments found.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div id="print-tracking-details" class="content-section" style="display:none;">
                        <div class="form-container">
                            <h2 class="h3 mb-4 text-gray-800">Print Tracking Details</h2>
                            <div class="courier-table">
                                <h2 class="h3 mb-4 text-gray-800">Courier Details</h2>
                                <table style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Courier ID</th>
                                            <th>Sender CNIC</th>
                                            <th>Receiver CNIC</th>
                                            <th>Delivery Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Re-fetch all couriers for printing
                                        $printResult = mysqli_query($conn, $couriers);
                                        if ($printResult && mysqli_num_rows($printResult) > 0) {
                                            while ($row = mysqli_fetch_assoc($printResult)) {
                                                echo "<tr>";
                                                echo "<td>{$row['courier_id']}</td>";
                                                echo "<td>{$row['sender_cnic']}</td>";
                                                echo "<td>{$row['receiver_cnic']}</td>";
                                                echo "<td>{$row['delivery_date']}</td>";
                                                echo "<td>{$row['status']}</td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='5'>No couriers found for printing.</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <button style="margin-top: 15px;" onclick="printDiv('print-tracking-details')">Print</button>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script>
        function showSection(sectionId) {
            $('.content-section').hide();
            $('#' + sectionId).show();
        }

        // Handle form submission for tracking
        $('#trackingForm').on('submit', function(e) {
            e.preventDefault();
            const trackingNumber = $('#tracking_number').val();

            $.ajax({
                url: '',
                type: 'POST',
                data: {
                    track: true,
                    tracking_number: trackingNumber
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        const result = response.data;
                        const html = `
                            <tr>
                                <td>${result.courier_id}</td>
                                <td>${result.sender_cnic}</td>
                                <td>${result.receiver_cnic}</td>
                                <td>${result.delivery_date}</td>
                                <td>${result.status}</td>
                            </tr>`;
                        $('#track-result-body').html(html);
                        $('#track-status').show();
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert('An error occurred while fetching the tracking information.');
                }
            });
        });

        // Function to print a specific div
        function printDiv(divId) {
            var divToPrint = document.getElementById(divId);
            var newWin = window.open('', 'Print-Window');
            newWin.document.open();
            newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');
            newWin.document.close();
            setTimeout(function() {
                newWin.close();
            }, 10);
        }
    </script>
</body>
</html>
