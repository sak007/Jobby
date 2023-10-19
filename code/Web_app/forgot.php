<?php session_start() ?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="styles.css">

    <link rel="icon" href="Favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <title>Login Form</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

        </div>
    </nav>

    <main class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Password Reset</div>
                        <div class="card-body">
                            <form action="#" method="POST" name="recover_psw">
                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail
                                        Address</label>
                                    <div class="col-md-6">
                                        <input type="text" id="email_address" class="form-control" name="email" required
                                            autofocus>
                                    </div>
                                </div>

                                <div class="col-md-6 offset-md-4">
                                    <input type="submit" value="Recover" name="recover">
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </main>
</body>

</html>

<?php
if (isset($_POST["recover"])) {
    include('connectDB.php');
    $email = $_POST["email"];

    $sql = mysqli_query($conn, "SELECT * FROM user_master WHERE user_email='$email'");
    $query = mysqli_num_rows($sql);
    $fetch = mysqli_fetch_assoc($sql);

    if (mysqli_num_rows($sql) <= 0) {
        ?>
        <script>
            alert("<?php echo "Sorry, no emails exists " ?>");
        </script>
        <?php
    } else {
        // generate token by binaryhexa 
        $temp = 2418 * 2;
        $token = md5($temp . $email);
        $addToken = substr(md5(uniqid(rand(), 1)), 3, 10);
        $token = $token . $addToken;

        //session_start ();
        $_SESSION['token'] = $token;
        $_SESSION['email'] = $email;

        require './phpmailer/PHPMailerAutoload.php';
        require_once('./phpmailer/class.phpmailer.php');
        include("./phpmailer/class.smtp.php");
        $mail = new PHPMailer;

        $subject = "Password Recovery - Jobify.com";

        $email_to = $email;
        $fromserver = "swaranjalimanik19@siesgst.ac.in";

        $mail->Body = "<b>Dear User,</b>
            <p>We received a request to reset your password.</p>
            <p>Kindly click the below link </a> to reset your password</p>
            http://localhost/reset-password.php
            <br>
            <p>If you did not request this forgotten password email, no action 
            is needed, your password will not be reset. However, you may want to log into 
            your account and change your security password as someone may have guessed it.</p>
            <br>
            <p>Thanks,</p>
            <b>Jobify Team</b>";
        $mail->IsSMTP();
        $mail->Host = "smtp.gmail.com"; // Enter your host here
        $mail->SMTPAuth = true;
        $mail->Username = "swaranjalimanik19@siesgst.ac.in"; // Enter your email here
        $mail->Password = "sefall2023"; //Enter your password here
        $mail->Port = 25;
        $mail->IsHTML(true);
        $mail->From = "swaranjalimanik19@siesgst.ac.in";
        $mail->FromName = "Jobify";
        $mail->Sender = $fromserver; // indicates ReturnPath header
        $mail->Subject = $subject;

        $mail->AddAddress($email_to);

        if (!$mail->send()) {
            ?>
            <script>
                alert("<?php echo " Mailer error " ?>");
            </script>
            <?php
        } else {
            ?>
            <script>
                window.location.replace("notification.html");
            </script>
            <?php
        }
    }
}


?>