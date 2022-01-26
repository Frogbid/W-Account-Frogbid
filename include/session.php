<?php

session_start();

$id = $_SESSION['id'];
if ($id != true) {
  header('Location:index.php');
}