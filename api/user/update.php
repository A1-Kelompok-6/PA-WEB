<?php
require('../../config.php');
header('Content-Type: application/json');
header('Content-Type: multipart/form-data');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = esc_string($_POST['id']);
  $name = esc_string($_POST['name']);
  $address = esc_string($_POST['address']);
  $phone = esc_string($_POST['phone']);
  $description = esc_string($_POST['description']);

  try {
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

    $extensions = array("jpeg", "jpg", "png");

    if (!in_array($file_ext, $extensions) && $file_name) {
      echo json_encode(array(
        'success' => false,
        'message' => 'Ekstensi File harus jpeg, jpg, atau png'
      ));
      return;
    }

    if ($file_size > 2097152 && $file_name) {
      echo json_encode(array(
        'success' => false,
        'message' => 'Gambar Tidak Boleh Lebih dari 2MB'
      ));
      return;
    }

    $filename = randomFilename(30, __DIR__ . '/assets/images', $file_ext);

    $moved = $file_name ? move_uploaded_file($file_tmp, "../../assets/images/" . $filename) : true;

    $res = false;

    if ($moved) {
      $mysqli->query("UPDATE user SET name='$name' WHERE id='$id'");
      $queryImage =  $file_name ? ", image='/assets/images/$filename'" : "";

      $res_detail = $mysqli->query("UPDATE user_detail SET address='$address', phone='$phone', description='$description' $queryImage WHERE id='$id'");
      $res = $res_detail;
    }

    if ($res) {
      echo json_encode(array(
        'success' => true,
        'message' =>  "Berhasil Update Profile"
      ));
      return;
    } else {
      echo json_encode(array(
        'success' => false,
        'message' =>  "Gagal Update Profile"
      ));
      return;
    }
  } catch (\Throwable $th) {
    echo json_encode(array(
      'success' => false,
      'message' =>  "Terjadi Kesalahan Saat Update Profile" . $th
    ));
    return;
  }
} else {
  header("Location: /");
}
