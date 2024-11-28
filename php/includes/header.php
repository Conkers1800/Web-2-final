<?php session_start(); 
include('../includes/navbar.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salud Web</title>
    <link rel="stylesheet" href="../../css/principal.css">
    <link rel="stylesheet" href="../../css/footer.css">
</head>
<body>

<header> 
    <h1>Bienvenidos a Salud Web</h1>
    <nav>
        <ul>
            <?php if (isset($_SESSION['user_id'])): ?>
                <!-- Si el usuario está logueado, mostrar el enlace para cerrar sesión -->
            <?php else: ?>
                <!-- Si no está logueado, mostrar enlace para login -->

            <?php endif; ?>
        </ul>
    </nav>
</header>
