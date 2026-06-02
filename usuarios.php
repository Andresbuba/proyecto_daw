<?php
session_start();
require_once '../config/db.php';

$rol = strtolower(trim($_SESSION['rol'] ?? ''));

// SOLO DIRECTOR
if ($rol !== 'director') {
    header("Location: dashboard.php");
    exit;
}

/* BORRAR USUARIO */
if (isset($_GET['borrar'])) {
    $id_borrar = (int)$_GET['borrar'];

    $sql = "DELETE FROM usuarios WHERE id_usuario = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id_borrar]);

    header("Location: usuarios.php");
    exit;
}

/* CREAR USUARIO */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = trim($_POST['nombre'] ?? '');
    $apellidos = trim($_POST['apellidos'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $id_rol = (int)($_POST['id_rol'] ?? 0);

    if ($nombre && $apellidos && $password && $id_rol > 0) {

        $sql = "INSERT INTO usuarios (nombre, apellidos, password, id_rol)
                VALUES (:nombre, :apellidos, :password, :id_rol)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nombre' => $nombre,
            ':apellidos' => $apellidos,
            ':password' => $password,
            ':id_rol' => $id_rol
        ]);

        header("Location: usuarios.php");
        exit;
    }
}

/* LISTAR USUARIOS */
$sql = "
    SELECT u.id_usuario, u.nombre, u.apellidos, r.nombre_rol
    FROM usuarios u
    INNER JOIN roles r ON u.id_rol = r.id_rol
    ORDER BY u.id_usuario ASC
";
$stmt = $pdo->query($sql);
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* TRAER ROLES PARA EL SELECT */
$roles = $pdo->query("SELECT * FROM roles")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de usuarios</title>
    <link rel="stylesheet" href="../assets/css/stylos.css">
</head>
<body>

<header>
    <nav id="menu_navegacion">
        <a href="dashboard.php">Volver</a>
        <a href="logout.php">Salir</a>
    </nav>
</header>

<main style="max-width:1000px; margin:30px auto;">

<h1 style="text-align:center;">Gestión de Usuarios</h1>

<!-- LISTADO -->
<table border="1" cellpadding="10" style="width:100%; background:white;">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Rol</th>
        <th>Acción</th>
    </tr>

    <?php foreach ($usuarios as $usuario): ?>
        <tr>
            <td><?= $usuario['id_usuario'] ?></td>
            <td><?= htmlspecialchars($usuario['nombre']) ?></td>
            <td><?= htmlspecialchars($usuario['apellidos']) ?></td>
            <td><?= htmlspecialchars($usuario['nombre_rol']) ?></td>
            <td>
                <a href="usuarios.php?borrar=<?= $usuario['id_usuario'] ?>"
                   onclick="return confirm('¿Seguro que quieres borrar este usuario?');">
                   Borrar
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<br><br>

<!-- CREAR USUARIO -->
<h2>Crear nuevo usuario</h2>

<form method="POST" style="background:white; padding:15px; border-radius:8px;">
    
    <label>Nombre</label><br>
    <input type="text" name="nombre" required><br><br>

    <label>Apellidos</label><br>
    <input type="text" name="apellidos" required><br><br>

    <label>Contraseña</label><br>
    <input type="text" name="password" required><br><br>

    <label>Rol</label><br>
    <select name="id_rol" required>
        <option value="">Seleccionar rol</option>
        <?php foreach ($roles as $rol): ?>
            <option value="<?= $rol['id_rol'] ?>">
                <?= htmlspecialchars($rol['nombre_rol']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Crear usuario</button>

</form>

</main>

</body>
</html>