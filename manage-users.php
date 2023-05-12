<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SST Admin Form Library</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include('_sidebar.html')?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include('_navbar.html')?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <!-- <h1 class="h3 mb-2 text-gray-800">SST Forms</h1> -->
                    <!-- <p class="mb-4"></p> -->

                    <!-- DataTables Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <!-- <button class="btn btn-outline-primary" onclick="window.open('_addNewForm.html', 'popup', 'width=1200,height='+screen.availHeight); return false;">Add New Form</button> -->
                                Manage District
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <td>DISTRICT NAME</td>
                                            <td>EMAIL</td>
                                            <td>CONTACT</td>
                                            <td>STATUS</td>
                                            <td class="text-center">ACTIONS</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <!-- Ikaw na bahala maglaag didi men sin loop sa db -->
                                            <td class="align-middle">SAMPLE DISTRICT</td>
                                            <td class="align-middle">mail@yourmail.com</td>
                                            <td class="align-middle">+1234567890</td>
                                            <td class="align-middle">Active</td>
                                            <td class="text-right align-middle">
                                                <button class="btn btn-outline-primary">Activate</button>
                                                
                                                <button class="btn btn-outline-info" onclick="openPopup()">Modify</button>
                                                <script>
                                                    function openPopup() {
                                                        var width = 1200;
                                                        var height = 400;
                                                        var left = (screen.width / 2) - (width / 2);
                                                        var top = (screen.height / 2) - (height / 2);
                                                        var features = 'width=' + width + ',height=' + height + ',left=' + left + ',top=' + top;
                                                        window.open('_modifyUsers.html', 'popup', features);
                                                    }
                                                </script>

                                                <button class="btn btn-outline-success">Reset Password</button>
                                                <button class="btn btn-outline-danger">Deactivate
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include('_footer.html')?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php include('_modal-logout.html')?>


    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/greed/datatables-greed.js"></script>

</body>

</html>