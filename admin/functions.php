<?php 

function add_categories()
{
    global $connection;
    $query = "SELECT * FROM categories";
    $result = mysqli_query($connection,$query);

    if(!$result)
    {
        echo "<div class='alert alert-danger'>Database not connected successfully</div>";
    }else{
        echo "<table class='table table-striped table-bordered' style='border: 2px solid black;'>
        <thead>
          <tr>
          <th scope='col'>ID</th>
          <th scope='col'>Category</th>
        </tr>
      </thead>
      <tbody name='category_table_name'>";
        while($row=mysqli_fetch_assoc($result))
        {
        $id = $row['id'];
        $category_title = $row['category_title'];
        echo "
<tr>
<td>$id</td>
<td class='d-flex justify-content-between'>
<span> $category_title </span>
<div>
<button id='delete' class='mx-3'>
<a href='admin_categories.php?delete=$id'>
<i class='fa fa-times'></i></a>
</button>
<button id='edit'>
<a name='delete' href='admin_categories.php?edit=$id'>
<i class='fa fa-pencil'></i></a>
</button>
</div>
</td> 
</tr>
        ";
    }
}
}



function delete_categories()
{
    global $connection;
    if(isset($_GET['delete']))
                    {
                        $id = $_GET['delete'];
                        $query = "DELETE FROM categories WHERE id = {$id}";
                        $result = mysqli_query($connection,$query);
                        header('Location:admin_categories.php');
                    }
}

function check_for_submit()
{
    if(isset($_POST['submit']))
{
    global $connection;
    $category_title = $_POST['category'];
    if($category_title == "" || empty($category_title))
    {     
        errorMsg('danger','Fields cannot be empty');       
    }else{
        $query = "INSERT INTO categories (category_title) VALUES('$category_title')";
                    $result = mysqli_query($connection,$query);
                    errorMsg('success','Added sucessfully');
    }
}
}

function check_for_update()
{
        if(isset($_POST['update']))
        {
        $category_title = $_POST['category'];
        $category_id = $_GET['edit'];
        global $connection;
        if($category_title == "" || empty($category_title))
        {          
        errorMsg('danger','Fields cannot be empty');
        }else{
        $query = "UPDATE categories SET category_title = '$category_title' WHERE id = '$category_id' ";
        $result = mysqli_query($connection,$query);
        header('Location:admin_categories.php');
        errorMsg('sucess','Successfully updated');
        }
        }
}

function errorMsg($color,$msg)
{
    echo '<div id="alertClass" class="alert-cls alert alert-'.$color.'">'.$msg.'</div>';
}

function selectCategory($selected)
{
    global $connection;
    $query = "SELECT * FROM categories";
      $result = mysqli_query($connection,$query);
      while($row = mysqli_fetch_assoc($result))
      {
        $value = $row['id'];
        $display = $row['category_title'];
        if($selected === $value)
        {
        echo "<option selected value='$value'>$display</option>";
        }else{
            echo "<option value='$value'>$display</option>";
        }
      }
}

function deletePost()
{
    global $connection;
    if(isset($_GET['delete']))
{
$query = "DELETE FROM posts WHERE post_id = {$_GET['delete']}";
$result = mysqli_query($connection,$query);

$query = "DELETE FROM comments WHERE comment_post_id ={$_GET['delete']}";
$result = mysqli_query($connection,$query);

if($result)
{
    errorMsg('danger','Post deleted successfully');
}else{
    die("Error");
}
}

}


function addPost()
{
    global $connection;
if(isset($_POST['publish_post']))
{
    $post_title = $_POST['post-title'];
    $post_category_id = $_POST['post-category'];
    $post_author = $_POST['post-author'];
    $post_status = $_POST['post-status'];
    $post_image = $_FILES['post-image']['name'];
    $post_image_temp = $_FILES['post-image']['tmp_name'];
    $post_tags = $_POST['post-tag'];
    $post_content = $_POST['post-content'];
    $post_date = date('d-m-y');

    move_uploaded_file($post_image_temp,"../images/$post_image");

    $query = "INSERT INTO posts (post_category_id , post_title , post_user , post_date , post_image , post_content , post_status , post_tags) VALUES ('{$post_category_id}','{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_status}','{$post_tags}')";
    $result = mysqli_query($connection,$query);

    if(!$result)
    {
      die('Unable to upload the post'.mysqli_error($result));
    }else{
      errorMsg('warning','Post added successfully');
    }
}

}

