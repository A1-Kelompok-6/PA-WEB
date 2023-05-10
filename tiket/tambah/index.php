<?php
require('../../auth/auth.php');
require('../../config.php');

if (!($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'owner')) {
  header('Location: /');
}
$isUpdate = false;

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $ticket = query("SELECT * FROM ticket WHERE id='$id'");
  $isUpdate = $ticket != NULL;
}

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
    main {
      height: 100vh;
    }
  </style>
  <title><?= $isUpdate ? 'Update' : 'Tambah' ?> Tiket</title>
</head>

<body style="min-height: 100vh;">
  <header>
    <?php include("../../components/Nav.php") ?>
  </header>
  <main class="container " style="min-height: 100vh;">
    <section class="section" style="min-height: 100vh;">
      <h1 class="title"><?= $isUpdate ? 'Update' : 'Tambah' ?> Data Tiket</h1>
      <form name="form-ticket" id="form-ticket" action="/tiket/" method="<?= $isUpdate ? 'PUT' : 'POST' ?>">
        <div class="field" aria-label="name">
          <label class="label">Nama Tiket</label>
          <div class="control">
            <input class="input is-primary" value="<?= $isUpdate ? $ticket['name'] : null ?>" name="name" id="name" type="text" placeholder="Masukkan Nama Tiket" required>
          </div>
        </div>
        <div class="field" aria-label="price">
          <label class="label">Harga Tiket</label>
          <div class="control">
            <input class="input is-primary" value="<?= $isUpdate ? $ticket['price'] : null ?>" min="1000" step="1000" autocomplete="off" name="name" id="price" type="number" placeholder="Masukkan Harga Tiket" required>
          </div>
        </div>
        <div class="field" aria-label="name">
          <div class="">
            <button id="submit" type="submit" class="button is-primary"><?= $isUpdate ? 'Update' : 'Tambah' ?> </button>
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
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.js"></script>
  <script src="/assets/js/cash.min.js"></script>
  <script>
    $('#form-ticket').on('submit', async (e) => {
      e.preventDefault();
      e.stopPropagation();

      $('.control').toggleClass('is-loading');
      $('#submit').attr('disabled', true).toggleClass('is-loading');

      const formData = new FormData();
      formData.append('name', $('#name').val());
      formData.append('price', $('#price').val());

      const response = await fetch('/api/ticket/cud.php', {
        method: "<?= $isUpdate ? 'PUT' : 'POST' ?>",
        headers: {
          'Accept': '*/*',
        },
        body: <?= $isUpdate ? "JSON.stringify({ id: $('#id').val(), name: $('#name').val(), price: $('#price').val()})" : "formData"  ?>
      });

      const res = await response.json();

      console.log(res);
      if (res.success) {
        Swal.fire({
          icon: 'success',
          title: res.message,
        }).then(() => {
          $('.control').toggleClass('is-loading');
          $('#submit').removeAttr('disabled').toggleClass('is-loading');

          $('#name').val('');
          $('#price').val('');

          document.forms['form-ticket'].submit();
        });
      } else {
        Swal.fire({
          icon: 'error',
          title: res.message,
        }).then(() => {
          $('.control').toggleClass('is-loading');
          $('#submit').removeAttr('disabled').toggleClass('is-loading');
        });
      }
    });
  </script>
  <script src="https://kit.fontawesome.com/2f975d5468.js" crossorigin="anonymous"></script>
</body>