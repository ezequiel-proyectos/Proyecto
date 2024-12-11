<?php
session_start();
include 'conexion_be.php';

$usuario = $_POST['correo'];
$contrasena = $_POST['contrasena'];

$query = "SELECT * FROM usuarios WHERE correo = '$usuario' AND contrasena = '$contrasena'";
$result = mysqli_query($conexion, $query);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['usuario'] = $row['usuario'];  
    $_SESSION['tipo_usuario'] = $row['tipo_usuario'];  

    header("Location: ../inicio/index.php");  
    exit();
} else {
    echo 'Credenciales incorrectas';

    echo $usuario;
    echo $contrasena;
}

?>
