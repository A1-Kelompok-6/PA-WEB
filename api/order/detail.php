<?php
require('../../config.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $id = esc_string($_GET['id']);

  try {
    $orders = $mysqli->query("SELECT ot.id, ot.amount, ot.total, t.name, t.price FROM order_ticket ot INNER JOIN ticket t ON ot.ticket_id=t.id WHERE ot.order_id ='$id';");
    $data = array();

    while ($order = mysqli_fetch_array($orders)) {
      array_push($data, [
        'id' => $order['id'],
        'amount' => $order['amount'],
        'total' => $order['total'],
        'name' => $order['name'],
        'price' => $order['price']
      ]);
    }

    if ($orders) {
      echo json_encode(array(
        'success' => true,
        'message' =>  "Berhasil Get Detail Order",
        'data' => $data,
      ));
    } else {
      echo json_encode(array(
        'success' => false,
        'message' =>  "Gagal Mendapat Detail Order",
        'data' => null,
      ));
    }
  } catch (\Throwable $th) {
    echo json_encode(array(
      'success' => false,
      'message' =>  "Terjadi Kesalahan Saat Mengambil Detail Order" . $th,
      'data' => null
    ));
  }
} else {
  header("Location: /tiket");
}
