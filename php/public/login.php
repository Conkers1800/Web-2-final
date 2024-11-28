<?php
include('../../datos/db.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Comprobamos que el correo y la contraseña coinciden con algún registro en la base de datos
    $sql = "SELECT * FROM usuarios WHERE email = '$email' AND contrasena = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Si el usuario existe, obtenemos los datos
        $user = $result->fetch_assoc();
        
        // Iniciamos la sesión y almacenamos los datos del usuario
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nombre'] = $user['nombre'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['rol'] = $user['rol'];

        // Redirigimos al usuario al dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Credenciales incorrectas.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Salud Web</title>
    <link rel="stylesheet" href="../../css/styles.css"> <!-- Ruta relativa al archivo CSS -->
</head>
<body>

    <div class="login-container">
        <h2>Iniciar sesión</h2>

        <?php if (isset($error)): ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="email">Correo electrónico:</label>
                <input type="email" name="email" id="email" placeholder="Correo electrónico" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password" placeholder="Contraseña" required>
            </div>

            <button type="submit">Iniciar sesión</button>
        </form>

        <p>¿No tienes cuenta? <a href="register.php">Regístrate aquí</a></p>
    </div>

</body>
</html>
