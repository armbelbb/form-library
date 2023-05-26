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

    <title>SST Admin Canceled Requests</title>

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
        <?php include('_sidebar.php')?>
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
                    <!-- DataTables Example for Pending Requests  -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                Canceled Requests
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <td>Form Name</td>
                                            <td>Form Reference ID</td>
                                            <td>Requesting District</td>
                                            <td>Date Requested</td>
                                            <td class="text-center">Actions</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql = "SELECT A.id as form_request_id, A.*, B.*, C.* 
                                                    FROM form_requests as A 
                                                    LEFT JOIN forms as B ON B.id = A.form_id 
                                                    LEFT JOIN accounts as C ON C.id = A.account_id 
                                                    WHERE A.status = 'Canceled'";
                                            $requests = $conn->query($sql);
                                            foreach($requests as $request){
                                                echo "<tr>";
                                                    if($request['form_id'] == -1)
                                                        echo "<td>NEW FORM REQUEST</td>";
                                                    else
                                                        echo "<td>$request[form_name]</td>";
                                                    if($request['form_id'] == -1)
                                                        echo "<td>N/A</td>";
                                                    else
                                                        echo "<td>$request[reference_id]</td>";
                                                    echo "<td>$request[display_name]</td>";
                                                    echo "<td>" . date('F d, Y  g:i:A', strtotime($request['request_date'])) . "</td>";
                                                    echo "<td>";
                                                        echo "<button class='btn btn-outline-primary' onclick='$(\"#viewRequestModal$request[form_request_id]\").modal(\"toggle\")'>VIEW</button>&nbsp";
                                                    echo "</td>";
                                                echo "</tr>";
                                                echo "
                                                    <div class='modal fade' id='viewRequestModal$request[form_request_id]'>
                                                        <div class='modal-dialog modal-lg'>
                                                            <div class='modal-content'>
                                                                <div class='modal-header'>
                                                                    <h4 class='modal-title font-weight-bold text-dark' id='modalTitle'>FORM REQUEST</h4>
                                                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                                    <span aria-hidden='true'>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class='modal-body'>
                                                                    <div class='row'>
                                                                        <div class='form-group col-12'>";
                                                                            if($request['form_id'] == -1)
                                                                                echo "<label class='font-weight-bold text-dark'>FORM NAME<ast class='text-danger'></ast>: NEW FORM REQUEST</label>";
                                                                            else
                                                                                echo "<label class='font-weight-bold text-dark'>FORM NAME<ast class='text-danger'></ast>: $request[form_name]</label>";
                                                                        echo "</div>
                                                                        <div class='form-group col-12'>
                                                                            <label class='font-weight-bold text-dark'>EMAIL<ast class='text-danger'></ast>: $request[requestor_email]</label>
                                                                        </div>
                                                                        <div class='form-group col-12'>
                                                                            <label class='font-weight-bold text-dark'>NAME<ast class='text-danger'></ast>: $request[requestor_name]</label>
                                                                        </div>
                                                                        <div class='form-group col-12'>
                                                                            <label class='font-weight-bold text-dark'>PHONE NUMBER<ast class='text-danger'></ast>: $request[phone_number]</label>
                                                                        </div>
                                                                        <div class='form-group col-12'>
                                                                            <label class='font-weight-bold text-dark'>NOTES:</label>
                                                                            <textarea class='form-control' rows='3' name='form_description' readonly>$request[request_notes]</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class='modal-footer'>
                                                                    <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                ";
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

    <!-- Logout Modal-->
    <?php include('_modal-logout.html')?>
    <!-- Report /  Concern Modal -->
    <?php include('_modal-reportConcernAdmin.php')?>

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