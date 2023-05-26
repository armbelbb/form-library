<div class="card w-100" style="z-index: 0; margin-top: 50px;">
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
  </div>
