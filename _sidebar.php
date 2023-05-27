<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center my-5" href="index.php">
        <div class="sidebar-brand-text my-5">
            <img src="img/SchoolSource01.png" alt="" width="100%">
            <div class="mt-3 sidebar-brand-icon">SST Admin</div>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item colorchange">
        <a class="nav-link" href="index-admin.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#formLibrary"
            aria-expanded="true" aria-controls="formLibrary">
            <i class="fas fa-file-alt"></i>
            <span>Form Library</span>
        </a>
        <div id="formLibrary" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="forms-library.php">Form Lists</a>
                <a class="collapse-item" href="forms-archived.php">Archive </a>
            </div>
        </div>
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
                <a class="collapse-item" href="forms-request.php">Pending</a>
                <a class="collapse-item" href="forms-request-completed.php">Completed </a>
                <a class="collapse-item" href="forms-request-reported.php">Reported </a>
                <a class="collapse-item" href="forms-request-canceled.php">Canceled </a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="manage-users.php">
            <i class="fas fa-users"></i>
            <span>Manage Users</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="actions.php?logout=1">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

<!-- <style>
    .nav-item.active a {
        color: red; /* Change the color to your desired active color */
    }
</style> -->

<script>
    // JavaScript to handle active state of the button
    document.addEventListener('DOMContentLoaded', function() {
        var navItems = document.querySelectorAll('.nav-item');
        navItems.forEach(function(navItem) {
            navItem.addEventListener('click', function(event) {
                var activeItem = document.querySelector('.nav-item.active');
                if (activeItem) {
                    activeItem.classList.remove('active');
                }
                this.classList.add('active');
            });
        });

        // Add "active" class to the specific li element
        var specificNavItem = document.querySelector('.nav-item.colorchange');
        specificNavItem.classList.add('active');
    });
</script>