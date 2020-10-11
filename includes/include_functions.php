<?php
function addComment($post_id)
{
    global $connection;
    if(isset($_POST['submit']))
{
    $comment_author = $_SESSION['username'];
    $comment_content = $_POST['comment'];
    $comment_post_id = $post_id;

    if(empty($comment_content))
    {
        die('Any of the fields should not be left blank plaese fill all fields');
    }
    $query = "INSERT INTO comments (comment_author , comment_date  , comment_content , comment_post_id) VALUES ('{$comment_author}',now(),'{$comment_content}','{$comment_post_id}')";
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
    echo '<div class="text-center alert-cls alert alert-'.$color.'">'.$msg.'</div>';
}

function loginCheck($location)
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

               $row = mysqli_fetch_array($result);
               
               $ResponseEmail = $row['user_email'];
               $ResponsePassword = $row['user_password'];
               $verified = password_verify($password,$ResponsePassword);
               $ResponseUsername = $row['username'];
               $ResponseRole = $row['user_role'];
               $ResponseId = $row['user_id'];

            if($email === $ResponseEmail && $verified == 1)
               {
                    $_SESSION['username'] = $ResponseUsername;
                    $_SESSION['user_role'] = $ResponseRole;
                    $_SESSION['user_id'] = $ResponseId;

                    if($_SESSION['user_role']==='Admin')
                    {
                    header("Location: ".$location."index.php");
                    }else
                    if($_SESSION['user_role']==='Subscriber'){
                        header("Location: ".$location."subscriber.php"); 
                    }

               }else{
                errorMsg('danger',"Password didnot match the email"); 
               }
        }else{
            errorMsg('danger',"Any of the fields cannot be empty");
        }
    }
}









