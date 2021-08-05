<?php
session_start();

if (isset($_SESSION['login'])) {
  header("Location:media.php?p=home");
  exit;
}

require "functions.php";

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $result = mysqli_query($koneksi, "SELECT * FROM admin WHERE username = '$username'");

  //cek username
  if (mysqli_num_rows($result) === 1) {

    //cek password
    $row = mysqli_fetch_assoc($result);

    if (password_verify($password, $row['password'])) {
      //cek session
      $_SESSION['login'] = true;
      $_SESSION['nama'] = $row['nama'];
      $_SESSION['id'] = $row['id'];

      echo "<script type='text/javascript'>window.top.location='media.php?p=home';</script>";
      exit;
    }
  }

  $error = true;
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Login SPP</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="../login/style.css">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!------ Include the above in your HEAD tag ---------->
</head>

<body>


  <div class="wrapper fadeInDown">
    <div id="formContent">
      <!-- Tabs Titles -->

      <!-- Icon -->
      <div class="fadeIn first">
        <img style="padding: 10px 0;" src="logo.png" id="icon" alt="User Icon" />
        <h3>Login SPP</h3>
      </div>

      <?php if (isset($error)) : ?>
        <p style="color: red; font-style: italic;">Username / Password Salah</p>
      <?php endif ?>
      <!-- Login Form -->
      <form method="post" action="">
        <input type="text" id="username" class="fadeIn second" name="username" placeholder="username">
        <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
        <input type="submit" name="login" class="fadeIn fourth" value="Log In">
      </form>

      <!-- Remind Passowrd -->
      <!--<div id="formFooter">-->
      <!--  <a class="underlineHover" href="register">Belum Punya akun? Daftar disini</a>-->
      <!--</div>-->

    </div>
  </div>
</body>

</html>