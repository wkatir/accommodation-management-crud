<?php
require 'config/connection.php';
verificarAutenticacion();

$conexion = conectarDB();
$usuario_id = $_SESSION['usuario_id'];

// Obtener alojamientos seleccionados por el usuario
$query = "SELECT a.* FROM alojamientos a 
          INNER JOIN usuario_alojamientos ua ON a.id = ua.alojamiento_id 
          WHERE ua.usuario_id = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$alojamientos = $stmt->get_result();

// Para administradores: obtener todos los alojamientos
$es_admin = esAdmin();
if ($es_admin) {
    $query_todos = "SELECT * FROM alojamientos ORDER BY fecha_registro DESC";
    $todos_alojamientos = $conexion->query($query_todos);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Cuenta</title>
    <link rel="stylesheet" href="css/cuenta.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <h1>Mi Cuenta</h1>
            </div>
            <div class="nav-links">
                <a href="index.php">Inicio</a>
                <a href="logout.php">Cerrar Sesión</a>
            </div>
        </nav>
    </header>

    <main class="cuenta-container">
        <h2>Bienvenido, <?php echo $_SESSION['nombre']; ?></h2>

        <?php if ($es_admin): ?>
            <!-- Sección de administrador -->
            <section class="admin-section">
                <h3>Panel de Administrador</h3>
                <form action="agregar_alojamiento.php" method="POST" enctype="multipart/form-data" class="admin-form">
                    <div class="form-group">
                        <label for="nombre">Nombre del Alojamiento:</label>
                        <input type="text" id="nombre" name="nombre" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="descripcion">Descripción:</label>
                        <textarea id="descripcion" name="descripcion" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="precio">Precio por noche:</label>
                        <input type="number" id="precio" name="precio" step="0.01" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="ubicacion">Ubicación:</label>
                        <input type="text" id="ubicacion" name="ubicacion" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="imagen">Imagen:</label>
                        <input type="file" id="imagen" name="imagen" accept="image/*" required>
                    </div>
                    
                    <button type="submit" class="btn-explorer">Agregar Alojamiento</button>
                </form>

                <div class="alojamientos-list">
                    <h3>Todos los Alojamientos</h3>
                    <?php while($alojamiento = $todos_alojamientos->fetch_assoc()): ?>
                        <div class="alojamiento-item">
                            <img src="<?php echo $alojamiento['imagen_url']; ?>" alt="<?php echo $alojamiento['nombre']; ?>">
                            <div class="alojamiento-info">
                                <h4><?php echo $alojamiento['nombre']; ?></h4>
                                <p><?php echo $alojamiento['ubicacion']; ?></p>
                                <p class="precio">$<?php echo number_format($alojamiento['precio'], 2); ?></p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </section>

        <?php else: ?>
            <!-- Sección de usuario normal -->
            <section class="user-alojamientos">
                <h3>Mis Alojamientos Seleccionados</h3>
                <?php if ($alojamientos->num_rows > 0): ?>
                    <div class="alojamientos-grid">
                        <?php while($alojamiento = $alojamientos->fetch_assoc()): ?>
                            <div class="alojamiento-card">
                                <img src="<?php echo $alojamiento['imagen_url']; ?>" alt="<?php echo $alojamiento['nombre']; ?>">
                                <div class="alojamiento-info">
                                    <h4><?php echo $alojamiento['nombre']; ?></h4>
                                    <p class="ubicacion"><?php echo $alojamiento['ubicacion']; ?></p>
                                    <p class="precio">€<?php echo number_format($alojamiento['precio'], 2); ?> por noche</p>
                                    <form action="eliminar_seleccion.php" method="POST" class="eliminar-form">
                                        <input type="hidden" name="alojamiento_id" value="<?php echo $alojamiento['id']; ?>">
                                        <button type="submit" class="btn-eliminar">Eliminar de mi selección</button>
                                    </form>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <p class="no-alojamientos">Aún no has seleccionado ningún alojamiento.</p>
                    <a href="index.php" class="btn-explorer">Explorar Alojamientos</a>
                <?php endif; ?>
            </section>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2025 Alojamientos. Todos los derechos reservados.</p>
    </footer>
</body>
</html>