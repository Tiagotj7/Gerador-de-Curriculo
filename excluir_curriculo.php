<?php
// excluir_curriculo.php
require "db.php";

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM curriculos WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: listar.php");
exit;