<?php
// desativar_curriculo.php
require "db.php";

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("UPDATE curriculos SET status = 0 WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: listar.php");
exit;