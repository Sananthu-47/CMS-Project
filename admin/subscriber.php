﻿<?php include "./admin_header.php"; ?>
  
<div class="inner-content h-100 w-100 d-lg-flex">
	   <!--/. NAV TOP  -->
		<div class="col-lg-12 p-0 main-content">
		  <div class="header"> 
                        <h1 class="page-header">
                            User account info
                        </h1>
									
		  </div>
            <div class="page-inner d-flex justify-content-center">
<?php 
$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM users WHERE user_id = '{$user_id}'";
$result = mysqli_query($connection,$query);

if(!$result)
{
  die("Error:".mysqli_error($result));
}

$row = mysqli_fetch_assoc($result);
  $user_id = $row['user_id'];
  $username = $row['username'];
  $user_firstname = $row['user_firstname'];
  $user_lastname = $row['user_lastname'];
  $user_role = $row['user_role'];
  $user_image = $row['user_image'];
  $user_email = $row['user_email'];
  $user_password = $row['user_password'];
?>

           <div class="col-sm-12 col-md-8">
            <?php  updateUser($user_id);  ?>
<form action="" method="post" class="w-100" enctype="multipart/form-data">
<div class="form-group col-sm-12 col-md-8 d-flex justify-content-center">
      <input name="user_image" class='d-none' onchange="displayImage(this)" type="file" id="image"><br/>
      <img src="../images/<?php echo $user_image; ?>" id="preview" alt="">
    </div>
    <div class="form-group col-sm-12 col-md-8">
      <label for="username">Username</label>
      <input name="username" type="text" class="form-control" id="username" placeholder="Username" value="<?php echo $username; ?>">
    </div>
  <div class="form-group col-sm-12 col-md-8">
    <label for="user_firstname">Firstname</label>
    <input name="user_firstname" type="text" class="form-control" id="firstname" placeholder="Firstname" value="<?php echo $user_firstname; ?>">
  </div>
  <div class="form-group col-sm-12 col-md-8">
    <label for="user_lastname">Lastname</label>
    <input name="user_lastname" type="text" class="form-control" id="lastname" placeholder="lastname" value="<?php echo $user_lastname; ?>">
  </div>
  <div class="form-group col-sm-12 col-md-8">
    <label for="user_email">Email</label>
    <input name="user_email" type="email" class="form-control" id="author" placeholder="email" value="<?php echo $user_email; ?>">
  </div>
    <div class="form-group col-sm-12 col-md-8">
  <input type="submit" name="update_user" value="Update" class="btn btn-primary">

  </div>
</form>
</div>
</div>

<script>

let chooseImage = document.getElementById('image');
let imagePlaceholder = document.getElementById('preview');
if(chooseImage)
{
imagePlaceholder.addEventListener('click',()=>{
  chooseImage.click();
});
}

function displayImage(e) {
  if(e.files[0])
  {
    let reader = new FileReader();
    reader.onload = (e)=>{
      document.getElementById('preview').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}

</script>


</div>
</div>
                <?php include "./admin_footer.php"; ?>