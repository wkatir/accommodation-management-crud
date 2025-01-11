<?php
// config.php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'alojamientos_db');

// connection.php
function conectarDB() {
    $conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }
    
    $conexion->set_charset("utf8");
    return $conexion;
}

// Iniciar sesión en todas las páginas
session_start();

// Función para verificar si el usuario está autenticado
function verificarAutenticacion() {
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: login.php');
        exit;
    }
}

// Función para verificar si es administrador
function esAdmin() {
    return isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'admin';
}

// Función para limpiar y validar inputs
function limpiarDato($dato) {
    $dato = trim($dato);
    $dato = stripslashes($dato);
    $dato = htmlspecialchars($dato);
    return $dato;
}
?>