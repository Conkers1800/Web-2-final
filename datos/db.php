<?php
$host = 'localhost';     // El servidor de base de datos está en el mismo servidor local
$user = 'root';          // Usuario predeterminado en XAMPP
$password = 'root';          // Contraseña vacía (por defecto en XAMPP)
$dbname = 'salud_db';    // Nombre de la base de datos que creaste

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
