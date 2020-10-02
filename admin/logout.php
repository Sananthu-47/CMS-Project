<?php session_start();

session_destroy();
// $_SESSION['username'] = null;
// $_SESSION['user_role'] = null;

header('Location: ../index.php');