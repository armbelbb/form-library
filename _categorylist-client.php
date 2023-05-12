<div class="card w-100" style="z-index: 0; margin-top: 0px;">
  <div class="card-header">
      Category
  </div>
  <div class="card-body">
      <div class="col" style="position: relative; z-index: 0; margin-top: 0;">
          <div class="row">
            <div class="col h-100 d-flex flex-column"> <!-- this is the list col -->
                <?php
                    $sql = "SELECT * FROM categories ORDER BY category_name ASC";
                    $categories = $conn->query($sql);
                    echo "<a href='#' class='btn btn-sm btn-outline-primary text-black'>ALL</a>";
                    foreach($categories as $category){
                        echo "<a href='#' class='btn btn-sm btn-outline-primary text-black mt-2'>$category[category_name]</a>";
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
                <button class="btn btn-primary w-100">Request Forms</button>
            </div>
        </div>
    </div>
  </footer>
</div>
