<?php
require 'config/connection.php';
$conexion = conectarDB();

// Obtener todos los alojamientos
$query = "SELECT * FROM alojamientos ORDER BY fecha_registro DESC";
$resultado = $conexion->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alojamientos - Inicio</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <h1>Alojamientos</h1>
            </div>
            <div class="nav-links">
                <?php if(isset($_SESSION['usuario_id'])): ?>
                    <a href="cuenta.php">Mi Cuenta</a>
                    <a href="logout.php">Cerrar Sesión</a>
                <?php else: ?>
                    <a href="login.php">Iniciar Sesión</a>
                    <a href="registro.php">Registrarse</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <main>
        <section class="hero">
            <h2>Encuentra tu lugar perfecto</h2>
            <p>Explora nuestra selección de alojamientos únicos</p>
        </section>

        <section class="alojamientos-grid">
            <?php while($alojamiento = $resultado->fetch_assoc()): ?>
                <div class="alojamiento-card">
                    <img src="<?php echo $alojamiento['imagen_url']; ?>" alt="<?php echo $alojamiento['nombre']; ?>">
                    <div class="alojamiento-info">
                        <h3><?php echo $alojamiento['nombre']; ?></h3>
                        <p class="ubicacion"><?php echo $alojamiento['ubicacion']; ?></p>
                        <p class="precio">€<?php echo number_format($alojamiento['precio'], 2); ?> por noche</p>
                        <?php if(isset($_SESSION['usuario_id'])): ?>
                            <a href="seleccionar_alojamiento.php?id=<?php echo $alojamiento['id']; ?>" class="btn-seleccionar">Seleccionar</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Alojamientos. Todos los derechos reservados.</p>
    </footer>
</body>
</html>