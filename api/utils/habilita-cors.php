<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST,OPTIONS');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Credentials: false');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  echo "OK";
  exit();
}

//ini_set('display_errors', 0);
?>