<?php
    session_start();
    if (!isset($_SESSION['account_id'])) {
        header('Location: login/index.php');
        exit();
    } 
    else{
        if($_SESSION['type'] == 'Administrator')
            header('Location: index-admin.php');
        else
            header('Location: index-client.php');
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

    <title>SST Admin</title>

    <!-- Custom fonts for this template-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/93c363693e.js" crossorigin="anonymous"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <?php include('_navbar.php')?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <section>
                    <div class="row">
                        <!-- this is the first column -->
                        <div class="col-md-9">
                            <div class="row mb-5">
                                <?php include('_forms-mostused.php')?>
                            </div>
                            <h3>Most Used Forms</h3>

                            <hr class="mb-5">

                            <div class="row">
                                <?php include('_forms-latest.php')?>
                            </div>
                            <h3>Latest Forms</h3>
                        </div>
                        <!-- this is the 2nd column -->
                        <div class="col-md-3">
                            <div class="row mb-5">
                                <?php include('_categorylist.php')?>
                            </div>
                            <div class="row">
                                <?php include('_forms-neednew.php')?>
                            </div>
                        </div>
                    </div>
                    </section>
                </div>
                <!-- End of page content -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <!-- <?php include('_footer.html')?> -->
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

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/greed/datatables-greed.js"></script>

</body>

</html>