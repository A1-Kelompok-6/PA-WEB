<?php
$host = 'localhost';
$username = 'root';
$passwd = ''; /* Ubah Ini */
$db = 'zooweb';

$mysqli = mysqli_connect($host, $username, $passwd, $db);
global $mysqli;

function query($query) {

  global $mysqli;
  $query = $mysqli->query($query);
  $res = mysqli_fetch_array($query);

  return $res;
}

function queryAll($query) {

  global $mysqli;
  $query = $mysqli->query($query);
  $res = mysqli_fetch_all($query);

  return $res;
}

function esc_string($field) {
  global $mysqli;
  $res = mysqli_real_escape_string($mysqli, $field);
  return $res;
}

function currency($num) {
  return "Rp " . number_format($num, 0, ',', '.');
}

function randomFilename($length, $directory = '', $extension = '') {
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

if (!$mysqli) {
  die("Connection Failed" . mysqli_connect_error());
}

session_start();
