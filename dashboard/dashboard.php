<?php
session_start();
if(!$_SESSION['email']){
header('Location: ../adminlogin.php');
}
include('../connection.php');
$branches = "SELECT * FROM `branches`";
$branchdata = mysqli_query($conn, $branches);


if (isset($_POST['agentreg'])) {
    // Retrieve and sanitize form data
    $agent_name = $_POST['agent_name'];
    $agent_email = $_POST['agent_email'];
    $agent_pass = $_POST['agent_pass'];
    $branch_id = $_POST['branch_id'];

    // Optional: Encrypt the password
    $hashed_password = password_hash($agent_pass, PASSWORD_DEFAULT);

    // Insert data into the database
    $sql = "INSERT INTO agent_reg (agent_name, agent_email, agent_pass, branch_id) VALUES ('$agent_name', '$agent_email', '$hashed_password', '$branch_id')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
        alert('Agent Registered Successfulyy!!')
    </script>";
    } else {
        echo "<script>
        alert('Agent registeration failed!!')
    </script>";
    }
}

$agents_sql = "SELECT * FROM agent_reg";
$agents_result = mysqli_query($conn, $agents_sql);


$customers_sql = "SELECT * FROM customer_reg";
$customers_result = mysqli_query($conn, $customers_sql);

$query = "SELECT * FROM `courier`";
$courier_data = mysqli_query($conn, $query);

