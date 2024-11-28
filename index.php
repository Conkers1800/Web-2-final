<?php include('../includes/header.php'); ?>
<h1>Bienvenido a la página de salud</h1>
<p>Aquí podrás encontrar información sobre salud general, nutrición, ejercicio y más.</p>

<?php if (isset($_SESSION['user_id'])): ?>
    <p>Hola, <?php echo $_SESSION['nombre']; ?>. <a href="/php/public/logout.php">Cerrar sesión</a></p>
    <a href="/php/public/dashboard.php">Ver temas de salud</a>
<?php else: ?>
    <a href="./php/public/login.php">Iniciar sesión</a> o <a href="/php/public/register.php">Registrarse</a>
<?php endif; ?>

<?php include('/php/includes/footer.php'); ?>
