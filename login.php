<?php
session_start();

// Mostrar errores (solo desarrollo)
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../config/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id_usuario = trim($_POST['id_usuario'] ?? '');
    $password   = trim($_POST['password'] ?? '');

    if ($id_usuario === '' || $password === '') {
        $error = "Rellena todos los campos.";
    } else {

        // Traemos datos del usuario + nombre del rol
        $sql = "
            SELECT u.id_usuario, u.nombre, u.apellidos, u.password, r.nombre_rol
            FROM usuarios u
            INNER JOIN roles r ON u.id_rol = r.id_rol
            WHERE u.id_usuario = :id_usuario
            LIMIT 1
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id_usuario' => $id_usuario]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Contraseña en texto plano (por ahora)
        if ($usuario && $password === $usuario['password']) {

            // Guardamos sesión
            $_SESSION['id_usuario'] = (int)$usuario['id_usuario'];
            $_SESSION['nombre']     = $usuario['nombre'];
            $_SESSION['apellidos']  = $usuario['apellidos'];
            $_SESSION['rol']        = $usuario['nombre_rol'];

            // Normalizamos rol
            $rol = strtolower(trim($usuario['nombre_rol']));

            // Redirección según rol
            if ($rol === 'administrador' || $rol === 'director') {
                header("Location: dashboard.php");
                exit;
            }

            if ($rol === 'cliente') {
                header("Location: clientes_dashboard.php");
                exit;
            }

            // Si no es ninguno (rol raro)
            $error = "Tu rol no tiene acceso a ninguna zona.";
        } else {
            $error = "ID o contraseña incorrectos.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Este es el proyecto de primero de DAW">
    <Meta name="author" content="Andres Sanchez">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/stylos.css">

    <title>Proyecto intermodular</title>
</head>

<body>
    <?php if (!empty($error)): ?>
        <p style="color:red; text-align:center;">
            <?= htmlspecialchars($error) ?>
        </p>
    <?php endif; ?>
    <header>
        <img class="logo_principal" src="../assets/img/logo_banco.png" alt="Logo Corporativo">

        <nav id="menu_navegacion">
            <a href="index.php">Inicio</a>
        </nav>
    </header>
    <main>
        <form method="POST" style="width:320px; margin:30px auto; text-align:center;">
            <label>ID Usuario</label><br>
            <input type="number" name="id_usuario" required><br><br>

            <label>Contraseña</label><br>
            <input type="password" name="password" required><br><br>

            <button type="submit">Entrar</button>
        </form>

    </main>
    <footer>

    </footer>
</body>

</html>