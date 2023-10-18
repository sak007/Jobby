<?php
  session_start();
  if(isset($_SESSION['user'])){
    include "connectDB.php";
    $user_email = $_SESSION['user'];
    $query = "delete from resume_master where resume_id = ( select resume_id from user_resume where user_id = (select user_id from user_master where user_email = '".$user_email."'))";
    $conn -> query($query);
    $query = "delete from user_master where user_email = '".$user_email."'";
    $conn -> query($query);
  }
  header('Location: logout.php');
