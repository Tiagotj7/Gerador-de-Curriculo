<?php
require "db.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) die("ID inválido");

$stmt = $pdo->prepare("SELECT * FROM curriculos WHERE id = ?");
$stmt->execute([$id]);
$c = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$c) die("Currículo não encontrado");

// Cabeçalhos do Word
header("Content-Type: application/vnd.ms-word; charset=utf-8");
header("Content-Disposition: attachment; filename=curriculo_" . preg_replace('/\s+/', '_', $c['nome']) . ".doc");
header("Pragma: no-cache");
header("Expires: 0");

// Caminho e conversão da foto
$caminhoFoto = !empty($c['foto']) ? "uploads/" . $c['foto'] : "uploads/sem-foto.png";
$fotoBase64 = '';
if (file_exists($caminhoFoto)) {
    $dadosImagem = file_get_contents($caminhoFoto);
    $ext = pathinfo($caminhoFoto, PATHINFO_EXTENSION);
    $mime = ($ext === 'jpg' || $ext === 'jpeg') ? 'image/jpeg' : 'image/png';
    $fotoBase64 = 'data:' . $mime . ';base64,' . base64_encode($dadosImagem);
}

// Documento Word em formato HTML reconhecido
echo '<html xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:w="urn:schemas-microsoft-com:office:word"
xmlns="http://www.w3.org/TR/REC-html40">
<head>
<meta charset="utf-8">
<title>Currículo - ' . htmlspecialchars($c['nome']) . '</title>
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
  .section h3 {
    color: #1fb16a;
    margin-bottom: 5px;
  }
</style>
</head>
<body>
  <div class="card">
    <div class="header">';

if ($fotoBase64) {
    echo '<img src="' . $fotoBase64 . '" alt="Foto de perfil" class="foto">';
}

echo '
      <div>
        <h1>' . htmlspecialchars($c['nome']) . '</h1>
        <div class="meta">
          <p><strong>Email:</strong> ' . htmlspecialchars($c['email']) . '</p>
          <p><strong>Telefone:</strong> ' . htmlspecialchars($c['telefone']) . '</p>
          <p><strong>Endereço:</strong> ' . htmlspecialchars($c['endereco']) . '</p>
        </div>
      </div>
    </div>

    <hr>

    <div class="section">
      <h3>Formação</h3>
      <p>' . nl2br(htmlspecialchars($c['formacao'])) . '</p>
    </div>

    <div class="section">
      <h3>Experiência</h3>
      <p>' . nl2br(htmlspecialchars($c['experiencia'])) . '</p>
    </div>

    <div class="section">
      <h3>Habilidades</h3>
      <p>' . nl2br(htmlspecialchars($c['habilidades'])) . '</p>
    </div>
  </div>
</body>
</html>';
?>
