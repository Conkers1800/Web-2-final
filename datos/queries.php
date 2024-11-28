<?php
include('db.php');

// Funciones para gestionar los temas de salud

// Obtener todos los temas
function getTemasSalud() {
    global $conn;
    $sql = "SELECT * FROM temas_salud";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC); // Devuelve un arreglo de temas
}

// Obtener un tema por su ID
function getTemaById($id) {
    global $conn;
    $sql = "SELECT * FROM temas_salud WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc(); // Devuelve un solo tema
}

// Agregar un nuevo tema
function addTema($titulo, $descripcion) {
    global $conn;
    $sql = "INSERT INTO temas_salud (titulo, descripcion) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $titulo, $descripcion); // s = string
    return $stmt->execute(); // Devuelve true si se ejecuta con éxito
}

// Actualizar un tema
function updateTema($id, $titulo, $descripcion) {
    global $conn;
    $sql = "UPDATE temas_salud SET titulo = ?, descripcion = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $titulo, $descripcion, $id); // i = integer
    return $stmt->execute(); // Devuelve true si se ejecuta con éxito
}

// Eliminar un tema
function deleteTema($id) {
    global $conn;
    $sql = "DELETE FROM temas_salud WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id); // i = integer
    return $stmt->execute(); // Devuelve true si se ejecuta con éxito
}

// Funciones para gestionar los usuarios

// Función para obtener todos los usuarios
function getUsuarios() {
    global $conn;
    $query = "SELECT * FROM usuarios";
    $result = $conn->query($query);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Función para obtener un usuario por ID
function getUsuarioById($id) {
    global $conn;
    $query = "SELECT * FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Función para agregar un nuevo usuario
function addUsuario($nombre, $email, $contrasena, $rol) {
    global $conn;
    $hashed_password =$contrasena;
    $query = "INSERT INTO usuarios (nombre, email, contrasena, rol) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $nombre, $email, $hashed_password, $rol);
    $stmt->execute();
}

// Función para actualizar un usuario
function updateUsuario($id, $nombre, $email, $contrasena, $rol) {
    global $conn;
    $query = "UPDATE usuarios SET nombre = ?, email = ?, rol = ? WHERE id = ?";
    if (!empty($contrasena)) {
        $hashed_password = $contrasena;
        $query = "UPDATE usuarios SET nombre = ?, email = ?, contrasena = ?, rol = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssi", $nombre, $email, $hashed_password, $rol, $id);
    } else {
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssi", $nombre, $email, $rol, $id);
    }
    $stmt->execute();
}

// Función para eliminar un usuario
function deleteUsuario($id) {
    global $conn;
    $query = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
}
