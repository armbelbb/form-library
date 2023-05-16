<!DOCTYPE html>
<html lang="en">

  <head>

      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">

      <title>Add New Form</title>

      <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
      <link href="css/sb-admin-2.min.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <div class="d-flex align-items-center justify-content-center vh-100 mx-3">
      <div class="card w-100">

        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
            <h6 class="m-0 font-weight-bold text-primary">Add New District</h6>
        </div>

        <div class="card-body">
          <form class="w-100" id="form">
            <div class="form-row">
              <div class="form-group col-md-3">
                <label for="formName">District Name</label>
                <input type="text" class="form-control" id="districtName" placeholder="District Name">
              </div>
              <div class="form-group col-md-3">
                <label for="formReferenceId">Email</label>
                <input type="text" class="form-control" id="email" placeholder="Email Address">
              </div>
              <div class="form-group col-md-3">
                <label for="formReferenceId">Password</label>
                <input type="text" class="form-control" id="password" placeholder="Password">
              </div>
              <div class="form-group col-md-3">
                <label for="formIndex">Contact</label>
                <input type="text" class="form-control" id="contact" placeholder="District Contact Number">
              </div>
            </div>
          </form>
        </div>

        <div class="card-footer">
          <button class="btn btn-primary" onclick="window.close(); window.opener.location.reload();">Submit</button>
          <button class="btn btn-secondary" onclick="window.close(); window.opener.location.reload();">Cancel</button>
        </div>
        
      </div>
    </div>
  

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top"> <i class="fas fa-angle-up"></i> </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>

  </body>
</html>