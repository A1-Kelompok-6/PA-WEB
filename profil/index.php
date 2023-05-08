<?php
require('../auth/auth.php');
require('../config.php');

if (!isset($_SESSION['id'])) {
  header('Location: /');
}
$id = $_SESSION['id'];
$user = query("SELECT u.id, u.name, u.email, u.role, ud.address, ud.image, ud.phone, ud.description FROM user u INNER JOIN user_detail ud ON u.id=ud.id WHERE ud.id='$id'");

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
  <link rel="stylesheet" href="https://cdn.quilljs.com/1.3.6/quill.core.css">
  <link rel="stylesheet" href="https://cdn.quilljs.com/1.3.6/quill.snow.css">
  <link rel="stylesheet" href="/assets/styles/style.css">
  <style>
    img {
      height: 128px;
    }
  </style>

  <title>Profile <?= $user['name'] ?></title>
</head>

<body style="min-height: 100vh;">
  <header>
    <?php include("../components/Nav.php") ?>
  </header>
  <main class="container ">
    <section class="section">
      <h1 class="title">Profile</h1>
      <form name="form-profile" data-id="<?= $user['id'] ?>" id="form-profile" action="/profil/" method="POST">
        <div class="field" aria-label="name">
          <label class="label">Nama</label>
          <div class="control">
            <input class="input is-primary" value="<?= $user['name'] ?>" name="name" id="name" type="text" placeholder="Masukkan Nama Tiket" required>
          </div>
        </div>
        <div class="field" aria-label="email">
          <label class="label">Alamat Email</label>
          <div class="control">
            <input class="input is-primary" disabled value="<?= $user['email'] ?>" name="email" id="email" type="email" placeholder="Masukkan Email" required>
          </div>
        </div>
        <div class="field" aria-label="address">
          <label class="label">Alamat</label>
          <div class="control">
            <input class="input is-primary" value="<?= $user['address'] ?>" name="address" id="address" type="text" placeholder="Masukkan Alamat" required>
          </div>
        </div>
        <div class="field" aria-label="phone">
          <label class="label">No. HP</label>
          <div class="control">
            <input class="input is-primary" value="<?= $user['phone'] ?>" name="phone" id="phone" type="tel" placeholder="Masukkan No. Telepon" required>
          </div>
        </div>
        <div aria-label="photo" class="field">
          <p class="label">Gambar</p>
          <label for="image">
            <img class="img" accept="image/*" src="<?= $user['image'] ?? '/assets/images/placeholder.jpg' ?>">
          </label>
          <input style="display: none;" id="image" class="input" name="image" type="file" placeholder="Contoh: Sapi">
        </div>
        <div aria-level="desc" class="field">
          <label class="label""><?= $_SESSION['role'] === 'owner' ? 'Tentang Website' : 'Deskripsi' ?></label>
          <div class=" control ctrl" id="editor">
        </div>
        </div>
        <div class="field" aria-label="name">
          <div class="">
            <button id="submit" type="submit" class="button is-primary">Update</button>
          </div>
        </div>
      </form>
    </section>
  </main>
  <footer>
    Copyright © 2023 | Rizky Maulana Alfauzan
  </footer>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.js"></script>
  <script src="/assets/js/cash.min.js"></script>
  <script src="/assets/js/quill.js" type="module"></script>

  <script src="https://kit.fontawesome.com/2f975d5468.js" crossorigin="anonymous"></script>

  <script type="module">
    import {
      toolbarOptions,
      quill
    } from '/assets/js/quill.js';

    // Init Description If Exist
    <?php if ($user['description']) : ?>
      quill.root.innerHTML = '<?= $user['description'] ?>';
    <?php endif ?>

    // Handle Change Image
    $('#image').on('change', (e) => {
      const file = document.querySelector('#image').files[0];
      const reader = new FileReader();

      reader.addEventListener('load', (ee) => {
        $('.img').attr('src', ee.target.result);
        $('.img').attr('height', '128px');
      });

      reader.readAsDataURL(file);
    });

    // Submit Form
    $('#form-profile').on('submit', async function(e) {
      e.preventDefault();
      e.stopPropagation();

      const image = document.querySelector('#image');

      const body = new FormData();
      body.append('id', $(this).data('id'));
      body.append('name', $('#name').val());
      body.append('address', $('#address').val());
      body.append('phone', $('#phone').val());
      body.append('image', image.files[0]);
      body.append('description', quill.root.innerHTML);

      const res = await fetch('/api/user/update.php', {
        method: "POST",
        headers: {
          "Accept": "*/*",
        },
        body: body,
      });

      const data = await res.json();

      if (data.success) {
        Swal.fire({
          title: data.message,
          icon: "success",
        }).then(() => {})
      } else {
        Swal.fire({
          title: data.message,
          icon: "error",
        })
      }
      console.log(res);
    });
  </script>
</body>