function viewAllPost()
{
    global $connection;
    $query = "SELECT * FROM posts";
        $results = mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($results))
        {
            $post_id = $row['post_id'];
            echo "
            <tr>
            <td><input name='selectArray[]' class='check-box' value='{$post_id}' type='checkbox'></td>
            <td>{$post_id}</td>
            <td>{$row['post_user']}</td>";

            $query = "SELECT * FROM categories WHERE id = {$row['post_category_id']}";
            $response = mysqli_query($connection,$query);
            while($newRow = mysqli_fetch_assoc($response))
            {
                $id = $newRow['id'];
                $category_title = $newRow['category_title'];
                echo "<td><a href='../category_searched.php?category=$id'>{$category_title}</a></td>";
            }

           echo "
            <td><a href='../individual_post.php?post_id=$post_id'>{$row['post_title']}</a></td>
            <td>{$row['post_date']}</td>
            <td>{$row['post_comment_count']}</td>
            <td><a href='../individual_post.php?post_id=$post_id'><img src='../images/{$row['post_image']}' width='100' height='50'/></a></td>
            <td>{$row['post_tags']}</td>
            <td>{$row['post_status']}</td>
            <td class='text-center'><a class='alert-link conform' href='posts.php?delete={$post_id}'><button class='btn btn-info'><i class='fa fa-trash text-white' aria-hidden='true'></i></button></a></td>
            <td class='text-center'><a class='alert-link' href='posts.php?q=edit_post&post_id={$post_id}'><button class='btn btn-success'><i class='fa fa-edit text-white' aria-hidden='true'></i></button></a></td>
            </tr>
            ";
        }
        if(!$results)
        {
            die("Error");
        }
}


