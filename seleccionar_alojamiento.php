<?php
// seleccionar_alojamiento.php
require 'config/connection.php';
verificarAutenticacion();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $conexion = conectarDB();
    $alojamiento_id = (int)$_GET['id'];
    $usuario_id = $_SESSION['usuario_id'];

    // Verificar si ya está seleccionado
    $query = "SELECT id FROM usuario_alojamientos WHERE usuario_id = ? AND alojamiento_id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("ii", $usuario_id, $alojamiento_id);
    $stmt->execute();
    
    if ($stmt->get_result()->num_rows === 0) {
        // Insertar nueva selección
        $query = "INSERT INTO usuario_alojamientos (usuario_id, alojamiento_id) VALUES (?, ?)";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("ii", $usuario_id, $alojamiento_id);
        $stmt->execute();
    }
}

header('Location: cuenta.php');
exit;
?>
