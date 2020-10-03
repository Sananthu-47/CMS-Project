<div class="card border-primary my-3">
            <div class="card-header h3">Categories</div>
            <div class="card-body text-primary d-flex flex-column">
              <?php 
              
              $query = "SELECT * FROM categories";
              $results = mysqli_query($connection,$query);

              if(!$results)
              {
                echo "no";
              }else{
                while($row = mysqli_fetch_assoc($results))
                {
                  $category_id = $row['id'];
                  $category = $row['category_title'];
                  echo "<a href='category_searched.php?category=$category_id' class='h4'>$category</a>";
                }
              }
              ?>
            </div>
          </div>