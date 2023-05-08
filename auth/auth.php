<?php
session_start();
$uri = $_SERVER['REQUEST_URI'];
if (isset($_POST['logout'])) {
  echo "<script>alert('Berhasil Logout')</script>";
  session_destroy();
  session_unset();
  header("Location: /auth");
}
