<?php
require('../../config.php');

header('Content-Type: application/json');
header('Content-Type: multipart/form-data');
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Methods: DELETE");

function random_filename($length, $directory = '', $extension = '') {
  // default to this files directory if empty...
  $dir = !empty($directory) && is_dir($directory) ? $directory : dirname(__FILE__);

  do {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
      $key .= $keys[array_rand($keys)];
    }
  } while (file_exists($dir . '/' . $key . (!empty($extension) ? '.' . $extension : '')));

  return $key . (!empty($extension) ? '.' . $extension : '');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = esc_string($_POST['name']);
  $desc = esc_string($_POST['desc']);
  $id = isset($_POST['id']) ? esc_string($_POST['id']) : null;
  $isUpdate = isset($_POST['id']) != NULL;

  if (isset($_FILES['image']) || $isUpdate) {
    $file_name = isset($_FILES['image']['name']) ? $_FILES['image']['name'] : null;
    $file_size = isset($_FILES['image']['size']) ? $_FILES['image']['size'] : null;
    $file_tmp = isset($_FILES['image']['tmp_name']) ?  $_FILES['image']['tmp_name'] : null;
    $file_type = isset($_FILES['image']['type']) ? $_FILES['image']['type'] : null;
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
    $filename = random_filename(30, __DIR__ . '/assets/images', $file_ext);

    try {
      $moved = $file_name ? move_uploaded_file($file_tmp, "../../assets/images/" . $filename) : true;
      $res = false;

      if ($isUpdate) {
        if ($file_name) {
          $animal_old = query("SELECT image FROM animal WHERE id='$id'");
          unlink(".." . $animal_old['image']);
        }
        $res = $mysqli->query("UPDATE animal SET name='$name' " . ($file_name ? ", image='/assets/images/$filename'" : "")  . " WHERE id='$id'");
        $mysqli->query("UPDATE animal_detail SET description='$desc' WHERE id='$id'");
      } else {
        $res = $mysqli->query("INSERT INTO animal (name, image) VALUES ('$name', '/assets/images/$filename')");
        $idd = mysqli_insert_id($mysqli);
        $mysqli->query("INSERT INTO animal_detail (id, description) VALUES ('$idd', '$desc')");
      }

      if ($moved) {
        echo json_encode(array(
          'success' => true,
          'message' =>  "Berhasil " . ($isUpdate ? "Merubah" : "Menambah") .  " Data Satwa",
        ));
        return;
      } else {
        echo json_encode(array(
          'success' => false,
          'message' =>  "Gagal " . ($isUpdate ? "Merubah" : "Menambah") .  " Data Satwa",
        ));
        return;
      }
    } catch (\Throwable $th) {
      echo json_encode(array(
        'success' => false,
        'message' =>  "Terjadi Kesalahan Saat " . ($isUpdate ? "Merubah" : "Menambah") .  " Data Satwa" . $th,
      ));
      return;
    }
  } else {
    echo json_encode(array(
      'success' => false,
      'message' => 'Tolong Upload Gambar'
    ));
    return;
  }
} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
  $id = esc_string($_GET['id']);

  try {
    $res = $mysqli->query("DELETE FROM animal WHERE id='$id'");

    if ($res) {
      echo json_encode(array(
        'success' => true,
        'message' => 'Berhasil Menghapus Satwa',
      ));
    } else {
      echo json_encode(array(
        'success' => false,
        'message' => 'Gagal Menghapus Satwa',
      ));
    }
  } catch (\Throwable $th) {
    echo json_encode(array(
      'success' => false,
      'message' => 'Terjadi Kesalahan Saat Menghapus Satwa',
      'data' => $th,
    ));
  }
} else {
  header("Location: /hewan");
}
