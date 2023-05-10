<?php
require('../auth/auth.php');
require('../config.php');

$search = isset($_GET['search']) ? $_GET['search'] : null;
$searchQuery = isset($search) ? "WHERE order_code LIKE %$search%" : "";

$tickets = $mysqli->query("SELECT * FROM ticket $searchQuery");

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
  <title>Data Tiket</title>
  <link rel="stylesheet" href="/assets/styles/style.css">
  <style>
    main {
      height: 100vh;
    }

    body {
      padding-right: 0 !important;
    }

    .upcomming {
      font-size: 45px;
      text-transform: uppercase;
      border-left: 14px solid rgba(255, 235, 59, 0.78);
      padding-left: 12px;
      margin: 18px 8px;
    }

    .container .item {
      display: flex;
      padding: 0 20px;
      background: #fff;
      overflow: hidden;
      position: relative;
      margin: 10px;
      height: 200px;
      background-image: url('/assets/images/zoo-bg.jpg');
      background-position: left;
      background-size: cover;
      border: 4px dotted #fff;
    }

    .check {
      position: absolute;
      top: 4px;
      left: 4px;
      display: none;
      color: blue;
      width: 28px;
      height: 28px;
    }

    .amount {
      position: absolute;
      bottom: 3px;
      right: 3px;
      width: 5rem;
      display: none;
    }

    input:checked~.item .check {
      display: block;
    }

    input:checked~.item .amount {
      display: block;
    }

    .container .item-right,
    .container .item-left {
      padding: 20px
    }

    .container .item-right {
      flex-basis: 25%;
      position: relative;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100%
    }

    .container .item-right .num {
      font-size: 20px;
      text-align: center;
      color: #111;
      background-color: rgba(255, 255, 255, 0.4);
      -webkit-backdrop-filter: blur(5px);
      backdrop-filter: blur(5px);
      width: max-content;

    }

    .container .item-right .day,
    .container .item-left .event {
      color: #555;
      font-size: 20px;
      margin-bottom: 9px;
      border-radius: 8px;
      padding-left: 4px;
      background-color: rgba(255, 255, 255, 0.4);
      -webkit-backdrop-filter: blur(5px);
      backdrop-filter: blur(5px);
      width: max-content;
    }

    .container .item-right .day {
      text-align: center;
      font-size: 14px;
    }

    .container .item-left {
      flex-basis: 75%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      border-left: 3px dotted #999;
    }

    .container .item-left .title {
      color: #111;
      font-size: 34px;
      margin-bottom: 12px;
      background-color: rgba(255, 255, 255, 0.4);
      -webkit-backdrop-filter: blur(5px);
      backdrop-filter: blur(5px);
      width: max-content;
    }

    .grid {
      display: grid;
      grid-template-columns: auto auto auto;
    }

    @media only screen and (max-width: 1150px) {
      .container .item {
        width: 100%;
        margin-right: 20px
      }

      div.container {
        margin: 0 20px auto
      }
    }

    .bottom {
      overflow: hidden;
      background-color: #333;
      position: fixed;
      z-index: 20;
      bottom: -100px;
      width: 100%;
      padding: 20px 0;
      transition: bottom 0.5s ease;
    }

    .bottom.show {
      bottom: 0px;
      transition: bottom 0.5s ease;
    }

    .bottom p {
      color: white;
    }
  </style>
</head>

