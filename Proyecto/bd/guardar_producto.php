<?php
include 'conexion_be.php'; 

$nombre = $_POST['firstName'];
$cantidad = $_POST['lastName'];
$zona = $_POST['zona'];
$ubicacion_salida = $_POST['city'];
$ubicacion_entrega = $_POST['cd'];
$codigo_postal = $_POST['zip'];

if (empty($nombre) || empty($cantidad) || empty($zona)) {
    die("Por favor, llena todos los campos requeridos.");
}

$tabla = '';
switch ($zona) {
    case 'norte': 
        $tabla = 'almacen';
        break;
    case 'sur': 
        $tabla = 'tienda1';
        break;
    case 'este':
        $tabla = 'tienda2';
        break;
    case 'oeste': 
        $tabla = 'proveedor';
        break;
    default:
        die("Zona no válida.");
}

$sql = "INSERT INTO $tabla (nombre, cantidad, ubicacion_salida, ubicacion_entrega, codigo_postal)
        VALUES ('$nombre', $cantidad, '$ubicacion_salida', '$ubicacion_entrega', '$codigo_postal')";

if (mysqli_query($conexion, $sql)) {
    header("Location: ../inventario/inventario.php");
    exit();
} else {
    echo "Error: " . mysqli_error($conexion);
}

mysqli_close($conexion);
?>
