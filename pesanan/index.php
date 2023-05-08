<?php
require('../auth/auth.php');
require('../config.php');

if (!isset($_SESSION['id'])) {
  header("Location: /");
}

$orders = array();

// Params
$search = isset($_GET['s']) ? $_GET['s'] : '';
$order = isset($_GET['order']) ? $_GET['order'] : '';
$by = isset($_GET['by']) ? 'ORDER BY ' . $_GET['by'] : '';

$role = $_SESSION['role'];
if ($role === 'admin' || $_SESSION['role'] === 'owner') {
  $searchQuery = isset($search) ? "WHERE order_code LIKE '%$search%' $by $order" : "";
  $orders = $mysqli->query("SELECT order.id,
  order.order_code,
  order.total_price,
  order.status,
  order.user_id,
  user.email
FROM `order`
  INNER JOIN user ON order.user_id = user.id $searchQuery");
} else if ($role === 'user') {
  $searchQuery = isset($search) ? "AND order_code LIKE '%$search%'  $by $order " : "";
  $id = $_SESSION['id'];
  $orders = $mysqli->query("SELECT * FROM `order` WHERE user_id='$id' $searchQuery");
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
  <title>Data Pesanan</title>
  <link rel="stylesheet" href="/assets/styles/style.css">
</head>

<body>
  <header>
    <?php include("../components/Nav.php") ?>
  </header>
  <main class="container">
    <section class="section">
      <div class="columns" style="margin-bottom: 2.5rem;">
        <h1 style="margin-bottom: 0; padding-top: 0;" class="title column">Data Pesanan</h1>
        <form method="GET" class="field column columns">
          <p class="control has-icons-left">
            <input class="input" id="search" value="<?= isset($_GET['s']) ? $_GET['s'] : '' ?>" name="s" type="text" placeholder="Cari Invoice...">
            <span class="icon is-small is-left">
              <i class="fa-solid fa-magnifying-glass"></i>
            </span>
          </p>
          <div class="select is-primary">
            <select name="order">
              <option value="asc" <?= !isset($_GET['order']) || $_GET['order'] === 'asc' ? 'selected' : '' ?>>Asc</option>
              <option value="desc" <?= isset($_GET['order']) && $_GET['order'] === 'desc' ? 'selected' : '' ?>>Desc</option>
            </select>
          </div>
          <div class="select is-primary ">
            <select name="by">
              <option value="id" <?= !isset($_GET['by']) || $_GET['by'] === 'id' ? 'selected' : '' ?>>No</option>
              <option value="order_code" <?= isset($_GET['order']) && $_GET['by'] === 'order_code' ? 'selected' : '' ?>>Invoice</option>
              <option value="total_price" <?= isset($_GET['order']) && $_GET['by'] === 'total_price' ? 'selected' : '' ?>>Harga</option>
            </select>
          </div>
          <button type="submit" style="margin-left: 1rem;" class="button is-primary">Filter</button>
        </form>
      </div>
      <?php if (empty($_SESSION)) : ?>
        <div class="notification is-primary is-light">
          <a href="/auth/">Login Dulu</a> Untuk Membeli Tiket
        </div>
      <?php endif ?>
      <!-- Tampilan Untuk Admin, pakai Table -->
      <table class="table" style="width: 100%;">
        <thead>
          <tr>
            <th>No</th>
            <th>No. Invoice</th>
            <?php if ($role !== 'user') : ?>
              <th>Email Pemesan</th>
            <?php endif ?>
            <th>Status</th>
            <th>Total Harga</th>
            <?php if ($role !== 'user') : ?>
              <th>Ubah Status</th>
            <?php endif ?>
          </tr>
        </thead>
        <tbody>
          <?php $index = 1;
          function status($status) {
            if ($status === 'progress') {
              return array('color' => 'is-warning', 'text' => 'Proses');
            } else if ($status === 'success') {
              return array('color' => 'is-success', 'text' => 'Sukses');
            } else if ($status === 'cancelled') {
              return array('color' => 'is-danger', 'text' => 'Gagal');
            }
          }
          while ($order = mysqli_fetch_array($orders)) : ?>
            <tr class="double-click" data-name="<?= $order['order_code'] ?>" data-id="<?= $order['id'] ?>">
              <th><?= $index ?></th>
              <td><?= $order['order_code'] ?></td>
              <?php if ($role !== 'user') : ?>
                <td><?= $order['email'] ?></td>
              <?php endif ?>
              <td>
                <span class="tag is-light is-medium is-rounded <?= status($order['status'])['color'] ?>">
                  <?= status($order['status'])['text'] ?>
                </span>
              </td>
              <td><?= currency($order['total_price']) ?></td>
              <?php if ($role !== 'user') : ?>
                <td>
                  <?php if ($order['status'] === 'progress') : ?>
                    <span data-id="<?= $order['id'] ?>" data-status="success" style="cursor: pointer;" title="Sukses" class="icon has-text-success status-btn">
                      <i class="fa-regular fa-circle-check fas fa-xl"></i>
                    </span>
                    <span data-id="<?= $order['id'] ?>" data-status="cancelled" style="cursor: pointer;" title="Gagal/Batal" class="icon has-text-danger status-btn">
                      <i class="fa-regular fa-circle-xmark fas fa-xl"></i>
                    </span>
                  <?php endif ?>
                </td>
              <?php endif ?>

            </tr>
            <?php $index += 1 ?>
          <?php endwhile ?>
        </tbody>
      </table>
    </section>
  </main>
  <footer>
    Copyright © 2023 | Rizky Maulana Alfauzan
  </footer>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="/assets/js/cash.min.js"></script>
  <?php if ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'owner') : ?>
    <script src="/pesanan/change-status.js"></script>
  <?php endif ?>
  <script type="module" src="/pesanan/detail.js"></script>
  <script src="/pesanan/params.js"></script>
  <script src="https://kit.fontawesome.com/2f975d5468.js" crossorigin="anonymous"></script>
</body>

</html>