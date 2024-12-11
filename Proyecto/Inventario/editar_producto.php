<?php
include '../bd/conexion_be.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'], $_POST['tabla'], $_POST['nombre'], $_POST['cantidad'])) {
        $id = intval($_POST['id']);
        $tabla = $_POST['tabla'];
        $nombre = $_POST['nombre'];
        $cantidad = intval($_POST['cantidad']);

        $query = "UPDATE $tabla SET nombre = ?, cantidad = ? WHERE id = ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param('sii', $nombre, $cantidad, $id);

        if ($stmt->execute()) {
            header("Location: mostrar_productos.php");
            exit(); 
        } else {
            echo "Error al actualizar el producto.";
        }
    } else {
        echo "Parámetros inválidos.";
    }
} else {
    if (isset($_GET['id'], $_GET['tabla'])) {
        $id = intval($_GET['id']);
        $tabla = $_GET['tabla'];

        $query = "SELECT nombre, cantidad FROM $tabla WHERE id = ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $producto = $result->fetch_assoc();
        } else {
            die("Producto no encontrado.");
        }
    } else {
        die("Parámetros inválidos.");
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f6f9;
            color: #333;
            text-align: center;
        }

        h1 {
            margin-top: 20px;
            color: #2c3e50;
        }

        form {
            display: inline-block;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .button-group {
            text-align: center;
            margin-top: 15px;
        }

        .button-group button {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .button-group .save-btn {
            background-color: #3498db;
        }

        .button-group .save-btn:hover {
            background-color: #2980b9;
        }

        .button-group .cancel-btn {
            background-color: #e74c3c;
        }

        .button-group .cancel-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <h1>Editar Producto</h1>
    <form action="editar_producto.php" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
        <input type="hidden" name="tabla" value="<?php echo htmlspecialchars($tabla); ?>">

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>" required>

        <label for="cantidad">Cantidad:</label>
        <input type="number" id="cantidad" name="cantidad" value="<?php echo htmlspecialchars($producto['cantidad']); ?>" required>

        <div class="button-group">
            <button type="submit" class="save-btn">Guardar Cambios</button>
            <button type="button" class="cancel-btn" onclick="window.location.href='mostrar_productos.php'">Cancelar</button>
        </div>
    </form>
</body>
</html>
