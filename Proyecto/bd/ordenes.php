\<?php
session_start();
include 'conexion_be.php';

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$query = "SELECT * FROM ordenes ORDER BY fecha DESC";
$result = $conexion->query($query);

if (!$result) {
    die("Error en la consulta: " . $conexion->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo_ordenes.css">
</head>
<body>
  <nav class="navbar">
    <div class="logo">Mi Proyecto</div>
    <ul class="nav-links">
      <li><a href="../Inicio/index.php">Inicio</a></li>
      <li><a href="../otros/servicios.html">Servicios</a></li>
      <li><a href="../otros/consulta.html">Consultas</a></li>
      <li><a href="../inventario/inventario.php">Agregar</a></li>
    </ul>
    <button class="login-btn" onclick="window.location.href='../bd/login.php'">Cerrar Sesión</button>
  </nav>

  <table>
    <thead>
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Salida</th>
            <th>Entrega</th>
            <th>Código Postal</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['nombre_producto']) ?></td>
                    <td><?= htmlspecialchars($row['cantidad']) ?></td>
                    <td><?= htmlspecialchars($row['ubicacion_salida']) ?></td>
                    <td><?= htmlspecialchars($row['ubicacion_entrega']) ?></td>
                    <td><?= htmlspecialchars($row['codigo_postal']) ?></td>
                    <td><?= htmlspecialchars($row['fecha']) ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">No se encontraron órdenes.</td>
            </tr>
        <?php endif; ?>
    </tbody>
  </table>
</body>
</html>
