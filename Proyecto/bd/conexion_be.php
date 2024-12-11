<?php

$conexion  = mysqli_connect("localhost","root","","login_registrer_db");

if($conexion){
    echo'';
}else{
    echo'No se ha podido conectar a la base de datos';
}
?>