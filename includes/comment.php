<div class="d-flex flex-column justify-content-center mt-5">
<?php 
 addComment($post_id);
?>
<form action="" method="post">
    <h2>Comment here..</h2>
    <label for="username">Username</label>
    <input type="text" name="username" class="form-control" placeholder="username">
    <label for="email">Email</label>
    <input type="email" name="email" class="form-control" placeholder="email">
    <textarea name="comment" class="form-control my-2" placeholder="Comment" id="" cols="30" rows="10"></textarea>
    <input type="submit" name="submit" class="btn btn-primary col-md-3 col-sm-2 my-2" value="Submit">
    </form>
</div>

<div class="d-flex flex-column justify-content-center my-5 mx-2 ">
<?php 

$query = "SELECT * FROM comments WHERE comment_post_id = '$post_id' AND comment_status = 'Approved' ORDER BY comment_id DESC";
$result = mysqli_query($connection,$query);

if(!$result)
{
    die("Failed".mysqli_error($result));
}

while($row = mysqli_fetch_assoc($result))
{

    $author = $row['comment_author'];
    $comment = $row['comment_content'];
    $comment_date = $row['comment_date'];

echo "
    <div class='d-flex col-12 my-1 bg-info'>

    <div class='bg-dark border border-white mt-1' style='width:60px;height:60px;'>
    <img src='./images/randomguy.jpg' class='w-100 h-100' alt='image'>
    </div>

    <div class='col-sm-8 col-md-8 col-lg-9 d-flex flex-column mt-1'>
    <h4>$author</h4>
    <span>Commented on $comment_date</span>
    <div class='col-12 text-white'><h4>$comment</h4></div>
    </div>

    </div><br/>";
}
  ?>

</div>

<script>
setTimeout(()=>{
    document.querySelector('.alert-cls').style.display='none';
}, 3000);
</script>