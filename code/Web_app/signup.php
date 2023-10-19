<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="author" content="Group-32, Fall 2021">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>JOBIFY - Signup</title>
  <?php
  /**
   * This segment of code is responsible for loading entries from the job_master
   * table and putting them into the drop-down in the form
   * @var object paramsFile and
   * @var params associative array(string) extracts content from parameters.json
   * @var skill_ids array(int) stores the IDs of the job_master table entries
   * @var skill_array array(string) stores the titles of the job_master table entries.
   */
  $paramsFile = file_get_contents("parameters.json");
  $params = json_decode($paramsFile, true);
  $cities = array("Austin, Texas", "Dallas, Texas", "Raleigh, North Carolina", "San Jose, California", "Charlotte, North Carolina", "Seattle, Washington", "San Francisco, California", "Atlanta, Georgia", "Huntsville, Alabama", "Denver, Colorado", "Washington, DC", "Boulder, Colorado", "Durham-Chapel Hill, North Carolina", "Columbus, Ohio", "Colorado Springs, Colorado", "Boston, Massachusetts", "Baltimore, Maryland", "Madison, Wisconsin", "San Diego, California", "Trenton, New Jersey");
  /**
   * @var servername string and
   * @var username string and
   * @var password string and
   * @var db string variables store the connection parameters for $conn
   */
  $servername = $params["server_name"];
  $username = $params["user_name"];
  $password = $params["password"];
  $db = $params["db_name"];

  $conn = new mysqli($servername, $username, $password, $db);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $sql = "SELECT * FROM job_master";
  $result = $conn->query($sql);
  $skill_array = array();
  $skill_ids = array();
  $len = $result->num_rows;
  if ($len > 0) {
    while ($row = $result->fetch_assoc()) {
      array_push($skill_array, $row["job_title"]);
      array_push($skill_ids, $row["job_id"]);
    }
  }
  $conn->close();
  ?>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>
  <div class="bg">
    <section class="h-100">
      <div class="container h-100">
        <div class="row justify-content-sm-center h-100">
          <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
            <div class="text-center my-5">
              <img src="logos.jpg" alt="logo">
              <!-- <img src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="logo" width="100"> -->
              <!-- <h2 class="display-4 font-weight-bold" style="font-size:15px;display:inline-block">S.R.I.J.A.S. (Smart Resume Interpreter And Job Alerts System)</h2> -->
            </div>
            <div class="card shadow-lg">
              <div class="card-body p-5">
                <h1 class="fs-4 card-title fw-bold mb-4">Register</h1>
                <form method="POST" class="needs-validation" novalidate="" autocomplete="off"
                  enctype="multipart/form-data" action="registerUser.php">

                  <div class="mb-3">
                    <label class="mb-2 text-muted" for="inputName">Name</label>
                    <input id="inputName" type="text" class="form-control" name="inputName"
                      placeholder="Enter your Name" value="" required autofocus>
                    <div class="invalid-feedback"> Name is required </div>
                  </div>

                  <div class="mb-3">
                    <label class="mb-2 text-muted" for="inputEmail">E-Mail Address</label>
                    <input id="inputEmail" type="email" class="form-control" name="inputEmail"
                      placeholder="Enter your email address" value="" required>
                    <div class="invalid-feedback"> Email is Invalid </div>
                  </div>

                  <div class="mb-3">
                    <label class="mb-2 text-muted" for="inputLocation">Password</label>
                    <input id="password" type="password" class="form-control" name="password"
                      placeholder="Enter your Password" required>
                    <div class="input-group-append">
                      <button type="button" class="btn btn-link" id="showPasswordToggle"
                        onclick="togglePasswordVisibility()">
                        <i class="far fa-eye" id="eyeIcon"></i>
                      </button>
                    </div>
                    <div class="invalid-feedback"> Password is required </div>
                  </div>

                  <div class="mb-3">
                    <label class="mb-2 text-muted" for="inputLocation">Location</label>
                    <select class="custom-select mr-sm-2 form-control" id="location" name="location" required>
                      <option selected>Select City...</option>
                      <?php
                      $count = 0;
                      foreach ($cities as $city) {
                        echo "<option value='" . explode(",", $city)[0] . "'>" . $city . "</option>";
                        $count = $count + 1;
                      }
                      ?>
                    </select>
                    <div class="invalid-feedback"> Location is required </div>
                  </div>

                  <div class="mb-3">
                    <label class="mb-2 text-muted" for="inputJobTypeId">Job you're looking for </label>
                    <select class="custom-select mr-sm-2 form-control" id="inputJobTypeId" name="inputJobTypeId"
                      required>
                      <option selected>Choose...</option>
                      <?php
                      $count = 0;
                      foreach ($skill_array as $skill) {
                        echo "<option value='" . $skill_ids[$count] . "'>" . $skill . "</option>";
                        $count = $count + 1;
                      }
                      ?>
                    </select>
                  </div>

                  <div class="mb-3">
                    <label class="mb-2 text-muted" for="uploadResume">Upload Your Resume</label>
                    <input type="file" class="form-control-file" id="uploadResume" name="uploadResume" required>
                  </div>

                  <div class="align-items-center d-flex">
                    <button type="submit" value="Submit" id="submit" name="submit" class="btn btn-primary ms-auto">
                      Register </button>
                  </div>
                </form>
              </div>
              <div class="card-footer py-3 border-0">
                <div class="text-center"> Already have an account? <a href="login.php" class="text-dark">Login</a>
                </div>
              </div>
            </div>
            <br>
            <div align="center">Made with <span style="color: #e25555;">&hearts;</span>. Contribute on <a
                href="https://github.com/sak007/SRIJAS" class="text-dark" target="_blank">GitHub</a>.</div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <script>
    function validateForm() {
      const name = document.getElementById('inputName').value.trim();
      const email = document.getElementById('inputEmail').value.trim();
      const password = document.getElementById('password').value;
      const location = document.getElementById('location').value;
      const jobType = document.getElementById('inputJobTypeId').value;
      const resume = document.getElementById('uploadResume').value;
      const resumeExtension = resume.slice(((resume.lastIndexOf(".") - 1) >>> 0) + 2);


      const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
      const passwordPattern = /^(?=.\d)(?=.[a-zA-Z]).{8,}$/; // At least 8 characters with 1 number and 1 alphanumeric character

      document.getElementById('inputName').classList.remove('is-invalid');
      document.getElementById('inputEmail').classList.remove('is-invalid');
      document.getElementById('password').classList.remove('is-invalid');
      document.getElementById('location').classList.remove('is-invalid');
      document.getElementById('inputJobTypeId').classList.remove('is-invalid');
      document.getElementById('uploadResume').classList.remove('is-invalid');

      if (name === '') {
        document.getElementById('inputName').classList.add('is-invalid');
        return false;
      }

      if (!passwordPattern.test(password)) {
        document.getElementById('password').classList.add('is-invalid');
        alert('Password must be at least 8 characters with at least 1 number and 1 alphanumeric character.');
        return false;
      }

      if (!emailPattern.test(email)) {
        document.getElementById('inputEmail').classList.add('is-invalid');
        return false;
      }
      if (location === 'Select City...') {
        document.getElementById('location').classList.add('is-invalid');
        alert('Location is required');
        return false;
      }
      if (jobType === 'Choose...') {
        document.getElementById('inputJobTypeId').classList.add('is-invalid');
        alert('Job Type is required');
        return false;
      }
      if (resume === '') {
        document.getElementById('uploadResume').classList.add('is-invalid');
        alert('Resume is required');
        return false;
      }

      if (resumeExtension.toLowerCase() !== 'pdf') {
        document.getElementById('uploadResume').classList.add('is-invalid');
        alert('Resume should be in PDF format.');
        return false;
      }


      return true;
    }

    function togglePasswordVisibility() {
      const passwordField = document.getElementById('password');
      const eyeIcon = document.getElementById('eyeIcon');

      if (passwordField.type === 'password') {
        passwordField.type = 'text';
        eyeIcon.classList.remove('far', 'fa-eye');
        eyeIcon.classList.add('far', 'fa-eye-slash');
      } else {
        passwordField.type = 'password';
        eyeIcon.classList.remove('far', 'fa-eye-slash');
        eyeIcon.classList.add('far', 'fa-eye');
      }
    }

  </script>
</body>

</html>