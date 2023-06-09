<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center my-5" href="index.php">
        <div class="sidebar-brand-text my-5">
            <img src="img/SchoolSource01.png" alt="" width="100%">
            <div class="mt-3 sidebar-brand-icon">SST Client</div>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="index-client.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="forms-library-client.php">
            <i class="fas fa-file-alt"></i>
            <span>Form Library</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-inbox"></i>
            <span>Requests</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">District Requests</h6>
                <a class="collapse-item" href="forms-request-client.php">Pending</a>
                <a class="collapse-item" href="forms-request-client-completed.php">Completed </a>
                <a class="collapse-item" href="forms-request-client-reported.php">Reported </a>
                <a class="collapse-item" href="forms-request-client-canceled.php">Canceled </a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading -->
    <!-- <div class="sidebar-heading">
        Interface
    </div> -->
    <li class="nav-item  ">
        <a class="nav-link" href="actions.php?logout=1">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <!-- <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
        <p class="text-center mb-2"><strong></strong></p>
    </div> -->

</ul>