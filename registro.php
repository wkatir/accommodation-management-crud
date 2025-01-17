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
    <link rel="stylesheet" href="css/registro.css">
</head>
<body>
    <div class="container register-card">
        <h2>Crear Cuenta</h2>
        
        <?php if(isset($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div>
                <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>
            </div>
            
            <div>
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div>
            
            <div>
                <input type="password" id="password" name="password" placeholder="Contraseña" required>
            </div>
            
            <button type="submit">Registrarse</button>
        </form>
        
        <div class="extra-links">
            <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
        </div>
    </div>
</body>
</html>
