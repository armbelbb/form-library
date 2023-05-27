<?php
    session_start();
    include("db_connection.php");
    if (!isset($_SESSION['account_id'])) {
        header('Location: login/index.php');
        exit();
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

    <title>SST Admin Form Library Manage Users</title>

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

                    <!-- Page Heading -->
                    <!-- <h1 class="h3 mb-2 text-gray-800">SST Forms</h1> -->
                    <!-- <p class="mb-4"></p> -->

                    <!-- DataTables Example -->
                    <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary" style="display: flex; justify-content: space-between; align-items: center;">
                            <span>Manage District</span>
                            <button class="btn btn-outline-primary" onclick="$('#addNewAccountModal').modal('toggle')">Add Users</button>
                        </h6>
                    </div>
                    <!-- ADD NEW FORM MODAL -->
                    <div class="modal fade" id="addNewAccountModal">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title font-weight-bold text-dark" id="modalTitle">ADD NEW ACCOUNT</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="actions.php" id="addNewAccountForm">
                                        <div class="row">
                                            <div class="form-group col-12">
                                                <label class="font-weight-bold text-dark" for="display_name">DISTRICT NAME<ast class="text-danger">*</ast>:</label>
                                                <input type="text" class="form-control" name="display_name" id="display_name" required>
                                            </div>
                                            <div class="form-group col-6">
                                                <label class="font-weight-bold text-dark" for="email">EMAIL<ast class="text-danger">*</ast>:</label>
                                                <input type="text" class="form-control" name="email" id="email" required>
                                            </div>
                                            <div class="form-group col-6">
                                                <label class="font-weight-bold text-dark" for="password">PASSWORD<ast class="text-danger">*</ast>:</label>
                                                <input type="text" class="form-control" name="password" id="password" required>
                                            </div>
                                            <div class="form-group col-6">
                                                <label class="font-weight-bold text-dark" for="contact_num">CONTACT NUMBER<ast class="text-danger">*</ast>:</label>
                                                <input type="text" class="form-control" name="contact_num" id="contact_num" required>
                                            </div>
                                            <div class="form-group col-6">
                                                <label class="font-weight-bold text-dark" for="type">TYPE<ast class="text-danger">*</ast>:</label>
                                                <select class="form-control" name="type" id="type" required>
                                                    <option value="" selected disabled>Choose an option</option>
                                                    <option value="Administrator">Administrator</option>
                                                    <option value="Client" >District User</option>
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <button type="submit" name="addNewAccount" form="addNewAccountForm" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- UPDATE APPLICATION MODAL -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <td>DISTRICT NAME</td>
                                            <td>EMAIL</td>
                                            <td>CONTACT</td>
                                            <td>STATUS</td>
                                            <td>TYPE</td>
                                            <td class="text-center">ACTIONS</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql = "SELECT * FROM accounts";
                                            $accounts = $conn->query($sql);
                                            foreach($accounts as $account){
                                                echo "<tr>";
                                                    echo "<td class='align-middle'>$account[display_name]</td>";
                                                    echo "<td class='align-middle'>$account[email]</td>";
                                                    echo "<td class='align-middle'>+ $account[contact_num]</td>";
                                                    echo "<td class='align-middle'>$account[status]</td>";
                                                    echo "<td class='align-middle'>$account[type]</td>";
                                                    echo "<td class='text-right align-middle'>";
                                                        echo "<button class='btn btn-info' onclick='$(\"#updateAccountModal$account[id]\").modal(\"toggle\")'>Modify</button>&nbsp";
                                                        echo "<button class='btn btn-warning'>Reset Password</button>&nbsp";
                                                        if($account['status'] == 'Inactive')
                                                            echo "<button class='btn btn-primary' onclick='$(\"#accountStatusModal$account[id]\").modal(\"toggle\")'>Activate</button>";
                                                        else if($account['status'] == 'Active' && $account['id'] != $_SESSION['account_id'])
                                                            echo "<button class='btn btn-danger' onclick='$(\"#accountStatusModal$account[id]\").modal(\"toggle\")'>Deactivate</button>";
                                                    echo "</td>";
                                                echo "</tr>";
                                                if($account['status'] == 'Inactive')
                                                    $newStatus = "Active";
                                                else
                                                    $newStatus = "Inactive";
                                                echo "
                                                    <div class='modal fade' id='updateAccountModal$account[id]'>
                                                        <div class='modal-dialog modal-lg'>
                                                            <div class='modal-content'>
                                                                <div class='modal-header'>
                                                                    <h4 class='modal-title font-weight-bold text-dark' id='modalTitle'>$account[display_name]</h4>
                                                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                                    <span aria-hidden='true'>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class='modal-body'>
                                                                    <form method='POST' action='actions.php' id='updateAccountForm$account[id]'>
                                                                        <div class='row'>
                                                                            <div class='form-group col-12'>
                                                                                <label class='font-weight-bold text-dark' for='display_name2'>DISTRICT NAME<ast class='text-danger'>*</ast>:</label>
                                                                                <input type='text' class='form-control' name='display_name' id='display_name2' value='$account[display_name]' required>
                                                                            </div>
                                                                            <div class='form-group col-6'>
                                                                                <label class='font-weight-bold text-dark' for='email2'>EMAIL<ast class='text-danger'>*</ast>:</label>
                                                                                <input type='text' class='form-control' name='email' id='email2' value='$account[email]' required>
                                                                            </div>
                                                                            <div class='form-group col-6'>
                                                                                <label class='font-weight-bold text-dark' for='contact_num2'>CONTACT NUMBER<ast class='text-danger'>*</ast>:</label>
                                                                                <input type='text' class='form-control' name='contact_num' id='contact_num2' value='$account[contact_num]' required>
                                                                            </div>
                                                                        </div>
                                                                        <input type='hidden' name='account_id' value='$account[id]' required>
                                                                    </form>
                                                                </div>
                                                                <div class='modal-footer'>
                                                                    <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                                                                    <button type='submit' form='updateAccountForm$account[id]' name='updateAccount' class='btn btn-primary'>Confirm</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                ";
                                                echo "
                                                    <div class='modal fade' id='accountStatusModal$account[id]'>
                                                        <div class='modal-dialog modal-lg'>
                                                            <div class='modal-content'>
                                                                <div class='modal-header'>
                                                                    <h4 class='modal-title font-weight-bold text-dark' id='modalTitle'>$account[display_name]</h4>
                                                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                                    <span aria-hidden='true'>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class='modal-body'>
                                                                    <h2>Are you sure you want to set this account to $newStatus?</h2>
                                                                    <form method='POST' action='actions.php' id='accountStatusForm$account[id]'>
                                                                        <input type='hidden' name='account_id' value='$account[id]' required>
                                                                        <input type='hidden' name='status' value='$newStatus' required>
                                                                    </form>
                                                                </div>
                                                                <div class='modal-footer'>
                                                                    <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                                                                    <button type='submit' form='accountStatusForm$account[id]' name='accountStatus' class='btn btn-primary'>Confirm</button>
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
    <button type="button" hidden class="swalSuccess" id="swalSuccess">HIDDEN BTN</button>
    <button type="button" hidden class="swalStatus" id="swalStatus">HIDDEN BTN</button>
    <button type="button" hidden class="swalUpdate" id="swalUpdate">HIDDEN BTN</button>

    <!-- Logout Modal-->
    <?php include('_modal-logout.html')?>


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
                    title: 'New account successfully created.'
                })
            });
            $('.swalStatus').click(function() {
                Toast.fire({
                    icon: 'success',
                    title: 'Account status updated.'
                })
            });
            $('.swalUpdate').click(function() {
                Toast.fire({
                    icon: 'success',
                    title: 'Account information updated.'
                })
            });
        });

        $(document).ready(function(){
            <?php
                if(isset($_GET['success']))
                    echo '$("#swalSuccess").trigger("click");';
                if(isset($_GET['status']))
                    echo '$("#swalStatus").trigger("click");';
                if(isset($_GET['update']))
                    echo '$("#swalUpdate").trigger("click");';
            ?>
        });
    </script>

</body>

</html>