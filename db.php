<?php
//db.php
$pdo = new PDO("mysql:host=localhost:3307;dbname=db_curriculo;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
