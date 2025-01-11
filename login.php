<?php
// login.php
require 'config/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conexion = conectarDB();
    $email = limpiarDato($_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT id, nombre, password, tipo_usuario FROM usuarios WHERE email = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($usuario = $resultado->fetch_assoc()) {
        if (password_verify($password, $usuario['password'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['nombre'] = $usuario['nombre'];
            $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];
            
            header('Location: cuenta.php');
            exit;
        }
    }
    $error = "Credenciales incorrectas";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="auth-container">
        <h2>Iniciar Sesión</h2>
        <?php if(isset($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form class="auth-form" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" class="btn-primary">Iniciar Sesión</button>
        </form>
        
        <p>¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
    </div>
</body>
</html>