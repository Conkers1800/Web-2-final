<?php
session_start();
include('../datos/queries.php');

// Verificar que el usuario tenga el rol adecuado (administrador o empleado)
if ($_SESSION['rol'] == 'administrador' || $_SESSION['rol'] == 'empleado') {

    // Verificar si la acción es para agregar o actualizar
    if (isset($_POST['action'])) {
        // Dependiendo de la acción, llamamos a la función correspondiente
        switch ($_POST['action']) {
            case 'add':
                // Recoger los datos del formulario y llamar a la función que maneja el agregar
                $titulo = $_POST['titulo'];
                $descripcion = $_POST['descripcion'];
                addTema($titulo, $descripcion);
                header("Location: ../php/public/admin_info.php");
                break;

            case 'update':
                // Recoger los datos para actualizar
                $id = $_POST['id'];
                $titulo = $_POST['titulo'];
                $descripcion = $_POST['descripcion'];
                updateTema($id, $titulo, $descripcion);
                header("Location: ../php/public/admin_info.php");
                break;
        }
    }
    
    // Verificar si el usuario tiene acceso
    if ($_SESSION['rol'] != 'administrador') {
        die("Acceso denegado");
    }
    
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
    
        // Para la acción de agregar usuario
        if ($action == 'add') {
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $contrasena = $_POST['contrasena'];
            $rol = $_POST['rol'];
    
            // Llamar a la función de agregar usuario
            if (addUsuario($nombre, $email, $contrasena, $rol)) {
                header("Location: ../php/public/admin_usuarios.php");
                exit();
            } else {
                echo "Error al agregar el usuario.";
            }
    
        // Para la acción de actualizar usuario
        } elseif ($action == 'update') {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $rol = $_POST['rol'];
            $contrasena = $_POST['contrasena'];
    
            // Si se proporcionó una nueva contraseña, la actualizamos
            if (!empty($contrasena)) {
                // Hash de la nueva contraseña
                $contrasena = $contrasena;
            } else {
                // Si no hay nueva contraseña, mantenemos la anterior
                $contrasena = null;
            }
    
            // Llamar a la función de actualización de usuario
            if (updateUsuario($id, $nombre, $email, $rol, $contrasena)) {
                header("Location: ../php/public/admin_usuarios.php");
                exit();
            } else {
                echo "Error al actualizar el usuario.";
            }
    
        }
    }

} else {
    echo "Acceso denegado";
}
?>
