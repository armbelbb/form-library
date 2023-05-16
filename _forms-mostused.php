<div class="container">
    <div class="row">
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
                $workflow = $form['workflow'] == "" ? "img/no_workflow.png" : "uploads/$form[workflow]";
                $thumbnail = $form['thumbnail'] == "" ? "img/no_workflow.png" : "uploads/$form[thumbnail]";
                $attachment = $form['attachment'] == "" ? "N/A" : "$form[attachment]";
                echo "<div class='col-sm-4 text-center'>";
                    echo "<img src='$thumbnail' alt='$form[form_index]' class='img-thumbnail' style='object-fit: cover; height: 250px;' onclick='$(\"#updateFormModal$form[id]\").modal(\"toggle\")'>";
                    echo "<h3><a href='$form[link]' target='_blank'>$form[form_name]</a></h3>";
                    echo "<p class='text-justify'>$form[form_description]</p>";
                echo "</div>";
                echo "
                    <div class='modal fade' id='updateFormModal$form[id]'>
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
            }
        ?>
    </div>
</div>
