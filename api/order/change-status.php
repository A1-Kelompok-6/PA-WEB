<?php
require('../../config.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = esc_string($_POST['id']);
  $status = esc_string($_POST['status']);

  try {
    $res = $mysqli->query("UPDATE `order` SET status='$status' WHERE id='$id'");

    if ($res) {
      echo json_encode(array(
        'success' => true,
        'message' =>  "Berhasil Merubah Status"
      ));
    } else {
      echo json_encode(array(
        'success' => false,
        'message' =>  "Gagal Merubah Status"
      ));
    }
  } catch (\Throwable $th) {
    echo json_encode(array(
      'success' => false,
      'message' =>  "Terjadi Kesalahan Saat Merubah Status" . $th
    ));
  }
} else {
  header("Location: /tiket");
}
