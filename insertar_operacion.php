<?php
session_start();
require_once '../config/db.php';

$rol = strtolower(trim($_SESSION['rol'] ?? ''));

// Solo Director puede entrar
if ($rol !== 'director') {
    header("Location: operaciones.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $estado = trim($_POST['estado'] ?? 'Pendiente');

    if ($titulo === '' || $descripcion === '') {
        $error = "Rellena título y descripción.";
    } else {
        $sql = "INSERT INTO operaciones (titulo, descripcion, estado, id_usuario)
                VALUES (:titulo, :descripcion, :estado, :id_usuario)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':titulo' => $titulo,
            ':descripcion' => $descripcion,
            ':estado' => $estado,
            ':id_usuario' => (int)($_SESSION['id_usuario'] ?? 0)
        ]);

        header("Location: operaciones.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Insercion de operaciones</title>
    <link rel="stylesheet" href="../assets/css/stylos.css">
</head>
<body>

<main style="max-width:600px; margin:30px auto;">
  <h1>Nueva operación</h1>

  <?php if ($error): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
  <?php endif; ?>

  <form method="POST">
    <label>Título</label><br>
    <input type="text" name="titulo" required style="width:100%;"><br><br>

    <label>Descripción</label><br>
    <textarea name="descripcion" required style="width:100%; height:120px;"></textarea><br><br>

    <label>Estado</label><br>
    <select name="estado">
      <option value="Pendiente">Pendiente</option>
      <option value="En proceso">En proceso</option>
      <option value="Finalizada">Finalizada</option>
    </select><br><br>

    <button type="submit">Guardar</button>
    <a href="operaciones.php" style="margin-left:10px;">Cancelar</a>
  </form>
</main>

</body>
</html>