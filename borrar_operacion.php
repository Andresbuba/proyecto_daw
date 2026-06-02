<?php
session_start();
require_once '../config/db.php';

$rol = strtolower(trim($_SESSION['rol'] ?? ''));

// Solo Director puede borrar
if ($rol !== 'director') {
    header("Location: operaciones.php");
    exit;
}

$id = (int)($_GET['id'] ?? 0);

if ($id > 0) {
    $sql = "DELETE FROM operaciones WHERE id_operacion = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
}

header("Location: operaciones.php");
exit;