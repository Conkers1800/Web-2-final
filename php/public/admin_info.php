<?php
session_start();
include('../includes/navbar.php');
include('../../datos/queries.php');

// Verificar que el usuario tenga acceso
if ($_SESSION['rol'] == 'administrador' || $_SESSION['rol'] == 'empleado') {

    // Obtener los temas o la información que se va a administrar
    $temas = getTemasSalud();  // Supón que esta función trae los datos de la base de datos

    // Funciones de CRUD
    // Asegúrate de tener implementadas las funciones de agregar, editar y eliminar en tu archivo de consultas.
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'delete':
                $id = $_GET['id'];
                deleteTema($id);  // Función para eliminar un tema
                header("Location: admin_info.php");  // Redirigir después de eliminar
                break;
            case 'edit':
                // Mostrar el formulario de edición si hay un tema específico a editar
                $id = $_GET['id'];
                $tema = getTemaById($id);  // Obtener tema por ID
                break;
            case 'add':
                // Mostrar el formulario para agregar un nuevo tema
                break;
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Información</title>
    <link rel="stylesheet" href="../../css/admin.css">
    <link rel="stylesheet" href="../../css/footer.css">
</head>
<body>

    <h1>Administrar Información</h1>

    <a href="admin_info.php?action=add" class="btn">Agregar Tema</a>

    <!-- Formulario para agregar un nuevo tema -->
    <?php if (isset($_GET['action']) && $_GET['action'] == 'add'): ?>
        <h2>Agregar Nuevo Tema</h2>
        <form method="POST" action="../../modelos/process_form.php">
            <label for="titulo">Título</label>
            <input type="text" name="titulo" required>

            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" required></textarea>

            <button type="submit" name="action" value="add">Agregar</button>
        </form>
    <?php endif; ?>

    <!-- Formulario para editar un tema -->
    <?php if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($tema)): ?>
        <h2>Editar Tema</h2>
        <form method="POST" action="../../modelos/process_form.php">
            <input type="hidden" name="id" value="<?php echo $tema['id']; ?>">

            <label for="titulo">Título</label>
            <input type="text" name="titulo" value="<?php echo $tema['titulo']; ?>" required>

            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" required><?php echo $tema['descripcion']; ?></textarea>

            <button type="submit" name="action" value="update">Actualizar</button>
        </form>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($temas as $tema): ?>
                <tr>
                    <td><?php echo $tema['id']; ?></td>
                    <td><?php echo $tema['titulo']; ?></td>
                    <td><?php echo $tema['descripcion']; ?></td>
                    <td>
                        <a href="admin_info.php?action=edit&id=<?php echo $tema['id']; ?>" class="btn">Editar</a>
                        <a href="admin_info.php?action=delete&id=<?php echo $tema['id']; ?>" class="btn" onclick="return confirm('¿Estás seguro de eliminarlo?');">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>

<?php
} else {
    echo "Acceso denegado";
}

include('../includes/footer.php');
?>
