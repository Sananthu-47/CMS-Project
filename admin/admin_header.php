
<?php ob_start(); ?>
<?php session_start(); ?>
<?php include "../includes/db.php"; ?>
<?php include "functions.php"; ?>

<?php 

if($_SESSION['user_role']!=='Admin')
{
  header('Location: ../index.php');
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel</title> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />

    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
    <div id="wrapper">
      <!-- Main heading nav -->
    <nav class="navbar  navbar-light bg-dark d-flex justify-content-between">
    <div class="d-flex mb-2">
  <span class='badge badge-info'><a class="navbar-brand" href="../index.php">CMS project</a></span>
  </div>
    
    <div class="dropdown ">
  <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fa fa-user m-1"></i> <?php echo  $_SESSION['username']; ?>
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="#"><i class="fa fa-envelope"></i> Email</a>
    <a class="dropdown-item" href="#"><i class="fa fa-cog"></i> Settings</a>
    <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
  </div>
</div>

</nav>

<div class="d-lg-none bg-light">
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="fa fa-bars"></span>
</button>
</div>
