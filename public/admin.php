<?php
session_start();
include '../config/database.php';

// Verificar que sea administrador
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Procesar formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $ubicacion = $_POST['ubicacion'];
    $precio = $_POST['precio'];

    // Carpeta donde se guardará la imagen
    $directorio = "../assets/img/";
    $nombreArchivo = basename($_FILES["imagen"]["name"]);
    $rutaCompleta = $directorio . $nombreArchivo;

    // Subir imagen
    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaCompleta)) {
        $sql = "INSERT INTO alojamientos (nombre, descripcion, ubicacion, precio, imagen)
                VALUES ('$nombre', '$descripcion', '$ubicacion', '$precio', '$nombreArchivo')";
        
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('✅ Alojamiento agregado correctamente');</script>";
        } else {
            echo "<script>alert('❌ Error al guardar en la base de datos');</script>";
        }
    } else {
        echo "<script>alert('⚠️ Error al subir la imagen');</script>";
    }
}

$result = $conn->query("SELECT * FROM alojamientos");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administrador</title>
    <link rel="stylesheet" href="../assets/css/style.css/style.css">
</head>

<body>
    <div class="logout">
        <a href="logout.php">Cerrar sesión</a>
    </div>

    <div class="admin-header">
        <h1>Panel del Administrador 🛠️</h1>
        <p>Agrega nuevos alojamientos a la base de datos</p>
    </div>

    <div class="admin-form">
        <h2>Agregar nuevo alojamiento</h2>
        <form method="POST" action="" enctype="multipart/form-data">

            <label>Nombre:</label>
            <input type="text" name="nombre" required>

            <label>Descripción:</label>
            <input type="text" name="descripcion" required>

            <label>Ubicación:</label>
            <input type="text" name="ubicacion" required>

            <label>Precio ($):</label>
            <input type="number" name="precio" required>

            <label>Seleccionar imagen:</label>
            <input type="file" name="imagen" accept="image/*" required>


            <button type="submit">Agregar Alojamiento</button>
        </form>
    </div>

    <h2 style="text-align:center; color:#2c3e50;">Alojamientos actuales</h2>

    <div class="admin-alojamientos">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="card">
                <img src="../assets/img/<?= $row['imagen']; ?>" alt="<?= $row['nombre']; ?>" width="200">
                <h3><?= $row['nombre']; ?></h3>
                <p><?= $row['descripcion']; ?></p>
                <p><strong>Ubicación:</strong> <?= $row['ubicacion']; ?></p>
                <p><strong>Precio:</strong> $<?= $row['precio']; ?></p>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>