if (isset($_POST['add_courier'])) {
    // Retrieve and sanitize form data
    $sender_cnic = $_POST['sender_cnic'];
    $receiver_cnic = $_POST['receiver_cnic'];
    $delivery_date = $_POST['delivery_date'];
    $status = $_POST['status'];
    $agent_id = $_POST['agent_id'];
    $branch_id = $_POST['branch_id'];


    // Insert data into the database
    $sql = "INSERT INTO `courier`(`sender_cnic`, `receiver_cnic`, `delivery_date`, `status`, `agent_id`, `branch_id`) VALUES ('$sender_cnic','$receiver_cnic','$delivery_date','$status','$agent_id','$branch_id')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
        alert('Courier added Successfulyy!!')
    </script>";
    } else {
        echo "<script>
        alert('Courier failed!!')
    </script>";
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
        .form-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .agent-table {
            background-color: #ffffff;
            padding: 20px 0px 10px 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .courier-form {
            background-color: #ffffff;
            padding: 20px 0px 10px 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .courier-table {
            background-color: #ffffff;
            padding: 20px 0px 10px 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
        }

        .customer-table {
            background-color: #ffffff;
            padding: 20px 0px 10px 20px;
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

        .form-group input,
        .form-group select {
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

        .action-buttons {
            text-align: center;
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

            <!-- Couriers -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCouriers" aria-expanded="true" aria-controls="collapseCouriers">
                    <i class="fas fa-fw fa-truck"></i>
                    <span>Couriers</span>
                </a>
                <div id="collapseCouriers" class="collapse" aria-labelledby="headingCouriers" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="#" onclick="showSection('new-courier')">New Courier</a>
                        <a class="collapse-item" href="#" onclick="showSection('view-couriers')">View All Couriers</a>
                    </div>
                </div>
            </li>

            <!-- SMS -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSMS" aria-expanded="true" aria-controls="collapseSMS">
                    <i class="fas fa-fw fa-sms"></i>
                    <span>SMS</span>
                </a>
                <div id="collapseSMS" class="collapse" aria-labelledby="headingSMS" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="#" onclick="showSection('send-sms')">Send SMS From/To</a>
                        <a class="collapse-item" href="#" onclick="showSection('send-delivery-sms')">Send Delivery SMS</a>
                    </div>
                </div>
            </li>

            <!-- Management -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseManagement" aria-expanded="true" aria-controls="collapseManagement">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Management</span>
                </a>
                <div id="collapseManagement" class="collapse" aria-labelledby="headingManagement" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="#" onclick="showSection('create-agent')">Create Agent</a>
                        <a class="collapse-item" href="#" onclick="showSection('manage-agents')">Manage Agents</a>
                        <a class="collapse-item" href="#" onclick="showSection('manage-customers')">Manage Customers</a>
                    </div>
                </div>
            </li>

            <!-- Status -->
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="showSection('status-count')">
                    <i class="fas fa-fw fa-chart-bar"></i>
                    <span>Status Count</span>
                </a>
            </li>

            <!-- Reports -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReports" aria-expanded="true" aria-controls="collapseReports">
                    <i class="fas fa-fw fa-file"></i>
                    <span>Reports</span>
                </a>
                <div id="collapseReports" class="collapse" aria-labelledby="headingReports" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="#" onclick="showSection('download-report')">Download Report</a>
                    </div>
                </div>
            </li>

            <!-- Logout -->
            <li class="nav-item">
                <a class="nav-link" href="../adminlogin.php">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

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
                        <p>Welcome to the Admin Dashboard. Here you can manage various aspects of the system.</p>
                    </div>

                    <div id="new-courier" class="content-section" style="display: none;">
                        <div class="courier-form" style="padding-right:20px;">
                            <h2 class="h3 mb-4 text-gray-800">Add Courier</h2>
                            <form method="post">
                                <div>
                                    <input type="text" class="form-control" id="sender_cnic" name="sender_cnic" placeholder="Sender CNIC" required>
                                </div><br>
                                <div>
                                    <input type="text" class="form-control" id="receiver_cnic" name="receiver_cnic" placeholder="Receiver CNIC" required>
                                </div><br>
                                <div>
                                    <input type="date" class="form-control" id="delivery_date" name="delivery_date" placeholder="Delivery Date" required>
                                </div><br>
                                <div>
                                    <select id="status" class="form-control" name="status" required>
                                        <option value="">Select Status</option>
                                        <option value="Pending">Pending</option>
                                        <option value="In Transit">In Transit</option>
                                        <option value="Delivered">Delivered</option>
                                        <option value="Cancelled">Cancelled</option>
                                    </select>
                                </div><br>
                                <div>
                                    <select id="agent_id" class="form-control" name="agent_id" required>
                                        <option value="">Select Agent</option>
                                        <?php while ($agent = mysqli_fetch_assoc($agents_result)) { ?>
                                            <option value="<?php echo $agent['agent_id']; ?>"><?php echo $agent['agent_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div><br>
                                <div>
                                    <select id="branch" class="form-control" name="branch_id" required>
                                        <option value="">Select Branch</option>
                                        <?php while ($branch = mysqli_fetch_assoc($branchdata)) { ?>
                                            <option value="<?php echo $branch['branch_id']; ?>"><?php echo $branch['branch_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <br>
                                <button type="submit" name="add_courier" value="courieradd">Add Courier</button>
                            </form>
                        </div>
                    </div>

                    <div id="view-couriers" class="content-section" style="display: none;">
                        <div class="courier-table">
                            <h2 h3 mb-4 text-gray-800>Courier List</h2>
                            <table style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Courier ID</th>
                                        <th>Sender CNIC</th>
                                        <th>Receiver CNIC</th>
                                        <th>Delivery Date</th>
                                        <th>Status</th>
                                        <th>Agent ID</th>
                                        <th>Branch ID</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($courier_data)) { ?>
                                        <tr>
                                            <td><?php echo $row['courier_id']; ?></td>
                                            <td><?php echo $row['sender_cnic']; ?></td>
                                            <td><?php echo $row['receiver_cnic']; ?></td>
                                            <td><?php echo $row['delivery_date']; ?></td>
                                            <td><?php echo $row['status']; ?></td>
                                            <td><?php echo $row['agent_id']; ?></td>
                                            <td><?php echo $row['branch_id']; ?></td>
                                            <td>
                                                <a href="edit_courier.php?id=<?php echo $row['courier_id']; ?>">Edit</a>
                                                <a href="delete_courier.php?id=<?php echo $row['courier_id']; ?>">Delete</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div id="send-sms" class="content-section" style="display: none;">
                        <h1 class="h3 mb-4 text-gray-800">Send SMS</h1>
                        <p>Send SMS to customers and agents.</p>
                    </div>

                    <div id="send-delivery-sms" class="content-section" style="display: none;">
                        <h1 class="h3 mb-4 text-gray-800">Send Delivery SMS</h1>
                        <p>Send delivery confirmation SMS.</p>
                    </div>

                    <div id="create-agent" class="content-section" style="display: none;">
                        <div class="form-container">
                            <h2 class="h3 mb-4 text-gray-800">Agent Registration</h2>
                            <form method="post">
                                <div class="form-group">
                                    <label for="agent_name">Agent Name:</label>
                                    <input type="text" id="agent_name" name="agent_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="agent_email">Agent Email:</label>
                                    <input type="email" id="agent_email" name="agent_email" required>
                                </div>
                                <div class="form-group">
                                    <label for="agent_pass">Password:</label>
                                    <input type="password" id="agent_pass" name="agent_pass" required>
                                </div>
                                <div>
                                    <label for="">Branch</label>
                                    <select id="branch" class="form-control" name="branch_id" required>
                                        <option value="">Select Branch</option>
                                        <?php
                                        $branches = "SELECT * FROM `branches`";
                                        $branchdata = mysqli_query($conn, $branches);
                                        while ($branch = mysqli_fetch_assoc($branchdata)) { ?>
                                            <option value="<?php echo $branch['branch_id']; ?>"><?php echo $branch['branch_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <br>
                                <button type="submit" name="agentreg" value="agentdata">Register</button>
                            </form>
                        </div>
                    </div>

                    <div id="manage-agents" class="content-section" style="display: none;">
                        <div class="agent-table">
                            <h2 class="h3 mb-4 text-gray-800">Manage Agents</h2>
                            <table style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Agent ID</th>
                                        <th>Agent Name</th>
                                        <th>Agent Email</th>
                                        <th>Branch ID</th>
                                        <th style="text-align: center;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $agents_sql = "SELECT * FROM agent_reg";
                                    $agents_result = mysqli_query($conn, $agents_sql);
                                    while ($agent = mysqli_fetch_assoc($agents_result)) { ?>
                                        <tr>
                                            <td><?php echo $agent['agent_id']; ?></td>
                                            <td><?php echo $agent['agent_name']; ?></td>
                                            <td><?php echo $agent['agent_email']; ?></td>
                                            <td><?php echo $agent['branch_id']; ?></td>
                                            <td class="action-buttons">
                                                <a href="manage_agents.php?edit_id=<?php echo $agent['agent_id']; ?>" class="btn btn-warning">Update</a>
                                                <a href="manage_agents.php?delete_id=<?php echo $agent['agent_id']; ?>" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div id="manage-customers" class="content-section" style="display: none;">
                        <div class="customer-table">
                            <h2 class="h3 mb-4 text-gray-800">Manage Customers</h2>
                            <table style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Customer ID</th>
                                        <th>Customer Name</th>
                                        <th>Customer Number</th>
                                        <th>Customer Address</th>
                                        <th>Customer Email</th>
                                        <th style="text-align: center;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($customer = mysqli_fetch_assoc($customers_result)) { ?>
                                        <tr>
                                            <td><?php echo $customer['customer_id']; ?></td>
                                            <td><?php echo $customer['customer_name']; ?></td>
                                            <td><?php echo $customer['customer_cnic']; ?></td>
                                            <td><?php echo $customer['customer_address']; ?></td>
                                            <td><?php echo $customer['customer_email']; ?></td>
                                            <td class="action-buttons">
                                                <a href="manage_customers.php?edit_id=<?php echo $customer['customer_id']; ?>" class="btn btn-warning">Update</a>
                                                <a href="manage_customers.php?delete_id=<?php echo $customer['customer_id']; ?>" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <!-- End of Content Wrapper -->

            </div>
        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <?php include_once('includes/footer2.php'); ?>

        <!-- JavaScript -->
        <!-- jQuery -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript -->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- Custom scripts for all pages -->
        <script src="js/sb-admin-2.min.js"></script>

        <!-- ShowSection Script -->
        <script>
            function showSection(sectionId) {
                var sections = document.querySelectorAll('.content-section');
                sections.forEach(function(section) {
                    section.style.display = 'none';
                });

                var selectedSection = document.getElementById(sectionId);
                if (selectedSection) {
                    selectedSection.style.display = 'block';
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                showSection('dashboard');
            });
        </script>
    </div>
    </div>
</body>

</html>