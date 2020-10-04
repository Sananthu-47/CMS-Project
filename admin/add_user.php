<?php addUser();  ?>
<div class="col-sm-12 col-lg-10 d-flex ">

<form action="" class="w-100" method="post" enctype="multipart/form-data">
    <div class="form-group col-sm-12 col-md-6">
      <label for="username">Username</label>
      <input name="username" type="text" class="form-control" id="username" placeholder="Username">
    </div>
  <div class="form-group col-sm-12 col-md-6">
    <label for="user_firstname">Firstname</label>
    <input name="user_firstname" type="text" class="form-control" id="firstname" placeholder="Firstname">
  </div>
  <div class="form-group col-sm-12 col-md-6">
    <label for="user_lastname">Lastname</label>
    <input name="user_lastname" type="text" class="form-control" id="lastname" placeholder="lastname">
  </div>
  <div class="form-group col-sm-12 col-md-6">
    <label for="user_role">Role</label>
    <select name="user_role" id="category" class='form-control' value="">
      <option selected value='Subscriber'>Subscriber</option>
      <option value='Admin'>Admin</option>
    </select>
  </div>
  <div class="form-group col-sm-12 col-md-6">
    <label for="user_email">Email</label>
    <input name="user_email" type="email" class="form-control" id="author" placeholder="email">
  </div>
  <div class="form-group col-sm-12 col-md-6">
      <label for="tags">Password</label>
      <input name="user_password" type="password" class="form-control" id="tags" placeholder="password">
    </div>
    <div class="form-group col-sm-4 col-md-6">
      <label for="user_image">Image</label>
      <input name="user_image" class='d-none' onchange="displayImage(this)" type="file" id="image"><br/>
      <img src="../images/profile.jpg" id="preview" alt="">
    </div>
    <div class="form-group col-sm-12 col-md-6 text-center">
  <input type="submit" name="add_user" value="Add" class="btn btn-primary w-50">
  </div>
</form>
</div>
</div>

<script>

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