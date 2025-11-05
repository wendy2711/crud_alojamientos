<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$usuario_nombre = $_SESSION['usuario_nombre'];


if (isset($_GET['select'])) {
    $alojamiento_id = $_GET['select'];
    $check = $conn->query("SELECT * FROM usuario_alojamientos WHERE usuario_id = $usuario_id AND alojamiento_id = $alojamiento_id");

    if ($check->num_rows == 0) {
        $conn->query("INSERT INTO usuario_alojamientos (usuario_id, alojamiento_id) VALUES ($usuario_id, $alojamiento_id)");
    }
}


if (isset($_GET['remove'])) {
    $alojamiento_id = $_GET['remove'];
    $conn->query("DELETE FROM usuario_alojamientos WHERE usuario_id = $usuario_id AND alojamiento_id = $alojamiento_id");
}


$alojamientos = $conn->query("SELECT * FROM alojamientos");


$seleccionados = $conn->query("
    SELECT a.* FROM alojamientos a
    INNER JOIN usuario_alojamientos ua ON a.id = ua.alojamiento_id
    WHERE ua.usuario_id = $usuario_id
");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Usuario</title>
    <link rel="stylesheet" href="../assets/css/style.css/style.css">
</head>
<body>
    <h1>Bienvenido, <?= $usuario_nombre; ?> 👋</h1>
    <a href="logout.php">Cerrar sesión</a>

    <h2>Alojamientos disponibles</h2>
    <div class="alojamientos">
        <?php while ($row = $alojamientos->fetch_assoc()): ?>
            <div class="card">
                <img src="../assets/img/<?= $row['imagen']; ?>" alt="<?= $row['nombre']; ?>" width="200">
                <h3><?= $row['nombre']; ?></h3>
                <p><?= $row['descripcion']; ?></p>
                <p><strong>Ubicación:</strong> <?= $row['ubicacion']; ?></p>
                <p><strong>Precio:</strong> $<?= $row['precio']; ?></p>
                <a href="?select=<?= $row['id']; ?>">Seleccionar</a>
            </div>
        <?php endwhile; ?>
    </div>

    <h2>Tus alojamientos seleccionados</h2>
    <div class="alojamientos">
        <?php while ($sel = $seleccionados->fetch_assoc()): ?>
            <div class="card">
                <img src="../assets/img/<?= $sel['imagen']; ?>" alt="<?= $sel['nombre']; ?>" width="200">
                <h3><?= $sel['nombre']; ?></h3>
                <p><?= $sel['descripcion']; ?></p>
                <p><strong>Ubicación:</strong> <?= $sel['ubicacion']; ?></p>
                <p><strong>Precio:</strong> $<?= $sel['precio']; ?></p>
                <a href="?remove=<?= $sel['id']; ?>">Eliminar</a>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
