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
        <a class="nav-link" href="dashboard.php">
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
                <a class="collapse-item" href="new-courier.php">New Courier</a>
                <a class="collapse-item" href="view-couriers.php">View All Couriers</a>
                <a class="collapse-item" href="update-courier.php">Update/Delete Courier</a>
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
                <a class="collapse-item" href="send-sms.php">Send SMS From/To</a>
                <a class="collapse-item" href="send-delivery-sms.php">Send Delivery SMS</a>
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
                <a class="collapse-item" href="create-agent.php">Create Agent</a>
                <a class="collapse-item" href="manage-agents.php">Manage Agents</a>
                <a class="collapse-item" href="manage-customers.php">Manage Customers</a>
            </div>
        </div>
    </li>

    <!-- Status -->
    <li class="nav-item">
        <a class="nav-link" href="status-count.php">
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
                <a class="collapse-item" href="download-report.php">Download Report</a>
            </div>
        </div>
    </li>

    <!-- Logout -->
    <li class="nav-item">
        <a class="nav-link" href="logout.php">
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
