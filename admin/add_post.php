
<?php  addPost();  ?>

<div class="col-sm-12 col-lg-10 d-flex ">

<form action="" class="w-100" method="post" enctype="multipart/form-data">
    <div class="form-group col-sm-12 col-md-6">
      <label for="inputEmail4">Post Title</label>
      <input name="post-title" type="text" class="form-control" id="inputEmail4" placeholder="Text">
    </div>
    <div class="form-group col-sm-12 col-md-6">
      <label for="category">Post Cateogory</label>
      <select name="post-category" id="category" class='form-control' value="">
      <option class="text-center" value="" selected disabled hidden>-----Selcet the category-----</option>
      <?php 
        selectCategory(null);
      ?>
      </select>
    </div>
  <div class="form-group col-sm-12 col-md-6">
    <label for="author">Author</label>
    <input name="post-author" type="text" class="form-control" id="author" placeholder="Author">
  </div>
  <div class="form-group col-sm-12 col-md-6">
    <label for="status">Post Status</label>
    <select name="post-status" id="category" class='form-control' value="">
      <option selected value='Draft'>Draft</option>
      <option value='Published'>Published</option>
    </select>
  </div>
    <div class="form-group col-sm-4 col-md-6">
      <label for="image">Image</label>
      <input name="post-image" type="file" id="image"><br/>
      <img src="../images/" id="preview" class="w-75 h-50" alt="">
    </div>
    <div class="form-group col-sm-12 col-md-6">
      <label for="tags">Tags</label>
      <input name="post-tag" type="text" class="form-control" id="tags" placeholder="Tags">
    </div>
    <div class="form-group col-sm-12 col-md-6">
      <label for="content">Type your content here</label>
      <textarea name="post-content" class="form-control" id="content" placeholder="Content"></textarea>
    </div>
    <div class="form-group col-sm-12 col-md-6 text-center">
  <input type="submit" name="publish_post" value="Post" class="btn btn-primary w-50">
  </div>
</form>
</div>
</div>

<script>
let chooseImage = document.getElementById('image');
chooseImage.addEventListener('change',()=>{
  let selectedImage = chooseImage.value;
  if(selectedImage!==undefined)
{
  document.getElementById('preview').src='../images/'+selectedImage.slice(12,);
}
});
setTimeout(()=>{
    document.querySelector('.alert-cls').style.display="none";
}, 3000);
</script>