<?php
$conn = new mysqli('localhost', 'root', '', 'simaja');
if ($conn->connect_error) die('Koneksi ke database gagal: ' . $conn->connect_error);
?>
