
<?php
//listar.php
require "db.php";
$stmt = $pdo->query("SELECT * FROM curriculos WHERE status = 1 ORDER BY id DESC");
$curriculos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Currículos Salvos</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
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
