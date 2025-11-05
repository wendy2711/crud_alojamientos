<?php
include '../config/database.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['password'])) {
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['usuario_nombre'] = $user['nombre'];
            $_SESSION['usuario_tipo'] = $user['tipo'];

            if ($user['tipo'] == 'admin') {
                header("Location: admin.php");
            } else {
                header("Location: dashboard.php");
            }
            exit;
        } else {
            echo "<script>alert('Contraseña incorrecta');</script>";
        }
    } else {
        echo "<script>alert('No existe una cuenta con ese correo');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="../assets/css/style.css/style.css">
</head>
<body>
    <div class="form-container">
        <div class="form-box">
            <h2>Iniciar Sesión</h2>
            <form method="POST" action="">
                <label>Email:</label>
                <input type="email" name="email" required>

                <label>Contraseña:</label>
                <input type="password" name="password" required>

                <button type="submit">Entrar</button>
            </form>

            <p>¿No tienes una cuenta? <a href="register.php">Crea una aquí</a></p>
        </div>
    </div>
</body>
</html>
