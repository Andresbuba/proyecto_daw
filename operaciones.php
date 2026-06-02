<?php
session_start();
require_once '../config/db.php';

// Si no hay sesión, fuera
if (!isset($_SESSION['rol'])) {
    header("Location: login.php");
    exit;
}

$rol = strtolower(trim($_SESSION['rol']));
$esDirector = ($rol === 'director');
$esAdmin = ($rol === 'administrador');

// Solo roles internos permitidos
if (!$esDirector && !$esAdmin) {
    header("Location: login.php");
    exit;
}

// Traer operaciones
$sql = "SELECT id_operacion, titulo, descripcion, fecha_creacion, estado
        FROM operaciones
        ORDER BY fecha_creacion DESC";
$stmt = $pdo->query($sql);
$operaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name= "description" content = "Este es el proyecto de primero de DAW">
    <Meta name= "author" content="Andres Sanchez">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href = "../assets/css/stylos.css">

    <title>Proyecto intermodular</title>
</head>
<body>
   
    <header>
        <nav id= "menu_navegacion">
    <a href="index.php">Inicio</a>
    <a href="login.php">Login</a>
    </nav>
    </header>
    <main>
     <h1 style="text-align:center;">Operaciones</h1>

  <?php if ($esDirector): ?>
    <p style="text-align:center;">
      <a href="insertar_operacion.php">+ Nueva operación</a>
    </p>
  <?php endif; ?>

  <?php foreach ($operaciones as $op): ?>
    <div style="background:#fff; padding:15px; border-radius:8px; margin:15px 0;">
      <h3><?= htmlspecialchars($op['titulo']) ?></h3>
      <p><?= nl2br(htmlspecialchars($op['descripcion'])) ?></p>
      <small>
        Estado: <?= htmlspecialchars($op['estado']) ?> |
        Fecha: <?= htmlspecialchars($op['fecha_creacion']) ?>
      </small>

      <?php if ($esDirector): ?>
        <div style="margin-top:10px;">
          <a href="borrar_operacion.php?id=<?= (int)$op['id_operacion'] ?>"
             onclick="return confirm('¿Seguro que quieres borrar esta operación?');">
             Borrar
          </a>
        </div>
      <?php endif; ?>
    </div>
  <?php endforeach; ?>
    </main>
    <footer>

    </footer>
</body>
</html>