<?php

session_start();

    if(isset($_SESSION['usuario'])){

        session_destroy();
        header("location: ../bd/login.php");
        exit();

    }else {

        header("location: ../bd/login.php");
        exit();
    }


?>