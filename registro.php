<?php
// registro.php
require 'config/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conexion = conectarDB();
    $nombre = limpiarDato($_POST['nombre']);
    $email = limpiarDato($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Verificar si el email ya existe
    $query = "SELECT id FROM usuarios WHERE email = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    
    if ($stmt->get_result()->num_rows > 0) {
        $error = "Este email ya está registrado";
    } else {
        $query = "INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("sss", $nombre, $email, $password);
        
        if ($stmt->execute()) {
            header('Location: login.php?registro=exitoso');
            exit;
        } else {
            $error = "Error al registrar el usuario";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="auth-container">
        <h2>Crear Cuenta</h2>
        <?php if(isset($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form class="auth-form" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" class="btn-primary">Registrarse</button>
        </form>
        
        <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
    </div>
</body>