<?php
require('../config.php');
include('../auth/auth.php');

$animals;
$isSingle = false;
$userID = isset($_SESSION['id'])  ? $_SESSION['id'] : null;
$isUser = isset($_SESSION['role']) && $_SESSION['role'] === 'user';

if (isset($_GET['id'])) { /* Untuk Single */
  $id = $_GET['id'];
  $animal = query("SELECT animal.id, animal.image, animal.name, animal_detail.description FROM animal INNER JOIN animal_detail on animal_detail.id=animal.id WHERE animal.id=$id");
  $isSingle = $animal !== NULL;

  $data = query("SELECT count(*) as total, id from fav_animal WHERE animal_id='$id' AND user_id='$userID'");
  $isFav = $data['total'] > 0;
}

if (isset($_GET['filter']) && $_GET['filter'] === 'fav' && $userID && $isUser) { /* Untuk Filter */
  $animals = $mysqli->query("SELECT a.id,
  a.name,
  a.image,
  COUNT(fav_animal.id) AS favCount,
  CASE
    WHEN (
      SELECT fav_animal.animal_id
      FROM fav_animal
      WHERE fav_animal.animal_id = a.id
        AND fav_animal.user_id = '$userID' 
    ) = a.id THEN TRUE
    ELSE FALSE
  END AS isFav
FROM animal a
  LEFT JOIN fav_animal ON a.id = fav_animal.animal_id 
  WHERE 1=CASE
    WHEN (
      SELECT fav_animal.animal_id
      FROM fav_animal
      WHERE fav_animal.animal_id = a.id
        AND fav_animal.user_id = '$userID'
    ) = a.id THEN TRUE
    ELSE FALSE
  END
GROUP BY a.name");
} else {
  $animals = $mysqli->query("SELECT a.id, a.name, a.image, COUNT(fav_animal.id) AS favCount, CASE WHEN (SELECT fav_animal.animal_id FROM fav_animal WHERE fav_animal.animal_id = a.id AND fav_animal.user_id = '$userID') = a.id THEN TRUE ELSE FALSE END AS isFav FROM animal a LEFT JOIN fav_animal ON a.id = fav_animal.animal_id GROUP BY a.name");
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
  <link rel="stylesheet" href="/assets/styles/style.css">
  <style>
    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      grid-gap: 0.5em;
    }

    .card {
      justify-content: space-between;
      height: 100%;
    }

    .card-content {
      display: flex;
      flex-direction: column;
      align-items: center;
    }
  </style>
  <title><?= $isSingle ? $animal['name'] : 'Daftar Hewan'; ?> <?= isset($_GET['filter']) && $_GET['filter'] === 'fav' ? 'Favorit' : '' ?> - ZooYuk</title>
</head>

<body style="min-height: 100vh;">
  <header>
    <?php include("../components/Nav.php") ?>
  </header>
  <main class="container" style="min-height: 100vh;">
    <section class="section" style="height: 100%;">
      <?php if ($isSingle) : ?> <!-- Single Page -->
        <div class="content">
          <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 2rem;">
            <h1 class="title" style="margin-bottom: 0;"><?= $animal['name'] ?></h1>
            <?php if (isset($_SESSION) && $_SESSION['role'] === 'user') : ?>
              <button class="button is-link is-rounded <?= $isFav ? 'is-light' : '' ?>" type="button" id="fav">
                <span class="icon-text">
                  <?php if (!$isFav) : ?>
                    <span class="icon">
                      <i class="fa-regular fa-heart"></i>
                    </span>
                    <span>Tambah Favorit</span>
                  <?php else : ?>
                    <span class="icon">
                      <i class="fa-solid fa-heart"></i>
                    </span>
                    <span>Favorit</span>
                  <?php endif ?>
                </span>
              </button>
              <input type="hidden" name="animal-id" value="<?= $_GET['id'] ?>">
              <input type="hidden" name="user-id" value="<?= $_SESSION['id'] ?>">
            <?php endif ?>
          </div>
          <img class="" style="width: 50%;" src="<?= $animal['image'] ?>" alt="<?= $animal['name'] ?>">
          <?= $animal['description'] ?>
        </div>
      <?php else : ?> <!-- List Page -->
        <!-- List Page Admin dan Owner -->
        <?php if (isset($_SESSION['role']) && ($_SESSION['role'] === 'owner' || $_SESSION['role'] === 'admin')) : ?>
          <table class="table" style="width: 100%;">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Gambar</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $index = 1;
              while ($animal = mysqli_fetch_array($animals)) : ?>
                <tr data-id="<?= $animal['id'] ?>">
                  <th><?= $index ?></th>
                  <td><?= $animal['name'] ?></td>
                  <td><img style="height: 128px;" src="<?= $animal['image'] ?>" alt="<?= $animal['name'] ?>"> </td>
                  <td>
                    <div class="buttons">
                      <a class="button is-warning" href="/hewan/tambah?id=<?= $animal['id'] ?>">
                        <span class="icon-text">
                          <span class="icon">
                            <i class="fa-regular fa-pen-to-square"></i>
                          </span>
                          <span>Edit</span>
                        </span>
                      </a>
                      <button data-name="<?= $animal['name'] ?>" data-id="<?= $animal['id'] ?>" class="button is-danger del-btn">
                        <span class="icon-text">
                          <span class="icon">
                            <i class="fa-regular fa-trash-can"></i>
                          </span>
                          <span>Hapus</span>
                        </span>
                      </button>
                    </div>
                  </td>
                </tr>
                <?php $index += 1 ?>
              <?php endwhile ?>
            </tbody>
          </table>
        <?php else : ?> <!-- List Page Untuk Normal User -->
          <div class="grid">
            <?php while ($animal = mysqli_fetch_array($animals)) : ?>
              <div class="card column">
                <div class="card-image">
                  <figure class="image ">
                    <img style="min-height: 128px;" src="<?= $animal['image'] ?>" alt="Placeholder image">
                  </figure>
                </div>
                <div class="card-content" style="width: 100%;">
                  <div style="display: flex; align-items: center; justify-content: space-between; width: 100%; margin-bottom: 2rem;">
                    <p class="is-size-4"><?= $animal['name'] ?></p>
                    <span class="icon-text">
                      <span class="icon has-text-link">
                        <i class="<?= $animal['isFav'] ? 'fa-solid ' : 'fa-regular' ?>  fa-heart"></i>
                      </span>
                      <span><?= $animal['favCount'] ?></span>
                    </span>
                  </div>
                  <a href="/hewan?id=<?= $animal['id'] ?>" class="button is-primary">
                    Baca Lebih Lanjut
                  </a>
                </div>
              </div>
            <?php endwhile ?>
          </div>
        <?php endif ?>
      <?php endif ?>
    </section>
  </main>
  <footer>
    Copyright © 2023 | All Rights Reserved
  </footer>

  <script src="https://kit.fontawesome.com/2f975d5468.js" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="/assets/js/cash.min.js"></script>
  <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'user') : ?>
    <script src="/hewan/hewan-single-user.js"></script>
  <?php endif ?>
  <?php if (isset($_SESSION['role']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'owner')) : ?>
    <script>
      $('.del-btn').on('click', function() {
        const id = $(this).data('id');
        const name = $(this).data('name');

        Swal.fire({
          title: `Yakin ingin Mengahapus Hewan '${name}?'`,
          text: 'Hewan yang sudah dihapus tidak dapat dikembalikan',
          icon: 'warning',
          confirmButtonText: 'Ya, Hapus',
          showDenyButton: true,
          denyButtonText: `Tidak, jangan hapus`,
        }).then(async (result) => {
          if (result.isConfirmed) {
            const formData = new FormData();
            formData.append('id', id);

            const res = await fetch(`/api/animal/cud.php?id=${id}`, {
              method: 'DELETE',
              headers: {
                'Accept': '*/*',
              },
            });

            const data = await res.json()

            if (data.success) {
              Swal.fire({
                title: data.message,
                icon: 'success'
              }).then(() => window.location.reload());

            } else {
              Swal.fire({
                title: data.message,
                icon: 'error'
              })
            }
            console.log(data);

          }
        })
      })
    </script>
  <?php endif ?>

</body>