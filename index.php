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
    <header>
        <img class="logo_principal" src="../assets/img/logo_banco.png" alt="Logo Corporativo">
        <nav id="menu_navegacion">
            <a href="login.php">Login</a>
        </nav>
    </header>
    <?php
    include '../config/db.php';

    $sql = "SELECT * FROM fotos ORDER BY fecha_subida DESC";
    $stmt = $pdo->query($sql);
    $fotos = $stmt->fetchAll();
    ?>
    <!-- Pintamos las fotos -->
    <div>
        <?php foreach ($fotos as $foto): ?>
            <div class="bloque_foto">
                <h3><?= htmlspecialchars($foto['titulo']) ?></h3>
                <img class="foto"
                    src="../assets/img/<?= htmlspecialchars($foto['direccion_archivo']) ?>"
                    alt="<?= htmlspecialchars($foto['titulo']) ?>">
                <small>Subida el <?= $foto['fecha_subida'] ?></small>
            </div>
        <?php endforeach; ?>
    </div>
    <main>
        <section>
            <h1>Bienvenido</h1>
            <p>
                Nuestra aplicacion web esta orientada a la gestión de usuarios y operaciones de nuestro
                sistema bancario.
            </p>

        </section>
        <section>
            <h2>Sobre nosotros</h2>
            <p class="sobre_nosotros">Banco Corporativo nació con el objetivo de ofrecer soluciones financieras claras, seguras y adaptadas a las necesidades reales de empresas y particulares. Desde nuestros inicios, nos hemos centrado en combinar la experiencia tradicional del sector bancario con herramientas digitales modernas que facilitan la gestión diaria de operaciones.

                A lo largo del tiempo hemos desarrollado un modelo basado en la cercanía, la transparencia y la eficiencia. Nuestro equipo trabaja para ofrecer servicios como gestión de operaciones, asesoramiento personalizado, seguimiento de movimientos y atención directa a clientes, garantizando siempre seguridad y confianza en cada proceso.

                Hoy continuamos evolucionando para ofrecer soluciones ágiles y tecnológicas que permitan a nuestros clientes gestionar su actividad financiera de forma sencilla y segura.</p>
        </section>

    </main>
    <footer>
        <p>Proyecto intermodular DAW - 1º Curso</p>

    </footer>
</body>

</html>