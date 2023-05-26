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
        <?php include('_sidebar-client.php')?>
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
                                            <td>Date Requested</td>
                                            <td>Date Last Updated</td>
                                            <td class="text-center">Actions</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql = "SELECT A.id as form_request_id,A.*, B.* 
                                                    FROM form_requests as A 
                                                    LEFT JOIN forms as B ON B.id = A.form_id 
                                                    WHERE A.account_id = $_SESSION[account_id] 
                                                    AND A.status = 'Pending'";
                                            $requests = $conn->query($sql);
                                            foreach($requests as $request){
                                                echo "<tr>";
                                                    echo "<td>";
                                                        echo " <div class='form-check'>";
                                                            echo "<input class='form-check-input' type='checkbox' value='' id='form1Checkbox$request[id]'>";
                                                            echo "<label class='form-check-label' for='form1Checkbox'>";
                                                                if($request['form_id'] == -1)
                                                                    echo "NEW FORM REQUEST";
                                                                else
                                                                    echo "$request[form_name]";
                                                            echo "</label>";
                                                        echo " </div>";
                                                    echo "</td>";
                                                    if($request['form_id'] == -1)
                                                        echo "<td>N/A</td>";
                                                    else
                                                    echo "<td>$request[reference_id]</td>";
                                                    echo "<td>" . date('F d, Y  g:i:A', strtotime($request['request_date'])) . "</td>";
                                                    echo "<td>" . date('F d, Y  g:i:A', strtotime($request['last_update_date'])) . "</td>";
                                                    echo "<td>";
                                                        echo "<button class='btn btn-outline-primary' onclick='$(\"#viewRequestModal$request[form_request_id]\").modal(\"toggle\")'>VIEW</button>";
                                                        if($request['status'] == 'Pending'){
                                                            echo "<a class='btn btn-danger' data-toggle='modal' data-target='#reportModal' onclick='$(\"#form_request_id\").val(\"$request[form_request_id]\")'>";
                                                                echo "<i class='fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400'></i>";
                                                                echo "CANCEL REQUEST";
                                                            echo "</a>";
                                                        }
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
    <button type="button" class="swalSuccess" id="swalSuccess">HIDDEN BTN</button>
    <button type="button" class="swalCancel" id="swalCancel">HIDDEN BTN</button>

    <!-- Logout Modal-->
    <?php include('_modal-logout.html')?>
    <!-- Report /  Concern Modal -->
    <?php include('_modal-reportConcern.php')?>

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

        $(function() {
            var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
            });
            $('.swalCancel').click(function() {
                Toast.fire({
                    icon: 'success',
                    title: 'Form Request cancelled.'
                })
            });
        });

        $(document).ready(function(){
            <?php
                if(isset($_GET['success']))
                    echo '$("#swalSuccess").trigger("click");';
                if(isset($_GET['canceled']))
                    echo '$("#swalCancel").trigger("click");';
            ?>
        });
    </script>
</body>

</html>