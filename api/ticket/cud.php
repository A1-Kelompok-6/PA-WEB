<?php
require('../../config.php');

header('Content-Type: application/json');
header('Content-Type: multipart/form-data');
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Methods: DELETE");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = esc_string($_POST['name']);
  $price = esc_string($_POST['price']);

  try {
    $q = $mysqli->query("SELECT * FROM ticket WHERE name='$name'");

    if (mysqli_num_rows($q) != 0) {
      echo json_encode(array(
        'success' => false,
        'message' => 'Nama Tiket Sudah Terpakai'
      ));
      return;
    }

    $res = $mysqli->query("INSERT INTO ticket (name, price) VALUES ('$name', '$price')");

    if ($res) {
      echo json_encode(array(
        'success' => true,
        'message' => 'Berhasil Menambahkan Tiket'
      ));
    } else {
      echo json_encode(array(
        'success' => false,
        'message' => 'Terjadi Kesalahan Saat Menambahkan Tiket',
      ));
    }
  } catch (\Throwable $th) {
    echo json_encode(array(
      'success' => false,
      'message' => 'Terjadi Kesalahan Saat Menambahkan Tiket',
    ));
  }
} else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
  $body =  file_get_contents('php://input');
  $json = json_decode($body, true);

  $id = esc_string($json['id']);
  $name = esc_string($json['name']);
  $price = esc_string($json['price']);

  try {

    $res = $mysqli->query("UPDATE ticket SET name='$name', price='$price' WHERE id='$id'");

    if ($res) {
      echo json_encode(array(
        'success' => true,
        'message' => 'Berhasil Update Tiket',
        'res' => "$id - $name - $price"
      ));
    } else {
      echo json_encode(array(
        'success' => false,
        'message' => 'Gagal saat Update Tiket',
      ));
    }
  } catch (\Throwable $th) {
    echo json_encode(array(
      'success' => false,
      'message' => 'Terjadi Kesalahan Saat Update Tiket',
    ));
  }
} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
  $id = esc_string($_GET['id']);

  try {
    $res = $mysqli->query("DELETE FROM ticket WHERE id='$id'");

    if ($res) {
      echo json_encode(array(
        'success' => true,
        'message' => 'Berhasil Mengahapus Tiket',
      ));
    } else {
      echo json_encode(array(
        'success' => false,
        'message' => 'Gagal Menghapus Tiket',
      ));
    }
  } catch (\Throwable $th) {
    echo json_encode(array(
      'success' => false,
      'message' => 'Terjadi Kesalahan Saat Menghapus Tiket',
      'data' => $th,
    ));
  }
} else {
  header("Location: /hewan");
}
