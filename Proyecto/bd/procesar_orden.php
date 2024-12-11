<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../bd/login.php");
    exit();
}

include '../bd/conexion_be.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_producto = $_POST['nombre_producto'];
    $cantidad = (int)$_POST['cantidad'];
    $ubicacion_salida = $_POST['ubicacion_salida'];
    $ubicacion_entrega = $_POST['ubicacion_entrega'];
    $codigo_postal = $_POST['codigo_postal'];

    $ubicaciones = ['almacen', 'tienda1', 'tienda2', 'proveedor'];
    $producto_encontrado = false;

    foreach ($ubicaciones as $ubicacion) {
        $query_verificar = "SELECT * FROM $ubicacion WHERE nombre = ? AND ubicacion_salida = ?";
        $stmt = $conexion->prepare($query_verificar);
        $stmt->bind_param("ss", $nombre_producto, $ubicacion_salida);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $producto = $result->fetch_assoc();
            if ($producto['cantidad'] >= $cantidad) {
                $nueva_cantidad = $producto['cantidad'] - $cantidad;
                $query_actualizar = "UPDATE $ubicacion SET cantidad = ? WHERE id = ?";
                $stmt_actualizar = $conexion->prepare($query_actualizar);
                $stmt_actualizar->bind_param("ii", $nueva_cantidad, $producto['id']);
                $stmt_actualizar->execute();

                $query_orden = "INSERT INTO ordenes (nombre_producto, cantidad, ubicacion_salida, ubicacion_entrega, codigo_postal) VALUES (?, ?, ?, ?, ?)";
                $stmt_orden = $conexion->prepare($query_orden);
                $stmt_orden->bind_param("sisss", $nombre_producto, $cantidad, $ubicacion_salida, $ubicacion_entrega, $codigo_postal);
                $stmt_orden->execute();

                $producto_encontrado = true;
                break;
            } else {
                echo "No hay suficiente stock en $ubicacion para el producto.";
                $producto_encontrado = true;
                break;
            }
        }
    }

    if (!$producto_encontrado) {
        echo "Producto no encontrado en las ubicaciones disponibles.";
    }

    $stmt->close();
    $conexion->close();

    if ($producto_encontrado) {
        header("Location: ../Inventario/inventario.php");
        exit();
    }
} else {
    echo "Método no permitido.";
}
?>
