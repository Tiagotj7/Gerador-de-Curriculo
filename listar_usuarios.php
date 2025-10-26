<?php
// listar_usuarios.php
require "db.php";
$stmt = $pdo->query("SELECT * FROM usuarios ORDER BY id DESC");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Lista de Usuários</title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
  <h1>Lista de Usuários</h1>
  <table>
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>Email</th>
      <th>Status</th>
      <th>Ações</th>
    </tr>
    <?php foreach ($usuarios as $u): ?>
    <tr>
      <td><?= $u['id'] ?></td>
      <td><?= htmlspecialchars($u['nome']) ?></td>
      <td><?= htmlspecialchars($u['email']) ?></td>
      <td><?= $u['status'] ? 'Ativo' : 'Inativo' ?></td>
      <td>
        <a href="status_usuarios.php?id=<?= $u['id'] ?>&status=<?= $u['status'] ?>">
          <?= $u['status'] ? 'Desativar' : 'Ativar' ?>
        </a>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
</div>
</body>
</html>
