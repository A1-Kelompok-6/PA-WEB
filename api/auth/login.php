<?php
require('../../config.php');
header('Content-Type: application/assets/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = esc_string($_POST['email']);
  $pass = hash('sha256', esc_string($_POST['pass']));

  $user = query("SELECT *  FROM user where email='$email' and password='$pass'");

  if ($user) {
    $res = array(
      'success' => true,
      'message' => 'Berhasil Login',
      'id' => $user['id'],
      'name' => $user['name'],
      'email' => $user['email'],
      'role' => $user['role']
    );
    echo json_encode($res);
  } else {
    echo json_encode(array('status' => 404, 'message' => 'Gagal Login', 'email' => $_POST));
  }
} else {
  header("Location: /auth");
}
