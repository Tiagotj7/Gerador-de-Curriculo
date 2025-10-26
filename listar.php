<?php
session_start(); // Inicia a sessão

// Verifica se usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

require "db.php";

// Busca apenas os currículos do usuário logado
$stmt = $pdo->prepare("SELECT * FROM curriculos WHERE id_usuario = ? AND status = 1 ORDER BY id DESC");
$stmt->execute([$_SESSION['id_usuario']]);
$curriculos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Processa o envio do formulário
if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['telefone']) && isset($_POST['endereco']) && isset($_POST['formacao']) && isset($_POST['experiencia']) && isset($_POST['habilidades']) && isset($_FILES['foto'])) {
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
        $nome_foto,
        $_SESSION['id_usuario']
    ]);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Currículos Salvos</title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<link rel="stylesheet" href="style.css">
<style>
/* estilo pequeno para alinhar o botão de logout */
.top-right { text-align: right; margin-bottom: 12px; }
.top-right a { color: #007bff; text-decoration: none; }
</style>
</head>
<body>
<div class="container">
  <!-- botão de logout -->
  <div class="top-right">
    Olá, <?= htmlspecialchars($_SESSION['nome'] ?? 'Usuário') ?> | <a href="logout.php">Sair</a>
  </div>

  <h1>Currículos Salvos</h1>
  <table>
    <tr>
      <th>Nome</th>
      <th>Email</th>
      <th>Telefone</th>
      <th>Ações</th>
    </tr>
    <?php foreach ($curriculos as $c): ?>
    <tr>
      <td><?= htmlspecialchars($c['nome']) ?></td>
      <td><?= htmlspecialchars($c['email']) ?></td>
      <td><?= htmlspecialchars($c['telefone']) ?></td>
      <td>
        <a href="editar.php?id=<?= $c['id'] ?>">Editar</a> |
        <a href="desativar_curriculo.php?id=<?= $c['id'] ?>" onclick="return confirm('Tem certeza que deseja desativar?')">
          Excluir
        </a> |
        <a href="visualizar.php?id=<?= $c['id'] ?>" target="_blank">Gerar PDF</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
  <a href="index.php" class="btn">Novo Currículo</a>
</div>
</body>
</html>
