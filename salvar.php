<?php
session_start();
require "db.php";

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

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

$stmt = $pdo->prepare("INSERT INTO curriculos (
    nome, 
    email, 
    telefone, 
    endereco, 
    formacao, 
    experiencia, 
    habilidades, 
    foto, 
    id_usuario,
    status
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 1)");

$stmt->execute([
    $_POST['nome'],
    $_POST['email'],
    $_POST['telefone'],
    $_POST['endereco'],
    $_POST['formacao'],
    $_POST['experiencia'],
    $_POST['habilidades'],
    $fotoPath,
    $_SESSION['id_usuario']
]);

header("Location: listar.php");
exit;
?>
