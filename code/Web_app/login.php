<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="author" content="Group-32, Fall 2021">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>JOBIFY - Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <link rel="stylesheet" href="css/styles.css">
</head>

<?php
session_start();
if (isset($_SESSION['user'])) {
  header('Location: home.php');
}
include "connectDB.php";
if (isset($_POST['submit'])) {
  if ($_POST['inputEmail'] === "") {
    echo '<div class="alert alert-danger text-center small-box">Email is required</div>';
  } elseif ($_POST['inputEmail'] === "" || $_POST['password'] === "") {
    echo '<div class="alert alert-danger text-center small-box">Password is required</div>';
  } elseif (!filter_var($_POST['inputEmail'], FILTER_VALIDATE_EMAIL)) {
    echo '<div class="alert alert-danger text-center small-box">Invalid email format</div>';
  } else {
    $inputEmail = $_POST['inputEmail'];
    $sql = "SELECT user_pwd FROM user_master WHERE user_email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $inputEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
      $row = $result->fetch_assoc();
      $checkPwd = password_verify($_POST['password'], $row["user_pwd"]);
      if ($checkPwd) {
        $_SESSION['user'] = $inputEmail;
        header('Location: home.php');
        exit();
      } else {
        echo '<div class="alert alert-danger text-center small-box">Wrong password</div>';
      }
    } else {
      echo '<div class="alert alert-danger text-center small-box">User not found</div>';
    }
  }
  $conn->close();
}
?>

<body>
  <div class="bg">
    <section class="h-100">
      <div class="container h-100">
        <div class="row justify-content-sm-center h-100">
          <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
            <div class="text-center my-5">
              <img src="logos.jpg" alt="logo">
            </div>
            <div class="card shadow-lg">
              <div class="card-body p-5">
                <h1 class="fs-4 card-title fw-bold mb-4">Login</h1>
                <form method="POST" action="" class="needs-validation" novalidate="" autocomplete="off">
                  <div class="mb-3">
                    <label class="mb-2 text-muted" for="inputEmail">E-Mail Address</label>
                    <input type="email" id="inputEmail" class="form-control" name="inputEmail"
                      placeholder="Enter your email address" value="" required autofocus>
                    <div class="invalid-feedback"> Email is invalid </div>
                  </div>

                  <div class="mb-3">
                    <div class="mb-2 w-100">
                      <label class="mb-2 text-muted" for="inputLocation">Password</label>
                      <a href="forgot.php" class="float-end"> Forgot Password? </a>
                    </div>
                    <input id="password" type="password" name="password" class="form-control"
                      placeholder="Enter your Password" required>
                    <div class="invalid-feedback"> Password is required </div>
                  </div>

                  <div class="d-flex align-items-center">
                    <button type="submit" name="submit" class="btn btn-primary ms-auto"> Login </button>
                  </div>
              </div>
              </form>
              <?php
              if (isset($_POST['submit']) && ($_POST['inputEmail'] != "") && ($_POST['password'] != "")) {
                $sql = "SELECT user_pwd FROM user_master where user_email='" . $_POST['inputEmail'] . "'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $len = $result->num_rows;
                $checkPwd = password_verify($_POST['password'], $row["user_pwd"]);
                if (($len == 1) && ($checkPwd)) {
                  $_SESSION['user'] = $_POST['inputEmail'];
                  header('Location: home.php');
                } else {
                  echo '<span class="text-center" style="color:#FF0000"> Invalid Email/Password </span><br/>';
                }
                $conn->close();
              }
              ?>
              <div class="card-footer py-3 border-0">
                <div class="text-center">
                  Don't have an account? <a href="signup.php" class="text-dark">Create One</a>
                </div>
              </div>
            </div>
            <!-- Here, we add a link to a useful resource for job searches-->
            <!-- <div class="container h-100">
    <div class="row justify-content-sm-center h-100">
        <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
            <h1 class="text-center">Job Search Was Never This Easy!</h1>
            <h4 class="text-center"> Wake up to email updates about your Dream Job.</h4>
            <div class="embed-responsive embed-responsive-16by9"><iframe width="560" height="315" src="https://www.youtube.com/embed/guXxy8LH2QM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
        </div>
    </div>
</div> -->
            <br>
            <div align="center">Made with <span style="color: #e25555;">&hearts;</span>. Contribute on <a
                href="https://github.com/sak007/SRIJAS" class="text-dark" target="_blank">GitHub</a>.</div>
            <br>
          </div>
          <script>
            var showPasswordCheckbox = document.getElementById("showPassword");
            var passwordInput = document.getElementById("password");

            showPasswordCheckbox.addEventListener("change", function () {
              if (showPasswordCheckbox.checked) {
                passwordInput.type = "text";
              } else {
                passwordInput.type = "password";
              }
            });
          </script>
</body>

</html>