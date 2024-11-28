<?php
session_start();
include('../includes/navbar.php');
include('../../datos/queries.php');

// Verificar que el usuario tenga rol de admin
if ($_SESSION['rol'] == 'administrador') {

    // Obtener los usuarios de la base de datos
    $usuarios = getUsuarios();  // Función que obtiene todos los usuarios de la base de datos

    // Funciones de CRUD
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'delete':
                $id = $_GET['id'];
                deleteUsuario($id);  // Función para eliminar un usuario
                header("Location: admin_usuarios.php");  // Redirigir después de eliminar
                break;
            case 'edit':
                // Mostrar el formulario de edición si hay un usuario específico a editar
                $id = $_GET['id'];
                $usuario = getUsuarioById($id);  // Obtener usuario por ID
                break;
            case 'add':
                // Mostrar el formulario para agregar un nuevo usuario
                break;
        }
    }

    // Acción para agregar un nuevo usuario (Formulario de agregar)
    if (isset($_POST['action']) && $_POST['action'] == 'add') {
        // Obtener los datos del formulario
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $contrasena = $_POST['contrasena']; // Asegúrate de hashear la contraseña
        $rol = $_POST['rol'];

        // Función para agregar un usuario
        addUsuario($nombre, $email, $contrasena, $rol);

        // Redirigir después de agregar el usuario
        header("Location: admin_usuarios.php");
    }

    // Acción para actualizar un usuario (Formulario de edición)
    if (isset($_POST['action']) && $_POST['action'] == 'update') {
        // Obtener los datos del formulario de edición
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $contrasena = $_POST['contrasena']; // Si la contraseña no se cambia, puedes omitirla
        $rol = $_POST['rol'];

        // Función para actualizar un usuario
        updateUsuario($id, $nombre, $email, $contrasena, $rol);

        // Redirigir después de actualizar el usuario
        header("Location: admin_usuarios.php");
    }

    ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Salud Web</title>
        <link rel="stylesheet" href="../../css/admin.css">
        <link rel="stylesheet" href="../../css/footer.css">
    </head>

    <h1>Administrar Usuarios</h1>

    <!-- Enlace para agregar un nuevo usuario -->
    <a href="admin_usuarios.php?action=add" class="btn">Agregar Usuario</a>

    <!-- Formulario para agregar un nuevo usuario -->
    <?php if (isset($_GET['action']) && $_GET['action'] == 'add'): ?>
        <h2>Agregar Usuario</h2>
        <form method="POST" action="admin_usuarios.php">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" required>

            <label for="email">Correo Electrónico</label>
            <input type="email" name="email" required>

            <label for="contrasena">Contraseña</label>
            <input type="password" name="contrasena" required>

            <label for="rol">Rol</label>
            <select name="rol">
                <option value="cliente">Cliente</option>
                <option value="empleado">Empleado</option>
                <option value="administrador">Administrador</option>
            </select>

            <button type="submit" name="action" value="add">Agregar Usuario</button>
        </form>
    <?php endif; ?>

    <!-- Formulario para editar un usuario -->
    <?php if (isset($usuario)): ?>
        <h2>Editar Usuario</h2>
        <form method="POST" action="admin_usuarios.php">
            <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" value="<?php echo $usuario['nombre']; ?>" required>

            <label for="email">Correo Electrónico</label>
            <input type="email" name="email" value="<?php echo $usuario['email']; ?>" required>

            <label for="contrasena">Contraseña</label>
            <input type="password" name="contrasena">

            <label for="rol">Rol</label>
            <select name="rol">
                <option value="cliente" <?php echo $usuario['rol'] == 'cliente' ? 'selected' : ''; ?>>Cliente</option>
                <option value="empleado" <?php echo $usuario['rol'] == 'empleado' ? 'selected' : ''; ?>>Empleado</option>
                <option value="administrador" <?php echo $usuario['rol'] == 'administrador' ? 'selected' : ''; ?>>Administrador</option>
            </select>

            <button type="submit" name="action" value="update">Actualizar</button>
        </form>
    <?php endif; ?>

    <!-- Tabla para listar los usuarios -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?php echo $usuario['id']; ?></td>
                    <td><?php echo $usuario['nombre']; ?></td>
                    <td><?php echo $usuario['email']; ?></td>
                    <td><?php echo $usuario['rol']; ?></td>
                    <td>
                        <a href="admin_usuarios.php?action=edit&id=<?php echo $usuario['id']; ?>" class="btn">Editar</a>
                        <a href="admin_usuarios.php?action=delete&id=<?php echo $usuario['id']; ?>" class="btn" onclick="return confirm('¿Estás seguro de eliminar este usuario?');">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php
} else {
    echo "Acceso denegado";
}

include('../includes/footer.php');
?>
