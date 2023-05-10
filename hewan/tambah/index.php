<?php
require('../../auth/auth.php');
require('../../config.php');

if (!($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'owner')) {
  header('Location: /');
}

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $animal = query("SELECT animal.id, animal.name, animal.image, animal_detail.description FROM animal INNER JOIN animal_detail ON animal.id=animal_detail.id WHERE animal.id='$id';");
  $isUpdate = $animal != NULL;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.quilljs.com/1.3.6/quill.core.css">
  <link rel="stylesheet" href="https://cdn.quilljs.com/1.3.6/quill.snow.css">
  <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/icons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/icons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/icons/favicon-16x16.png">
  <link rel="manifest" href="/assets/images/icons/site.webmanifest">
  <link rel="stylesheet" href="/assets/styles/style.css">
  <style>
    img {
      height: 128px;
    }
  </style>
  <title><?= $isUpdate ? 'Update ' . $animal['name'] : 'Tambah' ?> Hewan</title>
</head>

<body style="min-height: 100vh;">
  <header>
    <?php include("../../components/Nav.php") ?>
  </header>
  <main class="container " style="min-height: 100vh;">
    <section class="section">
      <h1 class="title"><?= $isUpdate ? 'Update' : 'Tambah' ?> Data Hewan</h1>
      <form name="form-animal" id="form-animal" action="/hewan/" method="POST" enctype="multipart/form-data">
        <div class="field" aria-label="name">
          <label class="label">Nama Hewan</label>
          <div class="control ctrl">
            <input id="name" class="input" value="<?= $isUpdate ? $animal['name'] : null ?>" name="name" type="text" placeholder="Contoh: Sapi">
          </div>
        </div>
        <div aria-label="photo" class="field">
          <p class="label">Gambar</p>
          <label for="image">
            <img class="img" accept="image/*" src="<?= $isUpdate ? $animal['image'] : '/assets/images/placeholder.jpg' ?>">
          </label>
          <input style="display: none;" id="image" class="input" name="image" type="file" placeholder="Contoh: Sapi">
        </div>
        <div aria-level="desc" class="field">
          <label class="label"">Deskripsi</label>
          <div class=" control ctrl" id="editor">
        </div>
        </div>
        <div class="field" aria-label="name">
          <div class="control ctrl">
            <button id="submit" type="submit" class="button is-primary">Submit</button>
          </div>
        </div>
        <?php if ($isUpdate) : ?>
          <input type="hidden" name="id" id="id" value="<?= $id ?>">
        <?php endif ?>
      </form>
    </section>
  </main>
  <footer>
    Copyright © 2023 | All Rights Reserved
  </footer>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.js"></script>
  <script src="https://kit.fontawesome.com/2f975d5468.js" crossorigin="anonymous"></script>
  <script src="/assets/js/cash.min.js"></script>
  <script src="/assets/js/quill.js" type="module"></script>
  <script type="module">
    import {
      toolbarOptions,
      quill
    } from '/assets/js/quill.js';

    <?php if ($isUpdate) : ?>
      quill.root.innerHTML = '<?= $animal['description'] ?>';
    <?php endif ?>

    $('#image').on('change', (e) => {
      const file = document.querySelector('#image').files[0];
      const reader = new FileReader();

      reader.addEventListener('load', (ee) => {
        $('.img').attr('src', ee.target.result);
        $('.img').attr('height', '128px');
      });

      reader.readAsDataURL(file);
    });

    $('#form-animal').on('submit', async (e) => {
      e.preventDefault();
      e.stopPropagation();

      $('.ctrl').toggleClass('is-loading');
      $('#submit').attr('disabled', true).toggleClass('is-loading');

      const input = document.querySelector('#image');
      console.log(input.files[0]);

      const formData = new FormData();
      <?php if ($isUpdate) : ?>
        formData.append('id', $('#id').val());
      <?php endif ?>
      formData.append('image', input.files[0]);
      formData.append('name', $('#name').val());
      formData.append('desc', quill.root.innerHTML);

      const res = await fetch('/api/animal/cud.php', {
        method: "POST",
        headers: {
          'Accept': '*/*',
        },
        body: formData
      });

      const data = await res.json();

      if (data.success) {
        swal({
          title: res.message,
          icon: "success",
        }).then(() => {
          $('.ctrl').toggleClass('is-loading');
          $('#submit').removeAttr('disabled').toggleClass('is-loading');
        });
      } else {
        swal({
          title: res.message,
          icon: "error",
        }).then(() => {
          $('.ctrl').toggleClass('is-loading');
          $('#submit').removeAttr('disabled').toggleClass('is-loading');
        });
      }
      console.log(data);

    });
  </script>
</body>