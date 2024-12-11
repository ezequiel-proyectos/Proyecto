<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos</title>
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
        </ul>
        <button class="login-btn" onclick="window.location.href='../bd/login.php'">Cerrar Sesión</button>
    </nav>

    <div class="contenedor-inventario">
        <h1>Gestión de Inventario</h1>

        <div class="formulario">
            <h2>Agregar Producto</h2>
            <form method="POST" action="">
                <input type="hidden" name="accion" value="agregar">
                <label for="nombre">Nombre del Producto:</label>
                <input type="text" id="nombre" name="nombre" required>

                <label for="cantidad">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" required>

                <label for="codigo_postal">Código Postal:</label>
                <input type="text" id="codigo_postal" name="codigo_postal" required>

                <label for="ubicacion">Ubicación:</label>
                <select id="ubicacion" name="ubicacion" required>
                    <option value="almacen">Almacén</option>
                    <option value="tienda1">Tienda 1</option>
                    <option value="tienda2">Tienda 2</option>
                    <option value="proveedor">Proveedor</option>
                </select>

                <button type="submit">Agregar</button>
            </form>
        </div>

        <div class="formulario">
            <h2>Ordenar Producto</h2>
            <form method="POST" action="">
                <input type="hidden" name="accion" value="ordenar">
                <label for="nombre">Nombre del Producto:</label>
                <input type="text" id="nombre" name="nombre" required>

                <label for="cantidad">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" required>

                <label for="codigo_postal">Código Postal:</label>
                <input type="text" id="codigo_postal" name="codigo_postal" required>

                <label for="ubicacion_salida">Ubicación de Salida:</label>
                <select id="ubicacion_salida" name="ubicacion_salida" required>
                    <option value="almacen">Almacén</option>
                    <option value="tienda1">Tienda 1</option>
                    <option value="tienda2">Tienda 2</option>
                    <option value="proveedor">Proveedor</option>
                </select>

                <label for="ubicacion_entrega">Ubicación de Entrega:</label>
                <select id="ubicacion_entrega" name="ubicacion_entrega" required>
                    <option value="almacen">Almacén</option>
                    <option value="tienda1">Tienda 1</option>
                    <option value="tienda2">Tienda 2</option>
                    <option value="proveedor">Proveedor</option>
                </select>

                <button type="submit">Ordenar</button>
            </form>
        </div>

        <?php include 'inventario.php'; ?>

    </div>
</body>
</html>