function selectBox($checkBoxArray)
{
    global $connection;
    
    foreach ($checkBoxArray as $post_id) {
        $bulkApply = $_POST['bulk_options'];
        
        switch($bulkApply)
        {
            case 'Draft':
                $query = "UPDATE posts SET post_status = 'Draft' WHERE post_id = '{$post_id}'";
                $result = mysqli_query($connection,$query); 
            break;
            case 'Publish':
                $query = "UPDATE posts SET post_status = 'Published' WHERE post_id = '{$post_id}'";
                $result = mysqli_query($connection,$query);
            break;
            case 'Delete':
                $query = "DELETE FROM posts WHERE post_id = '{$post_id}'";
                $result = mysqli_query($connection,$query);
            break;
            case 'Clone':
                $query = "SELECT * FROM posts WHERE post_id = '{$post_id}'";
                $result = mysqli_query($connection,$query);

                while($row = mysqli_fetch_array($result))
                {
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_author = $row['post_user'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_content = $row['post_content'];
                    $post_date = date('d-m-y');
                }
                $query = "INSERT INTO posts (post_category_id , post_title , post_user , post_date , post_image , post_content , post_status , post_tags) VALUES ('{$post_category_id}','{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_status}','{$post_tags}')";
                $result = mysqli_query($connection,$query);
            break;
        }
        
    }
    if($result)
    {
        errorMsg("danger","Done");
    }else{
        die("Error");
    }
}


function updatePost($post_id)
{
    global $connection;
        if(isset($_POST['update_post']))
        {
            $post_title = $_POST['post-title'];
            $post_category_id = $_POST['post-category'];
            $post_author = $_POST['post-author'];
            $post_status = $_POST['post-status'];
            $post_image = $_FILES['post-image']['name'];
            $post_image_temp = $_FILES['post-image']['tmp_name'];
            $post_tags = $_POST['post-tag'];
            $post_content = $_POST['post-content'];
            $post_date = date('d-m-y');
        
            move_uploaded_file($post_image_temp,"../images/$post_image");

            if(empty($post_image))
            {
            $query = "SELECT * FROM posts WHERE post_id = '{$post_id}'";
            $results = mysqli_query($connection,$query);
            while($row = mysqli_fetch_assoc($results))
            {
                $post_image = $row['post_image'];
            }
            }

        $query = "UPDATE posts SET post_title = '{$post_title}' , post_category_id = '{$post_category_id}' ,post_user = '{$post_author}' ,post_status = '{$post_status}' ,post_image = '{$post_image}' ,post_tags = '{$post_tags}' ,post_content = '{$post_content}' ,post_date = now() WHERE post_id = '{$post_id}' ";

        $result = mysqli_query($connection,$query);
        if(!$result)
        {
            die("Query failed".mysqli_error($result));
        }else{
            header("Location:posts.php?q=view_all_posts");
        }
        }
        
}

function viewAllComments()
{
    global $connection;
    $query = "SELECT * FROM comments";
        $results = mysqli_query($connection,$query);

        while($row = mysqli_fetch_assoc($results))
        {
            $comment_id = $row['comment_id'];
            $comment_author = $row['comment_author'];
            $comment_date = $row['comment_date'];
            $comment_status = $row['comment_status'];
            $comment_post_id = $row['comment_post_id'];
            $comment = $row['comment_content'];

            echo "
            <tr>
            <td>{$comment_id}</td>
            <td>{$comment_author}</td>
            <td>{$comment_date}</td>";

            $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
            $response = mysqli_query($connection,$query);
            while($row = mysqli_fetch_assoc($response))
            {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                echo "<td><a href='../individual_post.php?post_id=$post_id'>{$post_title}</a></td>";
            }


            echo
            "<td>{$comment}</td>
            <td>{$comment_status}</td>
            <td class='text-center'><button class='btn btn-success'><a class='alert-link text-warning' href='comments.php?approve=$comment_id&post_id=$post_id'><i class='fa fa-check' aria-hidden='true'></i></a></button></td>
            <td class='text-center'><button class='btn btn-warning'><a class='alert-link text-primary' href='comments.php?deney=$comment_id&post_id=$post_id'><i class='fa fa-times' aria-hidden='true'></i></a></button></td>
            <td class='text-center'><button class='btn btn-info'><a class='alert-link text-danger' href='comments.php?delete=$comment_id&post_id=$post_id'><i class='fa fa-trash' aria-hidden='true'></i></a></button></td>
            </tr>
            ";
        }
}

function deleteComment()
{
        global $connection;
        if(isset($_GET['delete']))
    {
    $query = "DELETE FROM comments WHERE comment_id = {$_GET['delete']}";
    $result = mysqli_query($connection,$query);
    decreaseCommentCount($_GET['post_id']);
    if($result)
    {
        errorMsg('danger','Post deleted successfully');
    }
    }
}

function decreaseCommentCount($post_id)
{
    global $connection;
    $query = "UPDATE posts SET  post_comment_count = post_comment_count - 1 WHERE post_id = '$post_id'";
    $result = mysqli_query($connection,$query);
    if(!$result)
    {
        die("error:".mysqli_error($result));
    }
}

function increaseCommentCount($post_id)
{
    global $connection;
    
    $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = '{$post_id}'";
    $result = mysqli_query($connection,$query);
    if(!$result)
    {
        die("error".mysqli_error($result));
    }
}

function approveComment()
{
        global $connection;
        if(isset($_GET['approve']))
    {
    $query = "SELECT * FROM comments WHERE comment_id =  {$_GET['approve']}";
    $result = mysqli_query($connection,$query);
    $row = mysqli_fetch_assoc($result);
    if($row['comment_status'] == 'Approved')
    {
        errorMsg('warning','Post approved already');
    }else{
        $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = {$_GET['approve']}";
        $result = mysqli_query($connection,$query);
        increaseCommentCount($_GET['post_id']);
        if($result)
    {
        errorMsg('success','Post approved successfully');
    }
    }

    }
}

function deneyComment()
{
        global $connection;
        if(isset($_GET['deney']))
    {
        $query = "SELECT * FROM comments WHERE comment_id =  {$_GET['deney']}";
        $result = mysqli_query($connection,$query);
        $row = mysqli_fetch_assoc($result);
        if($row['comment_status'] == 'Denaided')
        {
            errorMsg('warning','Post denaied already');
        }else{
            $query = "UPDATE comments SET comment_status = 'Denaided' WHERE comment_id = {$_GET['deney']}";
            $result = mysqli_query($connection,$query);
            decreaseCommentCount($_GET['post_id']);
            if($result)
            {
                errorMsg('danger','Post denaied successfully');
            }
        }
    }
}

function addUser()
{
    global $connection;
if(isset($_POST['add_user']))
{
    $username = $_POST['username'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $user_image =time(). '_' .$_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    move_uploaded_file($user_image_temp,"../images/$user_image");

    if(empty($username) ||empty($user_firstname) || empty($user_role) || empty($user_email) || empty($user_password))
    {
        die('Not all fields are filled properly!'.mysqli_error($connection));
    }

    $query = "INSERT INTO users (username , user_firstname , user_lastname , user_role , user_image , user_email , user_password , user_date) VALUES ('{$username}','{$user_firstname}','{$user_lastname}','{$user_role}','{$user_image}','{$user_email}' , '{$user_password}' , now())";
    $result = mysqli_query($connection,$query);

    if(!$result)
    {
      die('Unable to upload the user'.mysqli_error($result));
    }else{
      errorMsg('warning','User added successfully');
    }
}
}

function viewAllUser()
{
    global $connection;
    $query = "SELECT * FROM users";
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
            $user_date = $row['user_date'];

            echo "
            <tr>
            <td>{$username}</td>
            <td>{$user_firstname}</td>
            <td>{$user_lastname}</td>
            <td>{$user_email}</td>
            <td><a href=''><img src='../images/{$user_image}' width='50' height='50'/></a></td>
            <td>{$user_date}</td>
            <td>{$user_role}</td>
            <td class='text-center'><a class='alert-link' href='users.php?delete={$user_id}'><button class='btn btn-info'><i class='fa fa-trash text-white' aria-hidden='true'></i></button></a></td>
            <td class='text-center'><a class='alert-link' href='users.php?q=edit_user&user_id={$user_id}'><button class='btn btn-success'><i class='fa fa-edit text-white' aria-hidden='true'></i></button></a></td>
            </tr>
            ";
        }
}


function deleteUser()
{
    global $connection;
    if(isset($_GET['delete']))
{
$query = "DELETE FROM users WHERE user_id = {$_GET['delete']}";
$result = mysqli_query($connection,$query);

if($result)
{
    errorMsg('danger','User deleted successfully');
}
}
}

function updateUser($user_id)
{
    global $connection;
        if(isset($_POST['update_user']))
        {
    $username = $_POST['username'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $user_image = time(). '_' .$_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];
    $user_email = $_POST['user_email'];

    if($_FILES['user_image']['size'] <= 0)
    {
        $user_image = "profile.jpg";
    }

    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_email'] = $user_email;
    $_SESSION['username'] = $username;
    $_SESSION['user_role'] = $user_role;

    move_uploaded_file($user_image_temp,"../images/$user_image");

    if(empty($username) ||empty($user_firstname) || empty($user_role) || empty($user_email))
    {
        die('Not all fields ever filled properly!'.mysqli_error($connection));
    }

            if(empty($user_image))
            {
            $query = "SELECT * FROM users WHERE user_id = '{$user_id}'";
            $results = mysqli_query($connection,$query);
            while($row = mysqli_fetch_assoc($results))
            {
                $user_image = $row['user_image'];
            }
            }

        $query = "UPDATE users SET username = '{$username}' , user_firstname = '{$user_firstname}' ,user_lastname = '{$user_lastname}' ,user_email = '{$user_email}' ,user_image = '{$user_image}' ,user_role = '{$user_role}' WHERE user_id = '{$user_id}' ";

        $result = mysqli_query($connection,$query);
        if(!$result)
        {
            die("Query failed".mysqli_error($result));
        }else{
            header("Location:users.php?q=view_all_users");
        }
        }
}


function chartValues()
{
    global $connection;

            $query = "SELECT * FROM posts";
            $result = mysqli_query($connection,$query);
            $total_post =  mysqli_num_rows($result);

            $query = "SELECT * FROM posts WHERE post_status = 'Published'";
            $result = mysqli_query($connection,$query);
            $total_post_published =  mysqli_num_rows($result);

            $query = "SELECT * FROM posts WHERE post_status = 'Draft'";
            $result = mysqli_query($connection,$query);
            $total_post_in_draft =  mysqli_num_rows($result);

            $query = "SELECT * FROM categories";
            $result = mysqli_query($connection,$query);
            $total_categories =  mysqli_num_rows($result);

            $query = "SELECT * FROM comments";
            $result = mysqli_query($connection,$query);
            $total_comments =  mysqli_num_rows($result);

            $query = "SELECT * FROM comments WHERE comment_status = 'Approved'";
            $result = mysqli_query($connection,$query);
            $total_comments_approved =  mysqli_num_rows($result);

            $query = "SELECT * FROM comments WHERE comment_status = 'Denaided'";
            $result = mysqli_query($connection,$query);
            $total_comments_denaided =  mysqli_num_rows($result);

            $query = "SELECT * FROM users";
            $result = mysqli_query($connection,$query);
            $total_users =  mysqli_num_rows($result);

            $query = "SELECT * FROM users WHERE user_role = 'Admin'";
            $result = mysqli_query($connection,$query);
            $total_admins =  mysqli_num_rows($result);

            $query = "SELECT * FROM users WHERE user_role = 'Subscriber'";
            $result = mysqli_query($connection,$query);
            $total_subscribers =  mysqli_num_rows($result);
                                    
            return [$total_post , $total_post_published , $total_post_in_draft , $total_categories , $total_comments , $total_comments_approved , $total_comments_denaided , $total_users , $total_admins , $total_subscribers];
}






