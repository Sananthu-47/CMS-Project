<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand bg-info" href="index.php">CMS Project</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">

<?php 

// include "db.php";
 session_start();
$query = "SELECT * FROM categories LIMIT 0,6";
$result = mysqli_query($connection,$query);

while($row=mysqli_fetch_assoc($result))
{
  $category = $row['category_title'];
  $category_id = $row['id'];
  echo "<li class='nav-item mx-sm-2 mx-md-2 mx-lg-3 mx-xs-5'>
  <a class='nav-link lead font-weight-bold' href='category_searched.php?category=$category_id'>{$category}</a>
</li>";
}
?>
<li class='nav-item mx-sm-2 mx-md-2 mx-lg-3 mx-xs-5'>
<?php 
if(isset($_SESSION['user_role']))
{
  if($_SESSION['user_role'] === 'Admin')
  {
    echo "<a class='nav-link lead font-weight-bold' href='admin/index.php'>Admin</a>";
  }else{
    echo "<a class='nav-link lead font-weight-bold' href='admin/subscriber.php'>Profile</a>";
  }
}else{
  echo "<a class='nav-link lead font-weight-bold' href='./includes/login.php'>Login</a>";
} ?>
</li>
          </ul>

          <ul class="navbar-nav">
            <li class='nav-item mx-sm-2 mx-md-2 mx-lg-3 mx-xs-5 badge badge-danger'>
              <a class='nav-link text-white font-weight-bold' href='includes/register.php'>Register</a>
            </li>
          </ul>

        </div>
      </nav>