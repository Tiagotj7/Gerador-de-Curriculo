<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Gerador de Currículos</title>
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
  <h1>Gerador de Currículos</h1>

  <form id="f" action="salvar.php" method="POST" enctype="multipart/form-data">
    <div class="foto-input">
      <div class="foto-area" id="preview">
        <img id="fotoPreview" src="uploads/sem-foto.png" alt="Foto de perfil">
      </div>
      <input type="file" name="foto" id="foto" accept="image/*">
    </div>

    <label>Nome completo:</label>
    <input type="text" name="nome" required>

    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Telefone:</label>
    <input type="text" name="telefone" required>

    <label>Endereço:</label>
    <input type="text" name="endereco" required>

    <label>Formação:</label>
    <textarea name="formacao" required></textarea>

    <label>Experiências:</label>
    <textarea name="experiencia" required></textarea>

    <label>Habilidades:</label>
    <textarea name="habilidades" required></textarea>

    <button type="submit">Salvar Currículo</button>
  </form>

  <a href="listar.php" class="btn">Ver Currículos</a>
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
