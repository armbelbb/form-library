<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - Home -->
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-bell"></i>
                &nbsp;Notification
            </a>
            <!-- Notification Dropdown -->
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownNotification">
                <!-- Dropdown header -->
                <h6 class="dropdown-header">Notifications</h6>
                <!-- Dropdown items -->
                <a class="dropdown-item" href="#">Notification 1</a>
                <a class="dropdown-item" href="#">Notification 2</a>
                <a class="dropdown-item" href="#">Notification 3</a>
                <!-- Dropdown footer -->
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">View All Notifications</a>
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Welcome: <?php echo $_SESSION['display_name'];?></span>
                <img class="img-profile rounded-circle"
                    src="img/undraw_profile.svg">
            </a>
        </li>
    </ul>

</nav>
