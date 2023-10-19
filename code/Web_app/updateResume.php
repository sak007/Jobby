<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="author" content="Group-32, Fall 2021">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>JOBIFY - Update Resume</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <link rel="stylesheet" href="css/styles.css">
</head>
<?php
session_start();
if (!isset($_SESSION['user'])) {
  header('Location: login.php');
}
include "connectDB.php";
?>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
  <div class="header">
    <img src="logo.jpg" alt="logo">
    <div class="header-right">
      <a href="home.php">Home</a>
      <a href="register.php">Job Board</a>
      <a class="active" href="updateResume.php">Upload Resume</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>
</body>

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
                <h1 class="fs-4 card-title fw-bold mb-4">Update your Resume</h1>
                <form method="POST" action="" enctype="multipart/form-data" class="needs-validation" novalidate=""
                  autocomplete="off">
                  <?php
                  $user_email = $_SESSION['user'];
                  $userNameQuery = "select um.user_fname, um.user_lname from user_master um where um.user_email = '" . $user_email . "'";
                  $userNameResult = $conn->query($userNameQuery);
                  $namearray = array();
                  while ($row = $userNameResult->fetch_assoc()) {
                    array_push($namearray, $row["user_fname"]);
                    array_push($namearray, $row["user_lname"]);
                  }
                  echo "<td width='80' style='text-align:center;'>";
                  echo "<b>First Name</b>\t\t\t&emsp;" . ucfirst($namearray[0]) . "<br>";
                  echo "<b>Last Name</b>\t\t\t&emsp;" . ucfirst($namearray[1]) . "<br>";
                  echo "<b>User Email</b>\t\t\t&emsp;", $user_email;
                  echo "</td>";
                  ?>
                  <br>
                  <br>
                  <div class="mb-3">
                    <label class="mb-2 text-muted" for="uploadResume">Upload your New Resume</label>
                    <input type="file" class="form-control-file" id="uploadResume" name="uploadResume" required>
                  </div>

                  <div class="align-items-center d-flex">
                    <button type="submit" value="Submit" id="submit" name="submit" class="btn btn-primary ms-auto">
                      Update </button>
                  </div>
                </form>
                <!-- /*
                    $query = "update resume_master set resume_json = where resume_id = ( select resume_id from user_resume where user_id = (select user_id from user_master where user_email = '".$user_email."'))";
                    $conn -> query($query);
                  }
                  header('Location: home.php');
                */ -->
                <?php
                ob_start();
                if (isset($_POST['submit'])) {
                  include 'vendor/autoload.php';
                  var_dump($_FILES);
                  $target_dir = "uploads/";
                  $target_file = $target_dir . basename($_FILES['uploadResume']['name']);
                  $uploadOk = 1;
                  $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                  if ($fileType != "pdf") {
                    echo "Sorry, only PDF Files allowed";
                    $uploadOk = 0;
                  }
                  if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                  } else {
                    if (move_uploaded_file($_FILES["uploadResume"]["tmp_name"], $target_file)) {
                      echo "The file " . htmlspecialchars(basename($_FILES["uploadResume"]["name"])) . " has been uploaded.";
                    } else {
                      echo "Sorry, there was an error uploading your file.";
                    }
                  }

                  $parser = new \Smalot\PdfParser\Parser();
                  $pdf = $parser->parseFile($target_file);
                  $text = $pdf->getText();
                  $text = preg_replace('/\s+/', '', $text);
                  $text = strtolower($text);
                  $sqlstmt = "update resume_master set resume_json = (?) where resume_id = ( select resume_id from user_resume where user_id = (select user_id from user_master where user_email = '" . $user_email . "'))";
                  $stmt = $conn->prepare($sqlstmt);

                  $stmt->bind_param("s", $text);
                  if ($stmt->execute()) {
                    echo "Resume added successfully";
                  } else {
                    echo "Could not add the resume";
                  }
                  $stmt->close();
                  $conn->close();
                  ob_end_clean();
                  sleep(2);
                  header('Location: home.php');
                }
                ?>
</body>

</html>