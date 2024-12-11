<style>
    body {
        margin: 0;
        font-family: 'Arial', sans-serif;
        background-color: #f4f6f9;
        color: #333;
    }

    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 30px;
        background-color: #2c3e50;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .navbar .logo {
        font-size: 24px;
        font-weight: bold;
        color: #ecf0f1;
    }

    .navbar .nav-links {
        list-style: none;
        display: flex;
        gap: 20px;
    }

    .navbar .nav-links a {
        text-decoration: none;
        color: #ecf0f1;
        font-size: 16px;
        transition: color 0.3s;
    }

    .navbar .nav-links a:hover {
        color: #3498db;
    }

    .navbar .login-btn {
        padding: 10px 20px;
        background-color: #e74c3c;
        border: none;
        border-radius: 4px;
        color: white;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .navbar .login-btn:hover {
        background-color: #c0392b;
    }

    .contenedor-inventario {
        width: 90%;
        margin: 20px auto;
        text-align: center;
    }

    h1, h2 {
        color: #2c3e50;
        margin-bottom: 15px;
    }

    h1 {
        font-size: 28px;
    }

    h2 {
        font-size: 22px;
        color: #34495e;
    }

    .tabla-inventario {
        margin-top: 30px;
        padding: 20px;
        background-color: #ffffff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow-x: auto;
    }

    .tabla-inventario table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .tabla-inventario th, .tabla-inventario td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
    }

    .tabla-inventario th {
        background-color: #3498db;
        color: white;
    }

    .tabla-inventario tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .tabla-inventario tr:hover {
        background-color: #e6f7ff;
    }

    .tabla-inventario td[colspan="3"] {
        text-align: center;
        font-style: italic;
    }

    .tabla-inventario a {
        display: inline-block;
        padding: 8px 12px;
        margin: 5px;
        font-size: 14px;
        font-weight: bold;
        text-decoration: none;
        color: #fff;
        border-radius: 4px;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .tabla-inventario a:hover {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    }

    .tabla-inventario a[href*="editar_producto"] {
        background-color: #3498db;
    }

    .tabla-inventario a[href*="editar_producto"]:hover {
        background-color: #2980b9;
    }

    .tabla-inventario a[href*="eliminar_producto"] {
        background-color: #e74c3c;
    }

    .tabla-inventario a[href*="eliminar_producto"]:hover {
        background-color: #c0392b;
    }

    @media (max-width: 768px) {
        .tabla-inventario table {
            font-size: 14px;
        }
    }
</style>


<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    header("Location: ../bd/login.php");
    exit();
}

include '../bd/conexion_be.php';

$tablas = ['almacen', 'tienda1', 'tienda2', 'proveedor'];
$productos = [];

foreach ($tablas as $tabla) {
    $query = "SELECT id, nombre, cantidad, '$tabla' AS ubicacion FROM $tabla"; 
    $result = mysqli_query($conexion, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $productos[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
    <link rel="stylesheet" href="../css/estilo_inv.css">
</head>
<body>
    <nav class="navbar">
        <div class="logo">Mi Proyecto</div>
        <ul class="nav-links">
            <li><a href="../Inicio/index.php">Inicio</a></li>
            <li><a href="../otros/servicios.html">Servicios</a></li>
            <li><a href="../otros/consulta.html">Consultas</a></li>
            <li><a href="../bd/ordenes.php">Órdenes</a></li>
            <li><a href="../inventario/inventario.php">Agregar</a></li>
        </ul>
        <button class="login-btn" onclick="window.location.href='../bd/login.php'">Cerrar Sesión</button>
    </nav>

    <div class="contenedor-inventario">
        <div class="tabla-inventario">
            <h2>Productos en Inventario</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Ubicación</th>
                        <th colspan="2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($productos)): ?>
                        <?php foreach ($productos as $producto): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($producto['cantidad']); ?></td>
                                <td><?php echo htmlspecialchars($producto['ubicacion']); ?></td>
                                <td>
                                    <a href="editar_producto.php?id=<?php echo $producto['id']; ?>&tabla=<?php echo $producto['ubicacion']; ?>">Editar</a>
                                </td>
                                <td>
                                    <a href="eliminar_producto.php?id=<?php echo $producto['id']; ?>&tabla=<?php echo $producto['ubicacion']; ?>" 
                                       onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">
                                       Eliminar
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">No hay productos en el inventario.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
