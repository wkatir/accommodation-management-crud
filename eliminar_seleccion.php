<?php
// eliminar_seleccion.php
require 'config/connection.php';
verificarAutenticacion();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['alojamiento_id'])) {
    $conexion = conectarDB();
    $alojamiento_id = (int)$_POST['alojamiento_id'];
    $usuario_id = $_SESSION['usuario_id'];

    $query = "DELETE FROM usuario_alojamientos WHERE usuario_id = ? AND alojamiento_id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("ii", $usuario_id, $alojamiento_id);
    $stmt->execute();
}

header('Location: cuenta.php');
exit;
?>
