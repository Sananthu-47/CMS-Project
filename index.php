<?php

include "./includes/db.php";
include "./includes/header.php";
//Navbar of the CMS project
include "./includes/nav.php";

?>

<!--           Main content goes here     --->
      <div class="row d-flex justify-content-center">

    <div class="bg-light col-xs-5 col-sm-10 col-md-8 col-lg-6 col-xl-5 my-2">
        <!--   All posts  -->
        
<!--            1st       -->

<?php 

$query = "SELECT * FROM posts";
$result = mysqli_query($connection,$query);
$total_posts = mysqli_num_rows($result);

$number_of_posts_per_page = 3;
$page_count = floor($total_posts/$number_of_posts_per_page);
$page = 1;

if(isset($_GET['page']))
{
        $page = $_GET['page'];
}

if($page==1)
{
        $current_page = 0;
}else{
        $current_page = ($page * $number_of_posts_per_page) - $number_of_posts_per_page;
}

$query = "SELECT * FROM posts WHERE post_status = 'Published' LIMIT $current_page , $number_of_posts_per_page";
$result = mysqli_query($connection,$query);

while($row = mysqli_fetch_assoc($result))
{
  $post_id = $row['post_id'];
  $post_title = $row['post_title'];
  $post_user = $row['post_user'];
  $post_date = $row['post_date'];
  $post_image = $row['post_image'];
  $post_content = $row['post_content'];

  ?>
<div class="d-flex flex-column justify-content-center m-2">
        <a <?php
            if(isset($_SESSION['user_role']))
            {
            echo "href='individual_post.php?post_id=$post_id'";
            }else{
                    echo "href='includes/login.php'";
            } ?>"><h1 class="text-primary"><?php echo $post_title ?></h1></a>
            <h6 class="text-dark">by <span class="text-primary"><?php echo "<a href='specific_user.php?post_user={$post_user}'>$post_user</a>"?></span></h6>
            <h6 class="text-dark"><?php echo $post_date?></h6>
        <div class="bg-light">
        <a <?php
            if(isset($_SESSION['user_role']))
            {
            echo "href='individual_post.php?post_id=$post_id'";
            }else{
                    echo "href='includes/login.php'";
            } ?>"><img src="./images/<?php echo $post_image ?>" class="w-75 h-100" alt="Loading image"></a>
        </div>
        <div class="row d-block bg-light w-75 mt-2">
            <p><?php echo $post_content?></p>
            <a <?php
            if(isset($_SESSION['user_role']))
            {
            echo "href='individual_post.php?post_id=$post_id'";
            }else{
                    echo "href='includes/login.php'";
            } ?>><button class="bg-primary text-white">Read more</button></a>
        </div>  
</div>
  <?php
}
?>

<div class="d-flex justify-content-center mt-5 ">
        <ul class="pagination">
        <?php 
        for($i=1;$i<=$page_count;$i++)
        {
                if($i == $page)
                {
                echo "<li class='page-link current-tab'><a class='text-white' href='index.php?page=$i'>$i</a></li>";
                }else{
                echo "<li class='page-link'><a href='index.php?page=$i'>$i</a></li>";
                }
        }
        ?>
        </ul>
</div>

        </div>


        <!--    Other categories  -->
        <div class="col-xs-5 col-sm-8 col-md-6 col-lg-4 col-xl-3 m-md-2 ">

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

   