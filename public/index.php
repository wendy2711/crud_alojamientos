<?php
include '../config/database.php';
$result = $conn->query("SELECT * FROM alojamientos");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alojamientos</title>
    <link rel="stylesheet" href="../assets/css/style.css/style.css">
</head>
<body>
    <h1>Bienvenido a la página de Alojamientos</h1>
    <a href="login.php">Iniciar Sesión</a> | <a href="register.php">Registrarse</a>

    <div class="alojamientos">
    <?php while($row = $result->fetch_assoc()): ?>
    <div class="card">
        <img src="../assets/img/<?= $row['imagen']; ?>" alt="<?= $row['nombre']; ?>" width="200">
        <h2><?= $row['nombre']; ?></h2>
        <p><?= $row['descripcion']; ?></p>
        <p><strong>Ubicación:</strong> <?= $row['ubicacion']; ?></p>
        <p><strong>Precio:</strong> $<?= $row['precio']; ?></p>
    </div>
    <?php endwhile; ?>
    </div>

</body>
</html>
