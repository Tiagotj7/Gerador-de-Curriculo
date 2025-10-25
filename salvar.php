<?php
// salvar.php
require "db.php";

$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$endereco = $_POST['endereco'];
$formacao = $_POST['formacao'];
$experiencia = $_POST['experiencia'];
$habilidades = $_POST['habilidades'];

$fotoPath = null;

if (!empty($_FILES['foto']['name'])) {
    $dir = "uploads/";
    if (!is_dir($dir)) mkdir($dir, 0777, true);

    $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $nomeArquivo = uniqid("foto_") . "." . strtolower($ext);
    $caminho = $dir . $nomeArquivo;

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $caminho)) {
        $fotoPath = $caminho;
    }
}

$stmt = $pdo->prepare("INSERT INTO curriculos 
(nome, foto, email, telefone, endereco, formacao, experiencia, habilidades, criado_em, status)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), 1)");
$stmt->execute([$nome, $fotoPath, $email, $telefone, $endereco, $formacao, $experiencia, $habilidades]);

header("Location: listar.php");
exit;
?>
