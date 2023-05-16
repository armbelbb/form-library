<?php
    session_start();
    include("db_connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SST Client Pending Requests</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="vendor/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include('_sidebar-client.html')?>
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

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">SST Forms</h1>
                    <p class="mb-4"></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                List of Pending Requests
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <td>Form Name</td>
                                            <td>Form Reference ID</td>
                                            <td>Status</td>
                                            <td>Date Requested</td>
                                            <td>Date Last Updated</td>
                                            <td class="text-center">Actions</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql = "SELECT A.*, B.* 
                                                    FROM form_requests as A 
                                                    LEFT JOIN forms as B ON B.id = A.form_id 
                                                    WHERE A.account_id = $_SESSION[account_id]";
                                            $requests = $conn->query($sql);
                                            foreach($requests as $request){
                                                echo "<tr>";
                                                    echo "<td>";
                                                        echo " <div class='form-check'>";
                                                            echo "<input class='form-check-input' type='checkbox' value='' id='form1Checkbox$request[id]'>";
                                                            echo "<label class='form-check-label' for='form1Checkbox'>";
                                                                echo "$request[form_name]";
                                                            echo "</label>";
                                                        echo " </div>";
                                                    echo "</td>";
                                                    echo "<td>$request[reference_id]</td>";
                                                    echo "<td>$request[status]</td>";
                                                    echo "<td>" . date('F d, Y  g:i:A', strtotime($request['request_date'])) . "</td>";
                                                    echo "<td>" . date('F d, Y  g:i:A', strtotime($request['last_update_date'])) . "</td>";
                                                    echo "<td>";
                                                        echo "<button class='btn btn-outline-primary'>VIEW</button>";
                                                        echo "<a class='btn btn-danger' data-toggle='modal' data-target='#reportModal'>";
                                                            echo "<i class='fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400'></i>";
                                                            echo "CANCEL REQUEST";
                                                        echo "</a>";
                                                    echo "</td>";
                                                echo "</tr>";
                                            }
                                        ?>
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
    <button type="button" class="swalSuccess" id="swalSuccess">HIDDEN BTN</button>

    <!-- Logout Modal-->
    <?php include('_modal-logout.html')?>
    <!-- Report /  Concern Modal -->
    <?php include('_modal-reportConcern.html')?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/greed/datatables-greed.js"></script>
    <!-- SweetAlert2 -->
    <script src="vendor/sweetalert2/sweetalert2.min.js"></script>
    <script>
        $(function() {
            var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
            });
            $('.swalSuccess').click(function() {
                Toast.fire({
                    icon: 'success',
                    title: 'Form successfully requested.'
                })
            });
        });

        $(document).ready(function(){
            <?php
                if(isset($_GET['success']))
                    echo '$("#swalSuccess").trigger("click");';
            ?>
        });
    </script>
</body>

</html>