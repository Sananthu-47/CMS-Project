<?php include "include_functions.php"; ?>
<?php ob_start(); ?>
<?php session_start(); ?>
<?php include "../includes/db.php"; ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />
    <link rel="stylesheet" href="../admin/assets/css/style.css">

    <title>CMS Project</title>
  </head>
  <body>
  <div class="container-fluid">

<nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
    <div class="container">
    <a class="navbar-brand" href="../index.php"><button class="btn btn-primary">CMS project</button></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item mx-2">
                <a class="nav-link h5" href="login.php">Login</a>
            </li>
            <li class="nav-item badge badge-info">
                <a class="nav-link active h6" href="#">Register</a>
            </li>
        </ul>

    </div>
    </div>
</nav>

<?php 
 $msg = '';
 $alertCls = '';
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
         
         $query = "SELECT user_salt FROM users WHERE user_email = '{$user_email}'";
         $result = mysqli_query($connection,$query);

         if(!$result)
         {
             die("Couldn't find the salt".mysqli_error($result));
         }

         $row = mysqli_fetch_assoc($result);
         $user_salt = $row['user_salt'];
         
         $encrypted_password = crypt($user_password,$user_salt);

         if($_FILES['user_image']['size'] <= 0)
         {
             $user_image = "profile.jpg";
         }


         $query = "INSERT INTO users (username , user_firstname , user_lastname , user_role , user_image , user_email , user_password , user_date) VALUES ('{$user_name}','{$user_firstname}','{$user_lastname}','{$user_role}','{$user_image}','{$user_email}' , '{$encrypted_password}' , now())";
         $result = mysqli_query($connection,$query);

         if(!$result)
         {
             die("Error".mysqli_error($result));
         }else{
             $_SESSION['username'] = $user_name;
             header("Location: login.php");
         }
             }

 }else{
     $msg = 'Any of the fields cannot be empty';
     $alertCls = 'alert-danger';
 }

 }
?>

<main class="my-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Register</div>


                <?php if($msg!=='')
                {?>
                    <div class='text-center alert <?php echo $alertCls; ?>'><?php echo $msg; ?></div>
               <?php } ?>


                        <div class="card-body">
                            <form name="my-form" action="" method="post" enctype="multipart/form-data">

                            <div class="form-group row justify-content-center">
                                <div class="col-md-6 d-flex justify-content-center">
                                    <input name="user_image" class='d-none' onchange="displayImage(this)" type="file" id="image" ><br/>
                                    <img src="../images/profile.jpg" id="preview" alt="">
                                </div>
                            </div>
                                
                            <div class="form-group row">
                                    <label for="first_name" class="col-md-4 col-form-label text-md-right">First Name</label>
                                    <div class="col-md-6">
                                        <input type="text" id="first_name" placeholder="First Name" class="form-control border" name="firstName" value="<?php if(isset($user_firstname)){
                                            echo $user_firstname;
                                        } ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name</label>
                                    <div class="col-md-6">
                                        <input type="text" id="last_name" placeholder="Last Name" class="form-control border" name="lastName" value="<?php if(isset($user_lastname)){
                                            echo $user_lastname;
                                        } ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="user_name" class="col-md-4 col-form-label text-md-right">Username</label>
                                    <div class="col-md-6">
                                        <input type="text" id="user_name" placeholder="Username" class="form-control border" name="username" value="<?php if(isset($user_name)){
                                            echo $user_name;
                                        } ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="user_email" class="col-md-4 col-form-label text-md-right">Email</label>
                                    <div class="col-md-6">
                                        <input type="email" id="user_email" placeholder="Email" class="form-control border" name="userEmail" value="<?php if(isset($user_email)){
                                            echo $user_email;
                                        } ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="user_password" class="col-md-4 col-form-label text-md-right">New password</label>
                                    <div class="col-md-6">
                                        <input type="password" placeholder="New Password" onKeyup="checker(this.value)" id="user_password" class="form-control border" name="userPassword">
                                    <div class="row bg-light m-2 text-danger" id="length"><i class="fa fa-check-circle mr-2  my-1"></i><span>Length Should be minimum 8<span></div>
                                    <div class="row bg-light m-2 text-danger" id="capital"><i class="fa fa-check-circle mr-2  my-1"></i><span>Atleast 1 Capital letter<span></div>
                                    <div class="row bg-light m-2 text-danger" id="lower"><i class="fa fa-check-circle mr-2  my-1"></i><span>Atleast 1 small letter<span></div>
                                    <div class="row bg-light m-2 text-danger" id="digit"><i class="fa fa-check-circle mr-2  my-1"></i><span>Atleast 1 digit<span></div>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="user_conform_password" class="col-md-4 col-form-label text-md-right">Confirm password</label>
                                    <div class="col-md-6">
                                        <input type="password" placeholder="Confirm Password" id="user_conform_password" class="form-control border" name="userConformPassword">
                                    </div>
                                </div>

                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" disabled="true"  name="register" id="register" class="btn btn-primary">
                                        Register
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>

</main>

<script>

let chooseImage = document.getElementById('image');
let imagePlaceholder = document.getElementById('preview');
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
      document.getElementById('preview').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}


function checker(value)
{
    let length = document.getElementById('length');
    let capital = document.getElementById('capital');
    let lower = document.getElementById('lower');
    let digit = document.getElementById('digit');
    let statusNumber = 0;
    

    (value.length>=8) ? success(length) : danger(length);
    value.match(/[A-Z]/)? success(capital) : danger(capital);
    value.match(/[a-z]/)? success(lower) : danger(lower);
    value.match(/[0-9]/)? success(digit) : danger(digit);

    function success(element)
    {
        element.classList.remove('text-danger');
        element.classList.add('text-success');
        statusNumber++;
    }

    function danger(element)
    {
        element.classList.add('text-danger');
        element.classList.remove('text-success');
        statusNumber--;
    }

    if(statusNumber!==4)
    {
        document.getElementById('register').disabled=true;
    }

    if(statusNumber===4)
    {
        document.getElementById('register').disabled=false;
    }
    
}



</script>

<footer class="text-white h4 text-center bg-secondary p-3">

          &copy;copyright reserved by Ananthu SV 

</footer>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

  </body>
</html>
