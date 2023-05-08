<?php
require('../../config.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user_id = esc_string($_POST['user_id']);
  $total_price = esc_string($_POST['total_price']);
  $datas = json_decode($_POST['datas'], true);

  try {
    date_default_timezone_set("Asian/Kuala Lumpur");
    $date = date('Y/m/d');
    $res = false;

    $res_order = $mysqli->query("INSERT INTO `order` (user_id, total_price, status) VALUES ('$user_id', '$total_price', 'progress')");
    $order_id = mysqli_insert_id($mysqli);
    $number = sprintf("%03d", $order_id);
    $invoice = "INVOICE/" . $date . "/" . $number;
    $mysqli->query("UPDATE `order` SET order_code='$invoice' WHERE id='$order_id'");

    foreach ($datas as $data) {
      $ticket_id = $data['id'];
      $amount = $data['amount'];
      $total = $data['total'];
      $mysqli->query("INSERT INTO order_ticket (order_id, ticket_id, amount, total) VALUES ('$order_id', '$ticket_id', '$amount', '$total')");
    }

    $res = true;

    if ($res) {
      echo json_encode(array(
        'success' => true,
        'message' =>  "Berhasil Menambahkan Pesanan"
      ));
    } else {
      echo json_encode(array(
        'success' => false,
        'message' =>  "Gagal Menambahkan Pesanan"
      ));
    }
  } catch (\Throwable $th) {
    echo json_encode(array(
      'success' => false,
      'message' =>  "Terjadi Kesalahan Saat Menambahkan Pesanan" . $th
    ));
  }
} else {
  header("Location: /tiket");
}
