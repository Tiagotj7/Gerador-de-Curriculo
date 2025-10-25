<?php
// visualizar.php
require "db.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) die("ID inválido");

$stmt = $pdo->prepare("SELECT * FROM curriculos WHERE id = ?");
$stmt->execute([$id]);
$c = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$c) die("Currículo não encontrado");
?>
<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Currículo — <?= htmlspecialchars($c['nome']) ?></title>
<style>
  body {
    font-family: Arial, Helvetica, sans-serif;
    color: #222;
    background: #fff;
    padding: 28px;
  }
  .card {
    max-width: 800px;
    margin: 0 auto;
    border: 1px solid #eee;
    padding: 24px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
  }
  .header {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 15px;
  }
  .foto {
    width: 120px;
    height: 120px;
    border-radius: 10px;
    object-fit: cover;
    border: 2px solid #1fb16a;
  }
  h1 {
    color: #1fb16a;
    margin: 0 0 6px;
  }
  .meta p {
    margin: 4px 0;
    color: #555;
  }
  hr {
    border: none;
    border-top: 1px solid #ddd;
    margin: 14px 0;
  }
  .section {
    margin-bottom: 12px;
  }
  .section h3 {
    color: #1fb16a;
    margin-bottom: 5px;
  }
  .btns {
    display: flex;
    gap: 8px;
    margin-bottom: 12px;
    flex-wrap: wrap;
  }
  .btn {
    display: inline-block;
    padding: 10px 14px;
    border-radius: 8px;
    text-decoration: none;
    border: 1px solid #1fb16a;
    color: #042;
    background: linear-gradient(90deg, #06b337, #00e0a8);
    cursor: pointer;
    white-space: nowrap;
  }
  .btn.voltar {
    background: transparent;
    color: #06b337;
    border: 1px solid #06b337;
  }
  @media print {
    .btns { display: none; }
    body { padding: 0; }
    .card { border: none; box-shadow: none; }
  }
</style>
</head>
<body>
  <div class="card">
    <div class="btns">
      <button class="btn" onclick="window.print()">Imprimir PDF</button>
      <a href="gerar_word.php?id=<?= $c['id'] ?>" class="btn">Baixar Word</a>
      <a href="listar.php" class="btn voltar">Voltar</a>
    </div>

    <div class="header">
      <?php if (!empty($c['foto'])): ?>
        <img src="uploads/<?= htmlspecialchars($c['foto']) ?>" alt="Foto de perfil" class="foto">
      <?php else: ?>
        <img src="uploads/sem-foto.png" alt="Sem foto" class="foto">
      <?php endif; ?>

      <div>
        <h1><?= htmlspecialchars($c['nome']) ?></h1>
        <div class="meta">
          <p><strong>Email:</strong> <?= htmlspecialchars($c['email']) ?></p>
          <p><strong>Telefone:</strong> <?= htmlspecialchars($c['telefone']) ?></p>
          <p><strong>Endereço:</strong> <?= htmlspecialchars($c['endereco']) ?></p>
        </div>
      </div>
    </div>

    <hr>

    <div class="section">
      <h3>Formação</h3>
      <p><?= nl2br(htmlspecialchars($c['formacao'])) ?></p>
    </div>

    <div class="section">
      <h3>Experiência</h3>
      <p><?= nl2br(htmlspecialchars($c['experiencia'])) ?></p>
    </div>

    <div class="section">
      <h3>Habilidades</h3>
      <p><?= nl2br(htmlspecialchars($c['habilidades'])) ?></p>
    </div>


  </div>
</body>
</html>
