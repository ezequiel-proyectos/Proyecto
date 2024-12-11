<?php
include 'conexion_be.php';

$nombre_completo = $_POST['nombre_completo'];
$correo = $_POST['correo'];
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];
$tipo_usuario = $_POST['tipo_usuario']; 
$token_acceso = $_POST['token_acceso']; 

$verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo = '$correo'");
if (mysqli_num_rows($verificar_correo) > 0) {
    echo '
    <script>
        alert("Este correo ya está en uso. Intenta con otro.");
        window.location = "../registro_usuario.php";
    </script>
    ';
    exit();
}

$verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario = '$usuario'");
if (mysqli_num_rows($verificar_usuario) > 0) {
    echo '
    <script>
        alert("Este usuario ya está en uso. Intenta con otro.");
        window.location = "../registro_usuario.php";
    </script>
    ';
    exit();
}

if ($tipo_usuario === 'administrador' && $token_acceso !== 'admin1') {
    echo '
    <script>
        alert("El token ingresado para Administrador no es válido.");
        window.location = "../bd/registro_usuario.php";
    </script>
    ';
    exit();
}

if ($tipo_usuario === 'proveedor' && $token_acceso !== 'proveedor1') {
    echo '
    <script>
        alert("El token ingresado para Proveedor no es válido.");
        window.location = "../bd/registro_usuario.php";
    </script>
    ';
    exit();
}

$query = "INSERT INTO usuarios(nombre_completo, correo, usuario, contrasena, tipo_usuario, token_acceso)
          VALUES('$nombre_completo', '$correo', '$usuario', '$contrasena', '$tipo_usuario', '$token_acceso')";

$ejecutar = mysqli_query($conexion, $query);

if ($ejecutar) {  
    echo '
    <script>
        alert("Usuario registrado exitosamente.");
        window.location = "../bd/login.php";
    </script>';
} else {
    echo '
    <script>
        alert("Hubo un error. Inténtalo nuevamente.");
        window.location = "../registro_usuario.php";
    </script>';
}

mysqli_close($conexion);
?>
