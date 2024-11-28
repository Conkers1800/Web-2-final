<!-- navbar.php -->
<head>
    <link rel="stylesheet" href="../../css/nav.css"> <!-- Referencia al CSS -->
</head>
<div class="navbar">
    <div class="welcome-message">
        <?php if (isset($_SESSION['nombre'])): ?>
            <p>Bienvenido, <?php echo $_SESSION['nombre']; ?></p>
        <?php else: ?>
            <p>Bienvenido, visitante</p>
        <?php endif; ?>
    </div>
    <div class="nav-links">
        <?php if (isset($_SESSION['nombre'])): ?>
            <a href="dashboard.php">Inicio</a>
            <!-- Mostrar opciones adicionales según el rol -->
            <?php if ($_SESSION['rol'] == 'administrador'): ?>
                <!-- Enlaces para el administrador -->
                <a href="admin_info.php">Administrar Información</a>
                <a href="admin_usuarios.php">Administrar Usuarios</a>
            <?php elseif ($_SESSION['rol'] == 'empleado'): ?>
                <!-- Enlace solo para empleados -->
                <a href="admin_info.php">Administrar Información</a>
            <?php endif; ?>
            <a href="logout.php">Cerrar sesión</a>
        <?php else: ?>
            <a href="login.php">Iniciar sesión</a>
        <?php endif; ?>
    </div>
</div>
