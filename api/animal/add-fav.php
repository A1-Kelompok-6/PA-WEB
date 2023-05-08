<?php
require('../../config.php');

header('Content-Type: application/assets/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $animalID = esc_string($_POST['animalID']);
  $userID = esc_string($_POST['userID']);

  try {
    $query = $mysqli->query("SELECT count(*) as total, id from fav_animal WHERE animal_id='$animalID' AND user_id='$userID'");
    $data = mysqli_fetch_assoc($query);

    $res = null;

    if ($data['total'] > 0) {
      $id = $data['id'];
      $res = $mysqli->query("DELETE FROM fav_animal WHERE id='$id'");
    } else {
      $res = $mysqli->query("INSERT INTO fav_animal (animal_id, user_id) VALUES ('$animalID', '$userID')");
    }

    if ($res) {
      echo json_encode(array(
        'success' => true,
        'message' => 'Berhasil Menambahkan Favorit'
      ));
    } else {
      echo json_encode(array(
        'success' => false,
        'message' => 'Terjadi Kesalahan',
        'id' => $data['id']
      ));
    }
  } catch (\Throwable $th) {
    echo json_encode(array(
      'success' => false,
      'message' => 'Terjadi Kesalahan',
    ));
  }
} else {
  header("Location: /hewan");
}
