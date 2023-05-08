<?php
include('./auth/auth.php');
require('./config.php');

$animals = $mysqli->query("SELECT a.id, a.name, a.image, COUNT(fa.id) AS favCount FROM animal a LEFT JOIN fav_animal fa ON a.id = fa.animal_id GROUP BY a.name LIMIT 3");
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
  <script src="https://kit.fontawesome.com/2f975d5468.js" crossorigin="anonymous"></script>
  <title>ZooYuk</title>
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
</head>

<body>
  <header>
    <div class="jumbotron">
      <img src="/assets/images/zoo-1.png" alt="">
    </div>
    <?php include("./components/Nav.php") ?>
  </header>
  <main class="container">
    <section class="section">
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
                  <span class="icon">
                    <i class="fa-regular fa-heart"></i>
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
    </section>
  </main>
  <footer>
    Copyright © 2023 | All Rights Reserved
  </footer>
  <script src="/assets/js/script1.js"></script>
</body>

</html>