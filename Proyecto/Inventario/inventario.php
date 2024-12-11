<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');

* {
    border: 0;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Inter", sans-serif;
}

.navbar {
    width: 100vw;
    height: 10vh;

    background-color: #ffffff;

    display: flex;
    justify-content: space-between;
    align-items: center;

    padding: 0 3em;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.navbar .logo {
    font-size: 24px;
    font-weight: bolder;
    color: #000;
}

.navbar .nav-links {
    display: flex;
    gap: 2em;
    font-size: 14px;
}

.navbar .nav-links a {
    color: #000;
    text-decoration: none;
    font-size: 14px;
    transition: color 0.3s;
}

.navbar .nav-links a:hover {
    color: #3498db;
}

.navbar .login-btn {
    padding: 0.5em 2em;
    background-color: #000;
    border: none;
    color: #fff;
    font-weight: bolder;
    font-size: 12px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.navbar .login-btn:hover {
    background-color: #444;
}

.contenedor-inventario {
    width: 90vw;
    margin: 2em auto;
    text-align: center;
    color: #333;
}

h1, h2 {
    font-weight: bolder;
    margin-bottom: 15px;
    text-transform: uppercase;
}

h1 {
    font-size: 28px;
    color: #000;
}

h2 {
    font-size: 22px;
    color: #333;
}

.formularios {
    display: flex;
    justify-content: space-between;
    gap: 2em;
    margin-bottom: 30px;
}

.formulario {
    background-color: #ffffff;
    padding: 2em;
    box-shadow: inset 0 0 4px rgba(195, 195, 195, 0.5);
    border-radius: 8px;
    width: 48%;
    text-align: left;
}

.formulario label {
    font-size: 14px;
    font-weight: bold;
    color: #333;
    display: block;
    margin-bottom: 0.5em;
}

.formulario input, .formulario select, .formulario button {
    width: 100%;
    padding: 0.7em;
    margin-bottom: 1em;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
}

.formulario input:focus, .formulario select:focus {
    border-color: #000;
    outline: none;
}

.formulario button {
    background-color: #000;
    color: #fff;
    font-weight: bolder;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s;
}

.formulario button:hover {
    background-color: #444;
}

@media (max-width: 768px) {
    .formularios {
        flex-direction: column;
    }

    .formulario {
        width: 100%;
    }
}
.nav2 {
    width: 60vw;
    height: 5vh;

    background-color: #000;

    display: flex;
    justify-content: center;
    align-items: center;

    gap: em;
}

.nav2 button {
    color: #fff;
    background-color: #000;

    font-size: 12px;

    cursor: pointer;
    border: none;
    padding: 0.5em 1em;
    transition: background-color 0.3s;
}

.nav2 button:hover {
    background-color: #333;
}


</style>

<?php
session_start();

$operacion = ($_SESSION['tipo_usuario'] == 'administrador') ? 'display:none;' : 'display:block;';

if (!isset($_SESSION['usuario'])) {
    header("Location: ../bd/login.php");
    exit();
}


include '../bd/conexion_be.php';
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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion']) && $_POST['accion'] === 'agregar') {
        $nombre = $_POST['nombre'];
        $cantidad = $_POST['cantidad'];
        $ubicacion = $_POST['ubicacion'];
        $codigo_postal = $_POST['codigo_postal'];

        $query_agregar = "INSERT INTO $ubicacion (nombre, cantidad) VALUES (?, ?)";
        $stmt_agregar = $conexion->prepare($query_agregar);
        $stmt_agregar->bind_param("si", $nombre, $cantidad);
        $stmt_agregar->execute();
        $stmt_agregar->close();

        $mensaje = "Producto agregado exitosamente.";
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'ordenar') {
  $nombre = $_POST['nombre'];
  $cantidad = $_POST['cantidad'];
  $ubicacion_salida = $_POST['ubicacion_salida'];
  $ubicacion_entrega = $_POST['ubicacion_entrega'];
  $codigo_postal = $_POST['codigo_postal'];  

  $query_verificar = "SELECT * FROM $ubicacion_salida WHERE nombre = ? AND cantidad >= ?";
  $stmt_verificar = $conexion->prepare($query_verificar);
  $stmt_verificar->bind_param("si", $nombre, $cantidad);
  $stmt_verificar->execute();
  $result = $stmt_verificar->get_result();

  if ($result->num_rows > 0) {
      $query_reducir = "UPDATE $ubicacion_salida SET cantidad = cantidad - ? WHERE nombre = ?";
      $stmt_reducir = $conexion->prepare($query_reducir);
      $stmt_reducir->bind_param("is", $cantidad, $nombre);
      $stmt_reducir->execute();

      $query_orden = "INSERT INTO ordenes (nombre_producto, cantidad, ubicacion_salida, ubicacion_entrega, codigo_postal, fecha) 
                      VALUES (?, ?, ?, ?, ?, NOW())";
      $stmt_orden = $conexion->prepare($query_orden);
      $stmt_orden->bind_param("sisss", $nombre, $cantidad, $ubicacion_salida, $ubicacion_entrega, $codigo_postal);
      $stmt_orden->execute();

      $mensaje = "Producto ordenado exitosamente.";
  } else {
      $mensaje = "Stock insuficiente en la ubicación de salida.";
  }

  $stmt_verificar->close();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Inventario</title>
</head>
<body>
    <nav class="navbar">
        <div class="logo">Mi Proyecto</div>
        <div class="nav2">
        <button onclick="window.location.href='../inicio/index.php'">Inicio</button>
    <button onclick="window.location.href='../bd/ordenes.php'">Ver Órdenes</button>
    <button onclick="window.location.href='mostrar_productos.php'">Productos en inventario</button>
    <button onclick="window.location.href='../otros/servicios.html'">Servicios</button>


</div>
        <button class="login-btn" onclick="window.location.href='../bd/login.php'">Cerrar Sesión</button>
    </nav>

    <div class="contenedor-inventario">
        <h1>Gestión de Inventario</h1>

        <div class="formularios">
            <div class="formulario" style="<?php echo $operacion; ?>">
                <h2>Agregar Producto</h2>
                <form method="POST" action="">
                    <input type="hidden" name="accion" value="agregar">
                    <label for="nombre">Nombre del Producto:</label>
                    <input type="text" id="nombre" name="nombre" required>

                    <label for="cantidad">Cantidad:</label>
                    <input type="number" id="cantidad" name="cantidad" required>

                    <label for="ubicacion">Ubicación:</label>
                    <select id="ubicacion" name="ubicacion" required>
                        <option value="almacen">Almacén</option>
                        <option value="tienda1">Tienda 1</option>
                        <option value="tienda2">Tienda 2</option>
                        <option value="proveedor">Proveedor</option>
                    </select>

                    <label for="codigo_postal">Código Postal:</label>
                    <input type="text" id="codigo_postal" name="codigo_postal" required>

                    <button type="submit">Agregar Producto</button>
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

                    <label for="ubicacion_salida">Ubicación de salida:</label>
                    <select id="ubicacion_salida" name="ubicacion_salida" required>
                        <option value="almacen">Almacén</option>
                        <option value="tienda1">Tienda 1</option>
                        <option value="tienda2">Tienda 2</option>
                        <option value="proveedor">Proveedor</option>
                    </select>

                    <label for="ubicacion_entrega">Ubicación de entrega:</label>
                    <select id="ubicacion_entrega" name="ubicacion_entrega" required>
                        <option value="almacen">Almacén</option>
                        <option value="tienda1">Tienda 1</option>
                        <option value="tienda2">Tienda 2</option>
                        <option value="proveedor">Proveedor</option>
                    </select>

                    <label for="codigo_postal">Código Postal:</label>
                    <input type="text" id="codigo_postal" name="codigo_postal" required>

                    <button type="submit">Ordenar Producto</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
