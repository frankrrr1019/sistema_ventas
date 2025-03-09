<?php
include 'conexion.php';

// Obtener productos de la base de datos
$query = "SELECT * FROM productos";
$result = mysqli_query($conn, $query);

// Procesar edición de producto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];

    $update_query = "UPDATE productos SET nombre = '$nombre', precio = '$precio', cantidad = '$cantidad' WHERE id = $id";
    if (mysqli_query($conn, $update_query)) {
        header("Location: index.php"); // Redirigir al usuario después de editar
        exit();
    } else {
        echo "Error al actualizar el producto: " . mysqli_error($conn);
    }
}

// Procesar agregar producto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregar'])) {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];

    $insert_query = "INSERT INTO productos (nombre, precio, cantidad) VALUES ('$nombre', '$precio', '$cantidad')";
    if (mysqli_query($conn, $insert_query)) {
        header("Location: index.php"); // Redirigir al usuario después de agregar
        exit();
    } else {
        echo "Error al agregar el producto: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sistema de Ventas</title>
</head>
<body>
    <h1>Sistema de Ventas - Productos Disponibles</h1>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad Disponible</th>
            <th>Fecha de Creación</th>
            <th>Acción</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nombre']; ?></td>
            <td><?php echo $row['precio']; ?></td>
            <td><?php echo $row['cantidad']; ?></td>
            <td><?php echo $row['fecha_creacion']; ?></td>
            <td>
                <button class="edit-button" onclick="openEditModal(<?php echo $row['id']; ?>, '<?php echo $row['nombre']; ?>', <?php echo $row['precio']; ?>, <?php echo $row['cantidad']; ?>)">Editar</button>
            </td>
        </tr>
        <?php } ?>
    </table>

    <!-- Modal para editar producto -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditModal()">&times;</span>
            <h2>Editar Producto</h2>
            <form method="POST" action="index.php">
                <input type="hidden" id="edit-id" name="id">
                <input type="hidden" name="editar" value="1">
                
                <label for="edit-nombre">Nombre:</label>
                <input type="text" id="edit-nombre" name="nombre" required>
                
                <label for="edit-precio">Precio:</label>
                <input type="number" id="edit-precio" name="precio" step="0.01" required>
                
                <label for="edit-cantidad">Cantidad:</label>
                <input type="number" id="edit-cantidad" name="cantidad" required>
                
                <button type="submit">Guardar Cambios</button>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
