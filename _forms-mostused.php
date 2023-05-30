<div class="container">
    <div class="row">
        <?php
            if(isset($_POST['category_id']) && $_POST['category_id'] != 'ALL'){
                $sql = "SELECT A.*, B.category_name 
                        FROM forms as A 
                        LEFT JOIN categories as B ON B.id = A.category_id 
                        WHERE A.category_id = $_POST[category_id] 
                        AND A.status = 'Active'";
            }
            else{
                $sql = "SELECT A.*, B.category_name 
                        FROM forms as A 
                        LEFT JOIN categories as B ON B.id = A.category_id 
                        WHERE A.status = 'Active'";
            }
            $paginationCtr = 0;
            $flagVisible = "block";
            $forms = $conn->query($sql);
            foreach($forms as $form){
                if($paginationCtr > 2) $flagVisible = 'none';
                $workflow = $form['workflow'] == "" ? "img/no_workflow.png" : "uploads/$form[workflow]";
                $thumbnail = $form['thumbnail'] == "" ? "img/no_workflow.png" : "uploads/$form[thumbnail]";
                echo "<div class='col-sm-4 text-center formCard' style='display: $flagVisible;'>";
                    echo "<img src='$thumbnail' alt='$form[form_index]' class='img-thumbnail' style='object-fit: cover; height: 250px;' onclick='$(\"#updateFormModal$form[id]\").modal(\"toggle\")'>";
                    echo "<h3><a href='$form[link]' target='_blank'>$form[form_name]</a></h3>";
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
                                            <label class='font-weight-bold text-dark'><a href='$form[link]' target='_blank'>FORM LINK</a></label>
                                        </div>
                                        <div class='form-group col-12'>
                                            <label class='font-weight-bold text-dark'>WORKFLOW<ast class='text-danger'></ast>: $form[category_name]</label>
                                            <img src='$workflow' class='img-fluid' alt='IMAGE NOT FOUND'>
                                        </div>
                                        <div class='form-group embed-responsive embed-responsive-16by9 col-12'>
                                            <iframe src='$form[link]' class='embed-responsive-item' title='TheForm'></iframe>
                                        </div>
                                    </div>
                                </div>
                                <div class='modal-footer'>
                                    <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>";
                                    if($_SESSION['type'] == 'Client')
                                    echo "<button type='button' class='btn btn-primary' onclick='loadRequestModal($form[id], \"$thumbnail\")'>Request Form</button>";
                                echo "</div>
                            </div>
                        </div>
                    </div>
                ";
                $paginationCtr++;
            }
            $paginationPage = 2;
            echo "<nav aria-label='Page navigation example'>";
                echo "<ul class='pagination'>";
                    echo "<li class='page-item'><a class='page-link' onclick='setPagination(\"minus\")'>Previous</a></li>";
                    echo "<li class='page-item'><a class='page-link' onclick='setPagination(1)'>1</a></li>";
                    while($paginationCtr > 3){
                        echo "<li class='page-item'><a class='page-link' onclick='setPagination($paginationPage)'>$paginationPage</a></li>";
                        $paginationCtr-=3;
                        $paginationPage++;
                    }
                    echo "<li class='page-item'><a class='page-link' onclick='setPagination(\"plus\")'>Next</a></li>";
                echo "</ul>";
            echo "</nav>";
        ?>
    </div>
</div>
<script>
    var currentPage = 1;
    var maxPage = <?php echo $paginationPage - 1;?>;
    function loadRequestModal(formId, thumbnail){
        $('#form_id option[value=' + formId + ']').attr('selected','selected');
        $('#form_id2').val($('#form_id').val());
        $('#form_id2').prop('disabled', false);
        $('#form_id').prop('disabled', 'disabled');
        $("#requestNewFormModal").modal("toggle");
        $('#formRequestThumbnail').attr('src', thumbnail);
    }

    function setPagination(page){
        var cards = document.getElementsByClassName('formCard');
        if(page == 'minus' && currentPage > 1){
            currentPage = parseInt(currentPage) - 1;
        }
        else if(page == 'plus' && currentPage < maxPage){
            currentPage = parseInt(currentPage) + 1;
        }
        else if(isInt(page)){
            currentPage = page;
        }
        var toGet = (parseInt(currentPage) * 3) - 2;
        var showCards = [parseInt(toGet) - 1, toGet, parseInt(toGet) + 1];
        for(var i = 0; i < cards.length; i++){
            if(showCards.includes(i)){
                cards[i].style.display = "block"; // or
            }
            else{
                cards[i].style.display = "none"; // or
            }
        }
    }

    function isInt(value) {
        var x = parseFloat(value);
        return !isNaN(value) && (x | 0) === x;
    }
</script>