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

  $result = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");

  //cek username
  if (mysqli_num_rows($result) === 1) {

    //cek password
    $row = mysqli_fetch_assoc($result);

    if (password_verify($password, $row['password'])) {
      //cek session
      $_SESSION['login'] = true;
      $_SESSION['nama'] = $row['nama'];
      $_SESSION['nis'] = $row['nis'];
      $_SESSION['id'] = $row['id'];
      $_SESSION['sekolah'] = $row['sekolah'];
      $_SESSION['kelas'] = $row['kelas'];

      echo "<script type='text/javascript'>window.top.location='media.php?p=home';</script>";
      exit;
    }
  }

  $error = true;
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Pengguna</title>
  <link rel="stylesheet" href="../masuk/style.css">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>

<body>
  <div class="container">
    <div class="wrapper">
      <div class="title"><img src="logo.png" width="100" height="100" alt=""><span>Login Pengguna</span></div>

      <form method="POST" action="">
        <div class="row">
          <i class="fas fa-user"></i>
          <input type="text" id="username" name="username" placeholder="Masukan Username" required>
        </div>
        <div class="row">
          <i class="fas fa-lock"></i>
          <input type="password" id="password" name="password" placeholder="Masukan Password" required>
        </div>

        <?php if (isset($error)) : ?>
          <p style="color: red; font-style: italic; text-align: center;"">Username / Password Salah</p>
        <?php endif ?>

        <div class=" row button">
            <input type="submit" name="login" value="Masuk Sistem">
    </div>

    <div class="signup-link">Belum punya akun? <a href="#">Daftar Disini</a></div>
    </form>
  </div>
  </div>

</body>

</html>