<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="author" content="Group-32, Fall 2021">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>JOBBY - Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
</head>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<div class="header">
 <img src="logo.jpg" alt="logo">
 <div class="header-right">
   <a href="home.php">Home</a>
   <a class="active" href="register.php">Job Board</a>
   <a href="updateResume.php">Upload Resume</a>
   <a href="logout.php">Logout</a>
 </div>
</div>

</body>
<?php
  session_start();
  if(!isset($_SESSION['user'])){
      header('Location: login.php');
  }
 include "connectDB.php";
  $user_email = $_SESSION['user'];
  $user = $user_email;
  $userJbQuery = "select name from job_board";
  $userJbResult = $conn -> query($userJbQuery);
  $job_board_array = array();
  while ($row = $userJbResult -> fetch_assoc()) {
    array_push($job_board_array, $row["name"]);
  }
  $userJbSelectedQuery = "select name from job_board where job_board_id in (select un.job_board_id from user_notification un, user_master um where un.user_id = um.user_id and user_email = '".$user_email."')";
  $userJbselectedResult = $conn -> query($userJbSelectedQuery);
  $job_board_selected_array = array();
  while ($row = $userJbselectedResult -> fetch_assoc()) {
    array_push($job_board_selected_array, $row["name"]);
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
              <h1 class="fs-4 card-title fw-bold mb-4">Register For Job Boards</h1>
              <div class='mb-3'> Get notified everyday @ 10:30am EST </div>
              <form method="POST" action="" class="needs-validation" novalidate="" autocomplete="off">

                <?php
                foreach($job_board_array as $jb){
                  echo "<div class='mb-3'>";
                  echo "<label class='toggleSwitch' onclick=''>";
                        $inp = "<input name='".$jb."' type='checkbox' value='checked'";
                        if (in_array($jb, $job_board_selected_array)) {
                          $inp = $inp."checked";
                        }
                        $inp = $inp."/>";
                        echo $inp;
                        echo "<span>";
                            echo "<span>OFF</span>";
                            echo "<span>ON</span>";
                            echo $jb;
                        echo "</span>";
                        echo "<a></a>";
                    echo "</label>";
                    echo "</div>";
                }
                ?>
                <div class="d-flex align-items-center">
                  <button type="submit" name="register" class="btn btn-primary ms-auto"> Apply </button>
                  </div>
                </div>
              </form>

            </div>
<br>
<div align="center">Made with <span style="color: #e25555;">&hearts;</span>. Contribute on <a href="https://github.com/sak007/SRIJAS" class="text-dark" target="_blank">GitHub</a>.</div>
<br>
</div>
<?php
if (isset($_POST['register'])) {
  foreach($job_board_array as $jb){
    if (isset($_POST[$jb])) {
      $getUserId = "(select user_id from user_master where user_email = '".$_SESSION['user']."')";
      $getJobId = "(select job_board_id from job_board where name = '".$jb."')";
      $sql = "Insert into user_notification values(".$getUserId.",".$getJobId.")";
      $result = $conn->query($sql);
    } else {
      $getUserId = "(select user_id from user_master where user_email = '".$_SESSION['user']."')";
      $getJobId = "(select job_board_id from job_board where name = '".$jb."')";
      $sql = "Delete from user_notification where user_id=".$getUserId." and job_board_id=".$getJobId;
      $result = $conn->query($sql);
    }
  }
  header('Location: home.php');
}
?>
</body>
</html>
