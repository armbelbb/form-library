<div class="modal fade" id="requestNewFormModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold text-dark" id="modalTitle">Request Form</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="actions.php" id="requestForm">
                    <div class="row">
                        <div class="form-group col-6">
                            <label class="font-weight-bold text-dark" for="form_category">FORM CATEGORY<ast class="text-danger">*</ast>:</label>
                            <select class="form-control" name="form_id" id="form_id" required>
                                <option value="" selected disabled>Choose an option</option>
                                <?php
                                    if(isset($_POST['category_id']) && $_POST['category_id'] != 'ALL'){
                                        $sql = "SELECT A.*, B.category_name 
                                                FROM forms as A 
                                                LEFT JOIN categories as B ON B.id = A.category_id 
                                                WHERE A.category_id = $_POST[category_id]";
                                    }
                                    else{
                                        $sql = "SELECT A.*, B.category_name 
                                                FROM forms as A 
                                                LEFT JOIN categories as B ON B.id = A.category_id";
                                    }
                                    $forms = $conn->query($sql);
                                    foreach($forms as $form){
                                        echo "<option value='$form[id]'>$form[form_name]</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" name="requestForm" form="requestForm" class="btn btn-primary">Confirm</button>
            </div>
        </div>
    </div>
</div>
<div class="card w-100" style="z-index: 0; margin-top: 0px;">
  <div class="card-header">
      Category
  </div>
  <div class="card-body">
      <div class="col" style="position: relative; z-index: 0; margin-top: 0;">
          <div class="row">
            <form method="POST" action="#" id="filterForm"></form>
            <div class="col h-100 d-flex flex-column"> <!-- this is the list col -->
              <?php
                    $sql = "SELECT * FROM categories ORDER BY category_name ASC";
                    $categories = $conn->query($sql);
                    if(!isset($_POST['category_id']) || $_POST['category_id'] == 'ALL')
                      echo "<button type='submit' form='filterForm' class='btn btn-sm btn-outline-primary text-black' value='ALL' name='category_id' style='background-color: #4e73df; color: white;'>ALL</button>";
                    else
                      echo "<button type='submit' form='filterForm' class='btn btn-sm btn-outline-primary text-black' value='ALL' name='category_id'>ALL</button>";
                    foreach($categories as $category){
                        if(isset($_POST['category_id']) && $_POST['category_id'] == $category['id'])
                          echo "<button type='submit' form='filterForm' class='btn btn-sm btn-outline-primary text-black mt-2' value='$category[id]' name='category_id' style='background-color: #4e73df; color: white;'>$category[category_name]</button>";
                        else
                          echo "<button type='submit' form='filterForm' class='btn btn-sm btn-outline-primary text-black mt-2' value='$category[id]' name='category_id'>$category[category_name]</button>";
                    }
                ?>
            </div>
          </div>
      </div>
  </div>
  <footer class="footer mt-auto py-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary w-100" onclick="$('#requestNewFormModal').modal('show')">Request Forms</button>
            </div>
        </div>
    </div>
  </footer>
</div>
