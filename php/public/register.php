<?php
include('../../datos/db.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rol = 'cliente'; // Rol predeterminado

    // Comprobamos si el correo ya está registrado
    $sql_check = "SELECT * FROM usuarios WHERE email = '$email'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        $error = "El correo electrónico ya está registrado.";
    } else {
        // Insertamos los datos del nuevo usuario en la base de datos
        $sql = "INSERT INTO usuarios (nombre, email, contrasena, rol) VALUES ('$nombre', '$email', '$password', '$rol')";
        
        if ($conn->query($sql) === TRUE) {
            $_SESSION['user_id'] = $conn->insert_id;
            $_SESSION['nombre'] = $nombre;
            $_SESSION['email'] = $email;
            $_SESSION['rol'] = $rol;
            
            // Redirigimos al dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Error al registrar: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Salud Web</title>
    <link rel="stylesheet" href="../../css/styles.css"> <!-- Verifica que esta ruta esté correcta -->
</head>
<body>

    <div class="register-container">
        <h2>Registrarse</h2>

        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre completo" required><br>

            <label for="email">Correo electrónico:</label>
            <input type="email" name="email" id="email" placeholder="Correo electrónico" required><br>

            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" placeholder="Contraseña" required><br>

            <button type="submit">Registrar</button>
        </form>

        <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>

    </div>

</body>
</html>
