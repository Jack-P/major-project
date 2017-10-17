<?php
session_start();
require_once 'db_connect.php';

if (isset($_SESSION['userSession'])!="") {
 header("Location: main_page.php");
 exit;
}
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
}

if (isset($_POST['btn-login'])) {

 $email = strip_tags($_POST['email']);
 $password = strip_tags($_POST['password']);

 $email = $DBcon->real_escape_string($email);
 $password = $DBcon->real_escape_string($password);

 $query = $DBcon->query("SELECT user_id, email, password FROM users WHERE email='$email'");
 $row=$query->fetch_array();

 $count = $query->num_rows;

 if (password_verify($password, $row['password']) && $count==1) {
  $_SESSION['userSession'] = $row['user_id'];
  header("Location: main_page.php");
 } else {
  $msg = "<div class=''>
     Invalid Username or Password !
    </div>";
 }
 $DBcon->close();
}
?>
<!doctype html>
<html class="no-js bg" lang="en">
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

    <div class="row sign-pad">
      <div class="large-6 large-offset-4 columns">

        <form class="signIn" method="post">
          <?php
            if (isset($msg)) {
             echo $msg;
            }
          ?>
          <img src="images/logo3.png" alt="">
          <br>
          <h3>Welcome Back</h3>
          <label>Your Email:</label>
          <input type="email" placeholder="youremail@email.com" autocomplete='off' name="email" reqired />
          <label>Your Password:</label>
          <input type="password" placeholder="Password" name="password" reqired />
          <button class="form-btn sx back" type="button">Sign Up Here</button>
          <button class="form-btn dx" type="submit" name="btn-login">Login</button>
        </form>

        <form class="signUp" method="post">
          <?php
            if (isset($msg)) {
             echo $msg;
            }
          ?>
          <br>
        		<h3>Create Your Account</h3>
            <br><br>
            <label>Your Username:</label>
        		<input type="text" placeholder="Your Username" name="username" reqired />
            <label>Your Email:</label>
            <input class="w100" type="email" placeholder="Insert eMail" name="email" reqired autocomplete='off' />
            <label>Your Password:</label>
        		<input type="password" placeholder="Insert Password" name="password" reqired />
            <button class="form-btn sx log-in" type="button">Back</button>
            <button class="form-btn dx" type="submit" name="btn-signup" >Register Account</button>

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
