<?php
include '../../includes/auth_check.php';
include '../../config/db.php';

$id = $_GET['id'];
$conn->query("DELETE FROM maintenance WHERE id = $id");

header("Location: list.php");
exit;
?>
