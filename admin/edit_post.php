
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
<div class="col-sm-12 col-lg-10 d-flex ">

<form action='' class="w-100" method='post' enctype='multipart/form-data'>
      <div class="form-group col-sm-12 col-md-6">
      <label for='inputEmail4'>Post Title</label>
      <input name='post-title' type='text' class='form-control' id='inputEmail4' placeholder='Text' value='<?php echo $post_title; ?>'>
    </div>
    <div class='form-group col-sm-12 col-md-6'>
      <label for='category'>Post Cateogory</label>
      <select name='post-category' id='category' class='form-control' value=''>
      <?php 
        selectCategory($post_category_id);
      ?>
      </select>
    </div>
  <div class='form-group col-sm-12 col-md-6'>
    <label for='author'>Author</label>
    <input name='post-author' type='text' class='form-control' id='author' placeholder='Author' value='<?php echo $post_author; ?>'>
  </div>
  <div class='form-group col-sm-12 col-md-6'>
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
    <div class='form-group col-sm-12 col-lg-6'>
      <label for='image'>Image</label>
      <input name="post_image" class='d-none' onchange="displayImage(this)" type="file" id="image"><br/>
      <img src='../images/<?php echo $post_image; ?>' id='previewPost' alt="Image couldn't load">
    </div>
    <div class='form-group col-sm-12 col-md-6'>
      <label for='tags'>Tags</label>
      <input name='post-tag' type='text' class='form-control' id='tags' placeholder='Tags' value='<?php echo $post_tags; ?>'>
    </div>
    <div class='form-group col-sm-12 col-md-6'>
      <label for='content'>Type your content here</label>
      <textarea name='post-content' class='form-control' id='content' placeholder='Content'><?php echo $post_content; ?></textarea>
    </div>
    <div class='form-group col-sm-12 col-md-6'>
  <input type='submit' name='update_post' value='Update' class='btn btn-primary'>
  </div>
</form>
</div>
</div>

<script>
let chooseImage = document.getElementById('image');
let imagePlaceholder = document.getElementById('previewPost');
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
      document.getElementById('previewPost').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}


</script>