<body style="min-height: 100vh;">
  <header>
    <?php include("../components/Nav.php") ?>
  </header>
  <main class="container" style="min-height: 100vh;">
    <section class="section" style="min-height: 100vh;">
      <h1 class="title">Data Tiket</h1>
      <?php if (empty($_SESSION)) : ?>
        <div class="notification is-primary is-light">
          <a href="/auth/">Login Dulu</a> Untuk Membeli Tiket
        </div>
      <?php endif ?>
      <!-- Tampilan Untuk Admin, pakai Table -->
      <?php if (isset($_SESSION['role']) &&  ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'owner')) : ?>
        <table class="table" style="width: 100%;">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Harga</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $index = 1;
            while ($ticket = mysqli_fetch_array($tickets)) : ?>
              <tr data-id="<?= $ticket['id'] ?>">
                <th><?= $index ?></th>
                <td><?= $ticket['name'] ?></td>
                <td><?= currency($ticket['price']) ?></td>
                <td>
                  <div class="buttons">
                    <a class="button is-warning" href="/tiket/tambah?id=<?= $ticket['id'] ?>">
                      <span class="icon-text">
                        <span class="icon">
                          <i class="fa-regular fa-pen-to-square"></i>
                        </span>
                        <span>Edit</span>
                      </span>
                    </a>
                    <button data-name="<?= $ticket['name'] ?>" data-id="<?= $ticket['id'] ?>" class="button is-danger del-btn">
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
      <?php else : ?> <!-- Tampilan Untuk User, pakai Grid -->
        <div class="grid">
          <?php $index = 1;
          while ($ticket = mysqli_fetch_array($tickets)) : ?>
            <div>
              <input data-name="<?= $ticket['name'] ?>" data-id="<?= $ticket['id'] ?>" hidden type="checkbox" value="<?= $ticket['price'] ?>" name="ticket[]" id="ticket-<?= $ticket['id'] ?>">
              <label for="ticket-<?= $ticket['id'] ?>" class="item">
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'user') : ?>
                  <input data-id="<?= $ticket['id'] ?>" class="amount amount-<?= $ticket['id'] ?> input is-primary is-small" min="1" value="1" type="number" placeholder="Jumlah">
                  <i class="check fa-solid fa-circle-check"></i>
                <?php endif ?>
                <div class="item-right">
                  <h2 class="num"><?= $ticket['name'] ?></h2>
                  <p class="day"><?= currency($ticket['price']) ?></p>
                  <span class="up-border"></span>
                  <span class="down-border"></span>
                </div>
                <div class="item-left">
                  <p class="event">Kebun Binatang</p>
                  <h2 class="title">Zoo Yuk</h2>
                </div>
              </label>
            </div>
            <?php $index += 1 ?>
          <?php endwhile ?>
        </div>
      <?php endif ?>
    </section>
  </main>
  <div class="bottom">
    <div class="container" style="display: flex; justify-content: space-between; align-items: center;">
      <div class="tickets-name">
        <p>Keluarga 1x</p>
      </div>
      <button class="button is-primary order-btn">
        <span class="icon-text">
          <span class="icon">
            <i class="fa-solid fa-cart-arrow-down"></i>
          </span>
          <span class="total-price" style="color: white;">Rp. 2000</span>
          <input type="hidden" class="total-real" name="total-real">
        </span>
      </button>
    </div>
  </div>
  <footer>
    Copyright © 2023 | All Rights Reserved
  </footer>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="/assets/js/cash.min.js"></script>
  <script src="/assets/js/utils.js"></script>
  <?php if (isset($_SESSION['role']) &&  ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'owner')) : ?>
    <script>
      $('.del-btn').on('click', function() {
        const id = $(this).data('id');
        const name = $(this).data('name');

        Swal.fire({
          title: `Yakin ingin Mengahapus Tiket '${name}?'`,
          text: 'Tiket yang sudah dihapus tidak dapat dikembalikan',
          icon: 'warning',
          confirmButtonText: 'Ya, Hapus',
          showDenyButton: true,
          denyButtonText: `Tidak, jangan hapus`,
        }).then(async (result) => {
          if (result.isConfirmed) {
            const formData = new FormData();
            formData.append('id', id);

            const res = await fetch(`/api/ticket/cud.php?id=${id}`, {
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
  <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'user') : ?>
    <script>
      function countTotal() {
        let totalReal = 0;
        const html = $('input[type="checkbox"]:checked').map(function() {
          const id = $(this).data('id');
          const name = $(this).data('name');
          const price = $(this).val();
          const amount = $(`.amount-${id}`).val();
          const total = amount * price;
          totalReal += total;
          return `<p>
          ${name}  
          ${currency(price)} x <span id='amount-text-${id}'>${amount}</span> = <b id="total-text-${id}">${currency(total)}</b>
          </p>`
        }).get();

        $('.total-price').html(currency(totalReal));
        $('.total-real').val(totalReal);
        return html;
      }

      $('input[type=checkbox]').on('change', function() {
        const length = $('input[type="checkbox"]:checked').length;
        if (length > 0 && !$('.bottom').hasClass('show')) {
          $('.bottom').addClass('show');
        } else if (length == 0 && $('.bottom').hasClass('show')) {
          $('.bottom').removeClass('show');
        }

        const html = countTotal();

        $('.tickets-name').html(html.join(''));

      });

      $(document).on('change', '.amount', function() {
        const id = $(this).data('id');
        const price = $(`#ticket-${id}`).val();
        const amount = $(this).val();
        const total = price * amount;
        // Change amount
        $(`#amount-text-${id}`).html(amount);

        // Change Total
        $(`#total-text-${id}`).html(currency(total));

        countTotal();
      });

      $('.order-btn').on('click', function() {
        Swal.fire({
          title: `Yakin ingin Menambahkan Pesanan Tiket`,
          text: 'Tiket yang sudah dipesan tidak dapat diubah',
          icon: 'warning',
          confirmButtonText: 'Ya, Pesan Tiket',
          showDenyButton: true,
          denyButtonText: `Tidak, Ntar Duls`,
        }).then(async (result) => {
          if (result.isConfirmed) {
            const datas = $('input[type="checkbox"]:checked').map(function() {
              const id = $(this).data('id');
              const name = $(this).data('name');
              const price = $(this).val();
              const amount = $(`.amount-${id}`).val();
              const total = amount * price;
              return {
                id,
                amount,
                name,
                price,
                total,
              }
            }).get();

            const formData = new FormData();
            formData.append('user_id', <?= $_SESSION['id'] ?>);
            formData.append('total_price', $('.total-real').val());
            formData.append('datas', JSON.stringify(datas));

            const res = await fetch(`/api/order/add.php`, {
              method: 'POST',
              headers: {
                'Accept': '*/*',
              },
              body: formData,
            });

            const data = await res.json()

            if (data.success) {
              Swal.fire({
                title: data.message,
                icon: 'success'
              }).then(() => window.location.replace('/pesanan'));
            } else {
              Swal.fire({
                title: data.message,
                icon: 'error'
              })
            }
            console.log(data);

          }
        })
      });
    </script>
  <?php endif ?>
  <script src="https://kit.fontawesome.com/2f975d5468.js" crossorigin="anonymous"></script>
</body>

</html>