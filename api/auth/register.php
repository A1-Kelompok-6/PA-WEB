<?php
require('../../config.php');
header('Content-Type: application/assets/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = esc_string($_POST['name']);
  $email = esc_string($_POST['email']);
  $pass = hash('sha256', esc_string($_POST['pass']));

  $q = $mysqli->query("SELECT * FROM user WHERE email='$email'");

  if (mysqli_num_rows($q) != 0) {
    echo json_encode(array(
      'success' => false,
      'message' => 'Email Sudah Terdaftar'
    ));
    return;
  }

  $res = $mysqli->query("INSERT INTO user (name, email, password, role) VALUES ('$name', '$email', '$pass', 'user')");
  $id = mysqli_insert_id($mysqli);
  $mysqli->query("INSERT INTO user_detail (id) VALUES ('$id')");

  if ($res) {
    echo json_encode(array(
      'success' => true,
      'message' => 'Berhasil Mendaftar',
      'res' => $res
    ));
  } else {
    echo json_encode(array('success' => false, 'message' => 'Terjadi Kesalahan Saat Daftar', 'error' => $res));
  }
} else {
  header("Location: /auth");
}
