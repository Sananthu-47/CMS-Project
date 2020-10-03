
<?php  
if(isset($_GET['user_id']))
{
$user_id = $_GET['user_id'];

$query = "SELECT * FROM users WHERE user_id = {$user_id}";
        $results = mysqli_query($connection,$query);

        while($row = mysqli_fetch_assoc($results))
        {
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_role = $row['user_role'];
            $user_image = $row['user_image'];
            $user_email = $row['user_email'];
            $user_password = $row['user_password'];
         }
}
?>
<?php  updateUser($user_id);  ?>
<div class='col-sm-12 col-lg-8 d-flex justify-content-center'>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group col-sm-12 col-lg-8">
      <label for="username">Username</label>
      <input name="username" type="text" class="form-control" id="username" placeholder="Username" value="<?php echo $username; ?>">
    </div>
  <div class="form-group col-sm-12 col-lg-8">
    <label for="user_firstname">Firstname</label>
    <input name="user_firstname" type="text" class="form-control" id="firstname" placeholder="Firstname" value="<?php echo $user_firstname; ?>">
  </div>
  <div class="form-group col-sm-12 col-lg-8">
    <label for="user_lastname">Lastname</label>
    <input name="user_lastname" type="text" class="form-control" id="lastname" placeholder="lastname" value="<?php echo $user_lastname; ?>">
  </div>
  <div class="form-group col-sm-12 col-lg-8">
    <label for="user_role">Role</label>
    <select name="user_role" id="category" class='form-control' value="">
    <?php 
    if($user_role == 'Subscriber')
    {
        echo "<option selected value='Subscriber'>Subscriber</option>
        <option value='Admin'>Admin</option>";
    }else{
        echo "<option value='Subscriber'>Subscriber</option>
        <option selected value='Admin'>Admin</option>";
    }
    ?>
    </select>
  </div>
  <div class="form-group col-sm-12 col-lg-8">
    <label for="user_email">Email</label>
    <input name="user_email" type="email" class="form-control" id="author" placeholder="email" value="<?php echo $user_email; ?>">
  </div>
  <div class="form-group col-sm-12 col-lg-8">
      <label for="tags">Password</label>
      <input name="user_password" type="password" class="form-control" id="tags" placeholder="password" value="<?php echo $user_password; ?>">
    </div>
    <div class="form-group col-sm-4 col-lg-6">
      <label for="user_image">Image</label>
      <input name="user_image" type="file" id="image" value="<?php echo $user_image; ?>"><br/>
      <img src="../images/<?php echo $user_image; ?>" id="preview" class="w-75 h-50" alt="">
    </div>
    <div class="form-group col-sm-12 col-lg-8">
  <input type="submit" name="update_user" value="Update" class="btn btn-primary">
  </div>
</form>
</div>
</div>

