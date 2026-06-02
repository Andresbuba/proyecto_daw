<?php
session_start();

$rol = strtolower(trim($_SESSION['rol'] ?? ''));
if ($rol !== 'cliente') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contactar con un agente</title>
  <link rel="stylesheet" href="../assets/css/stylos.css">
</head>
<body>

<header>
  <nav id="menu_navegacion">
    <a href="clientes_dashboard.php">Zona clientes</a>
    <a href="clientes_historial.php">Mi historial</a>
    <a href="logout.php">Salir</a>
  </nav>
</header>

<main style="max-width:900px; margin:30px auto;">
  <h1 style="text-align:center;">Contactar con un agente</h1>

  <section style="background:white; padding:15px; border-radius:8px; margin:15px 0;">
    <h3>Contacto rápido</h3>
    <p><strong>Teléfono:</strong> <a href="tel:+34900123456">900 123 456</a></p>
    <p><strong>Email:</strong> <a href="mailto:soporte@bancocorporativo.local">soporte@bancocorporativo.local</a></p>
    <p><strong>Horario:</strong> Lunes a Viernes, 9:00 a 18:00</p>
    <p><strong>Atención:</strong> Consultas generales y soporte de operaciones.</p>
  </section>

  <section style="background:white; padding:15px; border-radius:8px; margin:15px 0;">
  <h3>Enviar un mensaje</h3>

  <form method="POST" action="contacto_agente.php">
    
    <label>Asunto</label><br>
    <input type="text" name="asunto" style="width:100%;" required><br><br>

    <label>Mensaje</label><br>
    <textarea name="mensaje" style="width:100%; height:120px;" required></textarea><br><br>

    <button type="submit">Enviar</button>

  </form>
</section>

</main>

<footer>
  <p style="text-align:center;">Zona clientes - Proyecto DAW</p>
</footer>

</body>
</html>