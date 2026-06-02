<?php
session_start();

$rol = strtolower(trim($_SESSION['rol'] ?? ''));

if ($rol !== 'administrador' && $rol !== 'director') {
    header("Location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel de Control</title>
    <link rel="stylesheet" href="../assets/css/stylos.css">
</head>

<body>

    <header>
        <img class="logo_principal" src="../assets/img/logo_banco.png" alt="Logo Corporativo">

        <h1>Panel Interno - Sistema Bancario</h1>
        <header>
            <p style="text-align:center;">
                Bienvenido <?= htmlspecialchars($_SESSION['nombre'] . ' ' . $_SESSION['apellidos']) ?>
                (<?= htmlspecialchars($_SESSION['rol']) ?>)
            </p>

            <nav id="menu_navegacion">
                <a href="operaciones.php">Operaciones</a>

                <?php if ($rol === 'director'): ?>
                    <!-- Ejemplo: director tiene más permisos -->
                    <a href="insertar_operacion.php">Nueva operación</a>
                <?php endif; ?>

                <a href="logout.php">Salir</a>
            </nav>
        </header>
    </header>

    <main>
        <h2>Bienvenido al sistema</h2>
        <p>Seleccione una opción del menú:</p>

        <nav id="menu_navegacion">
            <ul>
                <li><a href="operaciones.php">Gestión de Operaciones</a></li>
                <li><a href="usuarios.php">Gestión de Usuarios</a></li>
                <li><a href="login.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </main>

    <footer>
        <p>Proyecto intermodular DAW - 1º Curso</p>
    </footer>

</body>

</html>