<?php
require('../config.php');
include('../auth/auth.php');

$owner = query("SELECT description, image FROM user_detail WHERE id='1'")

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/icons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/icons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/icons/favicon-16x16.png">
  <link rel="manifest" href="/assets/images/icons/site.webmanifest">
  <link rel="stylesheet" href="/assets/styles/style.css">
  <title>Tentang</title>
</head>

<body style="min-height: 100vh;">
  <header>
    <?php include("../components/Nav.php") ?>
  </header>
  <main class="container" style="min-height: 100vh;">
    <section class="section" style="height: 100%;">
      <div class="content">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 2rem;">
          <h1 class="title" style="margin-bottom: 0;">About</h1>
        </div>
        <img class="" style="width: 50%;" src="<?= $owner['image'] ?? '/zoo-1.png' ?>" alt="Gambar">
        <?= $owner['description'] ?>
      </div>
    </section>
  </main>
  <footer>
    Copyright © 2023 | All Rights Reserved
  </footer>

  <script src="https://kit.fontawesome.com/2f975d5468.js" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="/assets/js/cash.min.js"></script>


</body>
