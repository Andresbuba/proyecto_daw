<?php
session_start();
require_once '../config/db.php';

$rol = strtolower(trim($_SESSION['rol'] ?? ''));
if ($rol !== 'cliente') {
    header("Location: login.php");
    exit;
}

$id_cliente = (int)($_SESSION['id_usuario'] ?? 0);
if ($id_cliente <= 0) {
    header("Location: login.php");
    exit;
}

$sql = "SELECT id_operacion, titulo, descripcion, fecha_creacion, estado
        FROM operaciones
        WHERE id_usuario = :id_usuario
        ORDER BY fecha_creacion DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id_usuario' => $id_cliente]);
$ops = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi historial</title>
    <link rel="stylesheet" href="../assets/css/stylos.css">
</head>
<body>

<header>
    <nav id="menu_navegacion">
        <a href="clientes_dashboard.php">Zona clientes</a>
        <a href="clientes_historial.php">Mi historial</a>
        <a href="contacto_agente.php">Contactar</a>
        <a href="logout.php">Salir</a>
    </nav>
</header>

<main style="max-width:900px; margin:30px auto;">
    <h1 style="text-align:center;">Mi historial de operaciones</h1>

    <?php if (empty($ops)): ?>
        <p style="text-align:center;">No tienes operaciones registradas.</p>
    <?php else: ?>
        <?php foreach ($ops as $op): ?>
            <div style="background:white; padding:15px; border-radius:8px; margin:15px 0;">
                <h3><?= htmlspecialchars($op['titulo']) ?></h3>
                <p><?= nl2br(htmlspecialchars($op['descripcion'])) ?></p>
                <small>
                    Estado: <?= htmlspecialchars($op['estado']) ?> |
                    Fecha: <?= htmlspecialchars($op['fecha_creacion']) ?>
                </small>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</main>

<footer>
    <p style="text-align:center;">Zona clientes - Proyecto DAW</p>
</footer>

</body>
</html>