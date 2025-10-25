<?php
// status_usuarios.php
require "db.php";

if (!isset($_GET['id']) || !isset($_GET['status'])) {
  header("Location: listar_usuarios.php");
  exit;
}

$id = (int) $_GET['id'];
$status = (int) $_GET['status'];
$novoStatus = $status == 1 ? 0 : 1;

$stmt = $pdo->prepare("UPDATE usuarios SET status = ? WHERE id = ?");
$stmt->execute([$novoStatus, $id]);

header("Location: listar_usuarios.php");
exit;
?>
