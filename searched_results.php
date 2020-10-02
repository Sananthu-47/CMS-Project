<?php

include "./includes/db.php";
include "./includes/header.php";
//Navbar of the CMS project
include "./includes/nav.php";

?>

<!--           Main content goes here     --->
<div class="row d-flex justify-content-center">

<div class="bg-light col-xs-10 col-sm-10 col-md-8 col-lg-6 col-xl-5 my-2">
        <!--   All posts  -->

<!--            1st  post comes here      -->

<?php 
if(isset($_POST['submit']))
{
    global $connection;
    $search_keyword = $_POST['search'];
    $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search_keyword%' AND post_status = 'Published'";
    $result = mysqli_query($connection,$query);

    if(!$result)
    {
        die("Error occured".mysqli_error($result));
    }

    $count = mysqli_num_rows($result);

    if($count===0)
    {
        echo "<div class='alert alert-danger text-center mt-5'>Tag not found search for some other tags</div>"; 
    }
    else
    {
    while($row = mysqli_fetch_assoc($result))
    {
        $post_id = $row['post_id'];
      $post_title = $row['post_title'];
      $post_user = $row['post_user'];
      $post_date = $row['post_date'];
      $post_image = $row['post_image'];
      $post_content = $row['post_content'];
    
      ?>
    <div class="d-flex justify-content-center flex-column m-2">
    <a href="individual_post.php?post_id=<?php echo $post_id; ?>"><h1 class="text-primary"><?php echo $post_title ?></h1></a>
                <h6 class="text-dark">by <span class="text-primary"><?php echo $post_user?></span></h6>
                <h6 class="text-dark"><?php echo $post_date?></h6>
                <div style="height: 200px;" class="bg-light">
                <a href="individual_post.php?post_id=<?php echo $post_id; ?>"><img src="./images/<?php echo $post_image ?>" class="col-lg-10 col-xl-9 col-md-11 col-xs-12 col-sm-12 h-100" alt="Loading image"></a>
                </div>
                <div class="row d-block bg-light w-75 mt-2">
                <p><?php echo $post_content?></p>
                <a href="individual_post.php?post_id=<?php echo $post_id; ?>"><button class="bg-primary text-white">Read more</button></a>
                </div> 
    </div>
<?php
}
}
}
?>
        </div>
        <!--    Other categories  -->
        <div class="col-xs-10 col-sm-8 col-md-6 col-lg-4 col-xl-3 m-md-2 ">

         <?php 
         /*        1st        */
         include "./includes/search_engine.php";
         /*         2nd        */
         include "./includes/login_side.php";
         /*         3rd         */
         include "./includes/categories.php";
         /*         4th         */
         include "./includes/recent_post.php";
         ?>
          
        </div>
    </div>
</div>

        <?php include "./includes/footer.php"; ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>