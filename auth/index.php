<?php
require("../config.php");


if (!empty($_POST)) {
  session_start();
  $_SESSION['email'] = $_POST['email'];
  $_SESSION['name'] = $_POST['name'];
  $_SESSION['role'] = $_POST['role'];
  $_SESSION['id'] = $_POST['id'];

  header('Location: /');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/icons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/icons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/icons/favicon-16x16.png">
  <link rel="manifest" href="/assets/images/icons/site.webmanifest">
  <title>Form Login</title>
  <link rel="stylesheet" href="/assets/styles/style.css">
  <link rel="stylesheet" href="/assets/styles/style2.css">
</head>

<body>
  <header>
    <?php require "../components/Nav.php" ?>
  </header>
  <main>
    <div class="wrapper">
      <div class="title-text">
        <div class="title login">Form Login</div>
        <div class="title signup">Form Registrasi</div>
      </div>
      <div class="form-container">
        <div class="slide-controls">
          <input type="radio" name="slide" id="login" checked>
          <input type="radio" name="slide" id="signup">
          <label for="login" class="slide login">Login</label>
          <label for="signup" class="slide signup">Daftar</label>
          <div class="slider-tab"></div>
        </div>
        <!-- form login -->
        <div class="form-inner">
          <form name="login" class="login" action="" method="POST">
            <div class="field">
              <input name="email" type="email" placeholder="Masukan Email " required id="mail">
            </div>
            <div class="field">
              <input type="password" name="pass" placeholder="Masukan Password" required id="pass">
            </div>
            <div class="field btn">
              <div class="btn-layer"></div>
              <button type="submit" name="btn-login" class="btn">Login</button>
            </div>
            <input type="text" name="name" hidden>
            <input type="hidden" name="role">
            <input type="hidden" name="id">
            <div class="signup-link">Buat akun <a href="">Daftar sekarang</a></div>
          </form>
          <!-- form daftar -->
          <form name="daftar" class="signup" method="POST">
            <div class="field">
              <input type="text" placeholder="Masukan Nama" id="daf_nama">
            </div>
            <div class="field">
              <input type="email" placeholder="Masukan Email" id="daf_email">
            </div>
            <div class="field">
              <input type="password" placeholder="Masukan Password" id="daf_pass">
            </div>
            <div class="field">
              <input type="password" placeholder="Ulangi password" id="ulang_pass" required>
            </div>
            <div class="field btn">
              <div class="btn-layer"></div>
              <button type="submit" class="btn">Daftar</button>
            </div>
            <div class="signup-link">Sudah punya akun? <a href="">Login</a></div>
          </form>
        </div>
      </div>
    </div>
  </main>

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="/assets/js/cash.min.js"></script>
  <script src="/assets/js/auth.js"></script>
  <script>
    const formLogin = document.querySelector('form[name="login"]');
    const formDaftar = document.querySelector('form[name="daftar"]');

    formLogin.addEventListener('submit', masuk);
    formDaftar.addEventListener('submit', daftar);
  </script>

  <script src="https://kit.fontawesome.com/2f975d5468.js" crossorigin="anonymous"></script>
</body>

</html>