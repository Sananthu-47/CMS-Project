
<?php  
if(isset($_GET['post_id']))
{
$post_id = $_GET['post_id'];

$query = "SELECT * FROM posts WHERE post_id = {$post_id}";
        $results = mysqli_query($connection,$query);

        while($row = mysqli_fetch_assoc($results))
        {
          $post_author = $row['post_user'];
          $post_category_id = $row['post_category_id'];
          $post_title = $row['post_title'];
          $post_date = $row['post_date'];
          $post_image = $row['post_image'];
          $post_tags = $row['post_tags'];
          $post_status = $row['post_status'];
          $post_content = $row['post_content'];
         }
}
?>
<?php  updatePost($post_id);  ?>
<div class='col-sm-12 col-lg-8 d-flex'>

<form action='' method='post' enctype='multipart/form-data'>
    <div class='form-group col-sm-12 col-lg-8'>
      <label for='inputEmail4'>Post Title</label>
      <input name='post-title' type='text' class='form-control' id='inputEmail4' placeholder='Text' value='<?php echo $post_title; ?>'>
    </div>
    <div class='form-group col-sm-12 col-lg-8'>
      <label for='category'>Post Cateogory</label>
      <select name='post-category' id='category' class='form-control' value=''>
      <?php 
        selectCategory($post_category_id);
      ?>
      </select>
    </div>
  <div class='form-group col-sm-12 col-lg-8'>
    <label for='author'>Author</label>
    <input name='post-author' type='text' class='form-control' id='author' placeholder='Author' value='<?php echo $post_author; ?>'>
  </div>
  <div class='form-group col-sm-12 col-lg-8'>
    <label for='status'>Post Status</label>
    <select name='post-status' id='status' class='form-control' value=''>
    <?php 
    if($post_status == 'Draft')
    {
     echo " <option selected value='Draft'>Draft</option>
    <option value='Published'>Published</option>";
    }else{
      echo "<option value='Draft'>Draft</option>
      <option selected value='Published'>Published</option>";
    }
    ?>
    </select>
  </div>
    <div class='form-group col-sm-4 col-lg-6'>
      <label for='image'>Image</label>
      <input name='post-image' type='file' id='image' value='<?php echo $post_image; ?>'><br/>
      <img src='../images/<?php echo $post_image; ?>' id='preview' class='w-100 h-75' alt="Image couldn't load">
    </div>
    <div class='form-group col-sm-12 col-lg-8'>
      <label for='tags'>Tags</label>
      <input name='post-tag' type='text' class='form-control' id='tags' placeholder='Tags' value='<?php echo $post_tags; ?>'>
    </div>
    <div class='form-group col-sm-12 col-lg-8'>
      <label for='content'>Type your content here</label>
      <textarea name='post-content' class='form-control' id='content' placeholder='Content'><?php echo $post_content; ?></textarea>
    </div>
    <div class='form-group col-sm-12 col-lg-8'>
  <input type='submit' name='update_post' value='Update' class='btn btn-primary'>
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
    document.querySelector('.alert-cls').style.display='none';
}, 3000);
</script>