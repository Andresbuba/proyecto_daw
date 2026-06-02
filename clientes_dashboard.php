<?php
session_start();
require_once '../config/db.php';

// Proteger acceso solo clientes
$rol = strtolower(trim($_SESSION['rol'] ?? ''));
if ($rol !== 'cliente') {
    header("Location: login.php");
    exit;
}

// CONSULTA FOTOS
$sql = "SELECT * FROM fotos ORDER BY fecha_subida DESC";
$stmt = $pdo->query($sql);
$fotos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zona clientes</title>
  <link rel="stylesheet" href="../assets/css/stylos.css">
</head>
<body>
    <h1 style="text-align:center;">Zona clientes</h1>

    <p style="text-align:center;">
  Hola <?= htmlspecialchars($_SESSION['nombre'] . ' ' . $_SESSION['apellidos']) ?>
</p>

    <nav id="menu_navegacion">
  <a href="clientes_historial.php">Mi historial</a>
  <a href="contacto_agente.php">Contactar con un agente</a>
  <a href="logout.php">Salir</a>
</nav>


        <div>
        <?php foreach ($fotos as $foto): ?>
            <div class= "bloque_foto">
                <h3><?= htmlspecialchars($foto['titulo']) ?></h3>
                <img class = "foto"
                    src="../assets/img/<?= htmlspecialchars($foto['direccion_archivo']) ?>"
                    alt="<?= htmlspecialchars($foto['titulo']) ?>">
                <small>Subida el <?= $foto['fecha_subida'] ?></small>
            </div>
        <?php endforeach; ?>
    </div>



</body>
</html>