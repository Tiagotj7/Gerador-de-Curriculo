<?php
// excluir.php
require "db.php";

if (!isset($_GET['id'])) {
  header("Location: listar.php");
  exit;
}

$id = (int) $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
$stmt->execute([$id]);

header("Location: listar.php");
exit;
?>
