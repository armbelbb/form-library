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

    <title>SST Admin Archive</title>

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
                                Archived Forms
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <td>Form Name</td>
                                            <td>Form Reference ID</td>
                                            <td class="text-center">Actions</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql = "SELECT A.*, B.category_name 
                                                    FROM forms as A 
                                                    LEFT JOIN categories as B ON B.id = A.category_id 
                                                    WHERE A.status = 'Archived'";
                                            $forms = $conn->query($sql);
                                            foreach($forms as $form){
                                                $workflow = $form['workflow'] == "" ? "img/no_workflow.png" : "uploads/$form[workflow]";
                                                $attachment = $form['attachment'] == "" ? "N/A" : "$form[attachment]";
                                                echo "<tr>";
                                                    echo "<td class='align-middle'>$form[form_name]</td>";
                                                    echo "<td class='align-middle'>$form[reference_id]</td>";
                                                    echo "<td class='text-right'>";
                                                        echo "<button class='btn btn-primary' onclick='$(\"#viewFormModal$form[id]\").modal(\"toggle\")'>View Form</button>&nbsp";
                                                        echo "<button class='btn btn-danger' onclick='$(\"#archiveFormModal$form[id]\").modal(\"toggle\")'>Unarchive Form</button>";
                                                    echo "</td>";
                                                echo "</tr>";
                                                echo "
                                                    <div class='modal fade' id='viewFormModal$form[id]'>
                                                        <div class='modal-dialog modal-lg'>
                                                            <div class='modal-content'>
                                                                <div class='modal-header'>
                                                                    <h4 class='modal-title font-weight-bold text-dark' id='modalTitle'>$form[form_name] FORM</h4>
                                                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                                    <span aria-hidden='true'>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class='modal-body'>
                                                                    <div class='row'>
                                                                        <div class='form-group col-12'>
                                                                            <label class='font-weight-bold text-dark'>FORM REFERENCE ID<ast class='text-danger'></ast>: $form[reference_id]</label>
                                                                        </div>
                                                                        <div class='form-group col-12'>
                                                                            <label class='font-weight-bold text-dark'>FORM INDEX<ast class='text-danger'></ast>: $form[form_index]</label>
                                                                        </div>
                                                                        <div class='form-group col-12'>
                                                                            <label class='font-weight-bold text-dark'>FORM CATEGORY<ast class='text-danger'></ast>: $form[category_name]</label>
                                                                        </div>
                                                                        <div class='form-group col-12'>
                                                                            <label class='font-weight-bold text-dark'>DESCRIPTION:</label>
                                                                            <textarea class='form-control' rows='3' name='form_description' readonly>$form[form_description]</textarea>
                                                                        </div>
                                                                        <div class='form-group col-12'>
                                                                            <label class='font-weight-bold text-dark'>ATTACHMENT<ast class='text-danger'></ast>: <a href='uploads/$form[attachment]' target='_blank'>$attachment</a></label>
                                                                        </div>
                                                                        <div class='form-group col-12'>
                                                                            <label class='font-weight-bold text-dark'>WORKFLOW<ast class='text-danger'></ast>: $form[category_name]</label>
                                                                            <img src='$workflow' class='img-fluid' alt='IMAGE NOT FOUND'>
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
                                                echo "
                                                    <div class='modal fade' id='archiveFormModal$form[id]'>
                                                        <div class='modal-dialog modal-lg'>
                                                            <div class='modal-content'>
                                                                <div class='modal-header'>
                                                                    <h4 class='modal-title font-weight-bold text-dark' id='modalTitle'>$form[form_name]</h4>
                                                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                                    <span aria-hidden='true'>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class='modal-body'>
                                                                    <h2>Are you sure you want to set this form to active?</h2>
                                                                    <form method='POST' action='actions.php' id='archiveForm$form[id]'>
                                                                        <input type='hidden' name='form_id' value='$form[id]' required>
                                                                        <input type='hidden' name='status' value='Active' required>
                                                                    </form>
                                                                </div>
                                                                <div class='modal-footer'>
                                                                    <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                                                                    <button type='submit' form='archiveForm$form[id]' name='archiveForm' class='btn btn-success'>Confirm</button>
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
    <button type="button" hidden class="swalArchive" id="swalArchive">HIDDEN BTN</button>

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
            $('.swalArchive').click(function() {
                Toast.fire({
                    icon: 'success',
                    title: 'Form successfully moved to archive.'
                })
            });
        });

        $(document).ready(function(){
            <?php
                if(isset($_GET['archived']))
                    echo '$("#swalArchive").trigger("click");';
            ?>
        });
    </script>
</body>

</html>