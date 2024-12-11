<?php
include '../bd/conexion_be.php';

if (isset($_GET['categoria'])) {
    $categoria = $_GET['categoria'];

    $categorias_validas = ['almacen', 'proveedor', 'tienda1', 'tienda2'];
    if (!in_array($categoria, $categorias_validas)) {
        echo json_encode([]);
        exit();
    }

    $query = "SELECT nombre, cantidad FROM $categoria";
    $result = mysqli_query($conexion, $query);

    $productos = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $productos[] = $row;
        }
    }

    echo json_encode($productos);
    mysqli_close($conexion);
} else {
    echo json_encode([]);
}
?>
