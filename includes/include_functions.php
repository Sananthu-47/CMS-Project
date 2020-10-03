<?php
function addComment($post_id)
{
    global $connection;
    if(isset($_POST['submit']))
{
    $comment_author = $_POST['username'];
    $comment_email = $_POST['email'];
    $comment_content = $_POST['comment'];
    $comment_post_id = $post_id;

    if(empty($comment_author)  || empty($comment_email) || empty($comment_content))
    {
        die('Any of the fields should not be left blank plaese fill all fields');
    }
    $query = "INSERT INTO comments (comment_author , comment_date , comment_email , comment_content , comment_post_id) VALUES ('{$comment_author}',now(),'{$comment_email}','{$comment_content}','{$comment_post_id}')";
    $result = mysqli_query($connection,$query);

    if(!$result)
    {
        errorMsg('danger',"Couldn't add the comment");
    }else{
        errorMsg('success','Successfully added comment');
    }

    $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $post_id";
    $result = mysqli_query($connection,$query);


}
}

function errorMsg($color,$msg)
{
    echo '<div class="alert-cls alert alert-'.$color.'">'.$msg.'</div>';
}

function loginCheck()
{ 
    global $connection;
    if(isset($_POST['login']))
    {
        $email = mysqli_real_escape_string($connection,$_POST['email']);
        $password = mysqli_real_escape_string($connection,$_POST['password']);

        if(!empty($email) && !empty($password))
        {
        $query = "SELECT * FROM users WHERE user_email = '{$email}'";
        $result = mysqli_query($connection,$query);

        if(!$result)
        {
            die("Error occured: ".mysqli_error($result));
        }

            while($row = mysqli_fetch_assoc($result))
            {
               $ResponseEmail = $row['user_email'];
               $ResponsePassword = $row['user_password'];
               $ResponseUsername = $row['username'];
               $ResponseRole = $row['user_role'];
               $ResponseId = $row['user_id'];
            }
    
            if($email === $ResponseEmail && $password === $ResponsePassword)
               {
                    $_SESSION['username'] = $ResponseUsername;
                    $_SESSION['user_role'] = $ResponseRole;
                    $_SESSION['user_id'] = $ResponseId;
                    header("Location: ./admin/index.php");
               }else{
                errorMsg('danger',"Password didnot match the email"); 
               }
        }else{
            errorMsg('danger',"Any of the fields cannot be empty");
        }
    }
}












