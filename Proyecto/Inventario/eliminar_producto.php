<?php
include '../bd/conexion_be.php';

if (isset($_GET['id'], $_GET['tabla'])) {
    $id = intval($_GET['id']);
    $tabla = $_GET['tabla'];

    $query = "DELETE FROM $tabla WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        header("Location: mostrar_productos.php");
        exit(); 
    } else {
        echo "Error al eliminar el producto.";
    }
} else {
    die("Parámetros inválidos.");
}
?>
