<?php
include '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nombre, email, password) VALUES ('$nombre', '$email', '$password')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Cuenta creada exitosamente. Ahora puedes iniciar sesión.'); window.location='login.php';</script>";
    } else {
        echo "Error al registrar usuario: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Cuenta</title>
    <link rel="stylesheet" href="../assets/css/style.css/style.css">
</head>
<body>
    <div class="form-container">
        <div class="form-box">
            <h2>Crear una Cuenta</h2>
            <form method="POST" action="">
                <label>Nombre completo:</label>
                <input type="text" name="nombre" required>

                <label>Email:</label>
                <input type="email" name="email" required>

                <label>Contraseña:</label>
                <input type="password" name="password" required>

                <button type="submit">Registrarse</button>
            </form>

            <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a></p>
        </div>
    </div>
</body>
</html>
