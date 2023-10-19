<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="author" content="Group-32, Fall 2021">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>JOBIFY- Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <link rel="stylesheet" href="css/header.css">
</head>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

  <div class="header">
    <img src="logos.jpg" alt="logo">
    <div class="header-right">
      <a class="active" href="home.php">Home</a>
      <a href="register.php">Job Board</a>
      <a href="updateResume.php">Upload Resume</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>

</body>
<?php
session_start();
if (!isset($_SESSION['user'])) {
  header('Location: login.php');
}
include "connectDB.php";
$user_email = $_SESSION['user'];
$user = $user_email;
// echo "User Job Boards";
$userJbQuery = "select jb.name, jb.job_board_id from job_board jb, user_notification un, user_master um where jb.job_board_id = un.job_board_id and un.user_id = um.user_id and um.user_email = '" . $user_email . "'";
$userJbResult = $conn->query($userJbQuery);
$job_board_array = array();
$job_board_ids = array();
while ($row = $userJbResult->fetch_assoc()) {
  array_push($job_board_array, $row["name"]);
  array_push($job_board_ids, $row["job_board_id"]);
  // echo $job_board_array[0];
  // echo "<br>";
}
?>

<body>
  <div class="bg">
    <section class="h-100">
      <div class="container h-100">
        <div class="row justify-content-sm-center h-100">
          <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
            <div class="text-center my-5">
            </div>

            <div class="card shadow-lg">
              <div class="card-body p-5">
                <h1 class="fs-4 card-title fw-bold mb-4">Welcome to Jobify!</h1>
                <form method="POST" action="" enctype="multipart/form-data" class="needs-validation" novalidate=""
                  autocomplete="off">
                  <?php

                  // Get User Details from the database
                  $user_email = $_SESSION['user'];
                  $userNameQuery = "select um.user_fname, um.user_lname from user_master um where um.user_email = '" . $user_email . "'";
                  $userNameResult = $conn->query($userNameQuery);
                  $namearray = array();

                  while ($row = $userNameResult->fetch_assoc()) {
                    array_push($namearray, $row["user_fname"]);
                    array_push($namearray, $row["user_lname"]);
                  }

                  // Display User Details
                  // Display User Details
                  echo "<td width='80' style='text-align:center;'>";
                  echo "<b>Name</b> &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;" . ucfirst($namearray[0]) . "<br>";
                  echo "<b>User Email</b>\t\t\t&emsp;", $user_email;
                  echo "</td>";

                  ?>
                  <br>
                  <br>
                  <div class="mb-3">
                    <!-- Button for updating resume -->
                    <input type="button" value="Update Resume" class="btn btn-primary ms-auto" id="btnUpdateResume"
                      onClick="document.location.href='/updateResume.php'" />
                    <!-- Button for Delete Account -->
                    <input type="button" value="Delete Account" class="btn btn-primary ms-auto" id="btnDeleteAccount"
                      onClick="document.location.href='/deleteAccount.php'" />
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <br>

        <br>
      </div>
    </section>
  </div>
</body>

</html>