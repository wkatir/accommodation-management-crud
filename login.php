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
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container login-card">
        <h2>Iniciar Sesión</h2>
        
        <?php if(isset($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        <p>Accede a tu cuenta para continuar con la reserva de alojamiento.</p>
        <form method="POST">
            <div class="form__group">
                <input type="email" id="email" name="email" class="form__field" placeholder="Email" required>
                <label for="email" class="form__label">Email:</label>
            </div>
            
            <div class="form__group">
                <input type="password" id="password" name="password" class="form__field" placeholder="Contraseña" required>
                <label for="password" class="form__label">Contraseña:</label>
            </div>
            
            <button type="submit">Iniciar Sesión</button>
        </form>
        
        <div class="extra-links">
            <p>¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
        </div>
    </div>
</body>
</html>
