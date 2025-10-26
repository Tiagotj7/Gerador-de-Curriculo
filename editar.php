<?php
// editar.php
require "db.php";

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM curriculos WHERE id = ?");
    $stmt->execute([$id]);
    $curriculo = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mantém a foto atual se nenhuma nova for enviada
    $foto_nome = $curriculo['foto'];
    
    // Processa a foto se uma nova for enviada
    if (!empty($_FILES['foto']['name'])) {
        $foto = $_FILES['foto'];
        $foto_nome = time() . '_' . $foto['name'];
        move_uploaded_file($foto['tmp_name'], 'uploads/' . $foto_nome);
    }
    
    $stmt = $pdo->prepare("UPDATE curriculos SET 
        nome = ?,
        email = ?,
        telefone = ?,
        endereco = ?,
        formacao = ?,
        experiencia = ?,
        habilidades = ?,
        foto = ?
        WHERE id = ?");
    
    $stmt->execute([
        $_POST['nome'],
        $_POST['email'],
        $_POST['telefone'],
        $_POST['endereco'],
        $_POST['formacao'],
        $_POST['experiencia'],
        $_POST['habilidades'],
        $foto_nome,
        $_POST['id']
    ]);

    header("Location: listar.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Currículo</title>
      <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="style.css">
    <style>
    .foto-area {
        width: 120px;
        height: 120px;
        border-radius: 10px;
        border: 2px solid #007bff;
        background: #2c2c2c;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        margin: 0 auto 15px auto;
    }
    .foto-area img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .foto-input {
        text-align: center;
        margin-bottom: 15px;
    }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Currículo</h1>
        
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $curriculo['id'] ?>">
            
            <div class="foto-input">
                <div class="foto-area" id="preview">
                    <img id="fotoPreview" src="<?= $curriculo['foto'] ? 'uploads/' . $curriculo['foto'] : 'uploads/sem-foto.png' ?>" alt="Foto de perfil">
                </div>
                <input type="file" name="foto" id="foto" accept="image/*">
            </div>

            <label>Nome completo:</label>
            <input type="text" name="nome" value="<?= htmlspecialchars($curriculo['nome']) ?>" required>
            
            <label>Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($curriculo['email']) ?>" required>
            
            <label>Telefone:</label>
            <input type="text" name="telefone" value="<?= htmlspecialchars($curriculo['telefone']) ?>" required>
            
            <label>Endereço:</label>
            <input type="text" name="endereco" value="<?= htmlspecialchars($curriculo['endereco']) ?>" required>
            
            <label>Formação:</label>
            <textarea name="formacao" required><?= htmlspecialchars($curriculo['formacao']) ?></textarea>
            
            <label>Experiências:</label>
            <textarea name="experiencia" required><?= htmlspecialchars($curriculo['experiencia']) ?></textarea>
            
            <label>Habilidades:</label>
            <textarea name="habilidades" required><?= htmlspecialchars($curriculo['habilidades']) ?></textarea>
            
            <button type="submit">Salvar Alterações</button>
            <a href="listar.php" class="btn">Cancelar</a>
        </form>
    </div>

    <script>
    document.getElementById('foto').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(ev) {
                document.getElementById('fotoPreview').src = ev.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
    </script>
</body>
</html>
