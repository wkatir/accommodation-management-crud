<?php
// agregar_alojamiento.php
require 'config/connection.php';
verificarAutenticacion();

if (!esAdmin()) {
    header('Location: cuenta.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conexion = conectarDB();
    
    $nombre = limpiarDato($_POST['nombre']);
    $descripcion = limpiarDato($_POST['descripcion']);
    $precio = (float)$_POST['precio'];
    $ubicacion = limpiarDato($_POST['ubicacion']);
    
    // Procesar la imagen
    $imagen_url = 'img/default.jpg'; // Imagen por defecto
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
        $imagen = $_FILES['imagen'];
        $extension = pathinfo($imagen['name'], PATHINFO_EXTENSION);
        $nombre_archivo = uniqid() . '.' . $extension;
        $ruta_destino = 'img/alojamientos/' . $nombre_archivo;
        
        if (move_uploaded_file($imagen['tmp_name'], $ruta_destino)) {
            $imagen_url = $ruta_destino;
        }
    }
    
    $query = "INSERT INTO alojamientos (nombre, descripcion, precio, ubicacion, imagen_url) 
              VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("ssdss", $nombre, $descripcion, $precio, $ubicacion, $imagen_url);
    
    if ($stmt->execute()) {
        header('Location: cuenta.php?agregado=exitoso');
    } else {
        header('Location: cuenta.php?error=1');
    }
    exit;
}

header('Location: cuenta.php');
exit;
?>