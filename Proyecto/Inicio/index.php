<?php
session_start();
if (!isset($_SESSION['usuario'])) {
   
    header("Location: ../bd/login.php");
    exit(); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/index_new.css">
</head>
<body>

<script type="text/javascript">
  (function(d, t) {
      var v = d.createElement(t), s = d.getElementsByTagName(t)[0];
      v.onload = function() {
        window.voiceflow.chat.load({
          verify: { projectID: '67532191fe0f18d9923ef328' },
          url: 'https://general-runtime.voiceflow.com',
          versionID: 'production'
        });
      }
      v.src = "https://cdn.voiceflow.com/widget/bundle.mjs"; v.type = "text/javascript"; s.parentNode.insertBefore(v, s);
  })(document, 'script');
</script>

    <div class="page_label" id="fecha">
        
    </div>
    <div class="nav1">
        <div class="box">
            <a href="../inventario/mostrar_productos.php">Productos</a>
            <a href="../otros/recursos.html">Recursos</a>
        </div>
        <div class="box">
            <button onclick="window.location.href='../inicio/cerrar_log.php'">
                Cerrar sesion
            </button>
        </div>
    </div>
    <div class="nav2">
      <button onclick="window.location.href='../inventario/inventario.php'">Inventario</button>  
      <button onclick="window.location.href='../otros/servicios.html'">Servicios</button>
      <button onclick="window.location.href='../otros/consulta.html'">Consulta</button>
    </div>
    <div class="section">
        <div class="img"></div>
        <div class="pres">

            <p class="p1">
                SERVICIO DE <br> GESTIÓN <br> DE ALMACENES
            </p>
            <p class="p2">
                Optimiza tu inventario y mejora tu productividad con esta solución. 
            </p>
            <a href="../otros/creadores.html" class="a">
                Creadores
            </a>
        </div>
    </div>

    <script>
        const fechaActual = new Date();
    
        const opciones = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        const fechaFormateada = fechaActual.toLocaleDateString('es-ES', opciones);
    
        document.getElementById('fecha').textContent = `${fechaFormateada}`;
    </script>
</body>
</html>