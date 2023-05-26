<div class="card">
    <div class="card-header">
      Need a new Form?
    </div>
    <div class="card-body">
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
      <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.</p>
      <button class="btn btn-primary" onclick='$("#requestFormModal").modal("toggle")'>Request New Form</button>
    </div>
    <div class="modal fade" id="requestFormModal">
    <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title font-weight-bold text-dark" id="modalTitle">Request Form</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form method="POST" action="actions.php" id="requestForm2">
                      <div class="row">
                          <div class="form-group col-7">
                              <label class="font-weight-bold text-dark" for="district_name2">DISTRICT NAME<ast class="text-danger">*</ast>:</label>
                              <input type="text" class="form-control" name="district_name" id="district_name2" value="<?php echo $_SESSION['display_name'];?>" readonly>
                          </div>
                          <div class="form-group col-7">
                              <label class="font-weight-bold text-dark" for="requestor_email2">EMAIL<ast class="text-danger">*</ast>:</label>
                              <input type="email" class="form-control" name="requestor_email" id="requestor_email2" required>
                          </div>
                          <div class="form-group col-7">
                              <label class="font-weight-bold text-dark" for="requestor_name2">NAME<ast class="text-danger">*</ast>:</label>
                              <input type="text" class="form-control" name="requestor_name" id="requestor_name2" required>
                          </div>
                          <div class="form-group col-7">
                              <label class="font-weight-bold text-dark" for="phone_number2">PHONE NUMBER<ast class="text-danger">*</ast>:</label>
                              <input type="text" class="form-control" name="phone_number" id="phone_number2" required>
                          </div>
                          <div class="form-group col-12">
                              <label class="font-weight-bold text-dark" for="request_notes2">NOTES:</label>
                              <textarea class="form-control" name="request_notes" id="request_notes2"></textarea>
                          </div>
                      </div>
                  </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button type="submit" name="requestForm" form="requestForm2" class="btn btn-primary">Confirm</button>
              </div>
          </div>
      </div>
    </div>  
    <div class="card-footer text-right">
      <button class="btn btn-primary">Learn More</button>
    </div>
  </div>
  