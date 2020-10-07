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

        if(empty($email) || empty($password))
        {
            errorMsg('danger',"Any of the fields cannot be empty");
        }

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
            
    }
}


function register($msg,$alertCls)
{
    global $connection;

        if(isset($_POST['register']))
        {
        $user_firstname = mysqli_real_escape_string($connection,$_POST['firstName']);
        $user_lastname = mysqli_real_escape_string($connection,$_POST['lastName']);
        $user_name = mysqli_real_escape_string($connection,$_POST['username']);
        $user_email = mysqli_real_escape_string($connection,$_POST['userEmail']);
        $user_password = mysqli_real_escape_string($connection,$_POST['userPassword']);
        $user_password_again = mysqli_real_escape_string($connection,$_POST['userConformPassword']);
        $user_role = 'Subscriber';
        $user_image =time(). '_' .$_FILES['user_image']['name'];
        $user_image_temp = $_FILES['user_image']['tmp_name'];
        move_uploaded_file($user_image_temp,"../images/$user_image");
        $status = true;

        if(!empty($user_firstname)&&!empty($user_lastname)&&!empty($user_name)&&!empty($user_email)&&!empty($user_password)&&!empty($user_password_again))
        {
            if($user_password !== $user_password_again)
            {
            $msg = 'Passwords are not equal';
            $alertCls = 'alert-danger';
            }
            
            $query = "SELECT user_email FROM users";
            $result = mysqli_query($connection,$query);

            while($row = mysqli_fetch_assoc($result))
            {
                $dbEmail = $row['user_email'];
                if($dbEmail===$user_email)
                {
                    $status = false;
                }
            }

            if(!$status){
                $msg = 'Email already registered';
                $alertCls = 'alert-danger';
            }else{
                
                $query = "SELECT user_salt FROM users";
                $result = mysqli_query($connection,$query);

                if(!$result)
                {
                    die("Couldn't find the salt".mysqli_error($result));
                }

                $row = mysqli_fetch_array($result);
                $user_salt = $row['user_salt'];


                $user_password = crypt($user_password,$user_salt);
                $user_password_again = crypt($user_password_again,$user_salt);

                if($_FILES['user_image']['size'] <= 0)
                {
                    $user_image = "profile.jpg";
                }


                $query = "INSERT INTO users (username , user_firstname , user_lastname , user_role , user_image , user_email , user_password , user_date) VALUES ('{$user_name}','{$user_firstname}','{$user_lastname}','{$user_role}','{$user_image}','{$user_email}' , '{$user_password}' , now())";
                $result = mysqli_query($connection,$query);

                if(!$result)
                {
                    die("Error".mysqli_error($result));
                }else{
                    header("Location: ../index.php");
                }
                    }

        }else{
            $msg = 'Any of the fields cannot be empty';
            $alertCls = 'alert-danger';
        }
       
        }
        return array($msg,$alertCls);
}


?>







