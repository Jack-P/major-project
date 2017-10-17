<?php
session_start();
if (isset($_SESSION['userSession'])!="") {
 header("Location: index.php");
}
require_once 'db_connect.php';

if(isset($_POST['btn-signup'])) {

 $userName = strip_tags($_POST['username']);
 $email = strip_tags($_POST['email']);
 $upass = strip_tags($_POST['password']);

 $userName = $DBcon->real_escape_string($userName);
 $email = $DBcon->real_escape_string($email);
 $upass = $DBcon->real_escape_string($upass);

 $hashed_password = password_hash($upass, PASSWORD_DEFAULT);

 $check_email = $DBcon->query("SELECT email FROM users WHERE email='$email'");
 $count=$check_email->num_rows;

 if ($count==0) {

  $query = "INSERT INTO users(username,email,password) VALUES('$userName','$email','$hashed_password')";

  if ($DBcon->query($query)) {
   $msg = "<div class='alert alert-success'>
      successfully registered !
     </div>";
  }else {
   $msg = "<div class='alert alert-danger'>
      error while registering !
     </div>";
  }

 } else {


  $msg = "<div class='alert alert-danger'>
     sorry email already taken !
    </div>";

 }

 $DBcon->close();
}
?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ani-Mate</title>
    <link rel="stylesheet" href="css/app.css">
    <!-- <link rel="stylesheet" href="css/jquery-ui.min.css"> -->
    <link rel="stylesheet" href="foundation-icons/foundation-icons.css" />
  </head>
  <body>

  <div class="row">
    <div class="large-6 large-offset-3 sign-up column">
      <form class="form-signin" method="post" id="register-form">

        <?php
        if (isset($msg)) {
          echo $msg;
        }
        ?>

        <div class="form-group">
          <label for="">Username</label>
          <input type="text" class="form-control" placeholder="Username" name="username" required  />
          <label for="">Email</label>
          <input type="email" class="form-control" placeholder="Email address" name="email" required  />
          <label for="">Password</label>
          <input type="password" class="form-control" placeholder="Password" name="password" required  />
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-default" name="btn-signup">Create Account</button>
          <a href="index.php" class="btn btn-default">Log In Here</a>
        </div>

      </form>
    </div>
  </div>



    <script src="bower_components/jquery/dist/jquery.js"></script>
    <script src="bower_components/what-input/dist/what-input.js"></script>
    <script src="bower_components/foundation-sites/dist/js/foundation.js"></script>
    <!-- <script src="js/jquery-ui.min.js"></script> -->
    <script src="js/app.js"></script>
    <script src="js/myscript.js"></script>
  </body>
</html>
