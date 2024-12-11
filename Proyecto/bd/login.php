
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio de Sesión</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');
        * {
            border: 0;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Inter", sans-serif;
        }
        body {
            background-image: url('../img/imagen1.jpg');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;

            width: 100vw;
            height: 100vh;

            display: flex;
            justify-content: space-between;
            overflow: hidden;
        }
        .left {
            width: 70%;
            height: 100%;
            position: relative;
            background-image: linear-gradient(rgb(0,0,0,.0), rgb(0,0,0,.0), rgb(0,0,0,1));
        }
        .left .p {
            position: absolute;
            top: 50%;
            left: 45%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: #ffffff;
            text-transform: uppercase;
            font-weight: bold;
            font-size: 32px;
            letter-spacing: -5%;
            width: 80%;
        }
        .left .mails {
            position: absolute;
            display: flex;
            justify-content: center;
            gap: 45px;
            width: 80%;
            bottom: 3%;
            left: 43%;
            transform: translateX(-50%);
            font-size: 10px;
        }
        .left .mails a {
            color: #FCFCFC;
            text-decoration: none;
        }
        .right {
            width: 30%;
            height: 100%;
            background-color: #fff;
            position: relative;
            padding-top: 4em;
        }
        .right .p2 {
            color: #000000;
            text-transform: uppercase;
            font-weight: bold;
            font-size: 27px;
            letter-spacing: -6%;
            text-align: center;
        }
        .right .box_inputs {
            width: 90%;
            margin: 2em auto;
            display: flex;
            flex-direction: column;
            gap: 1.5em;
        }
        .right .box_inputs .box {
            display: flex;
            flex-direction: column;
            gap: .3em;
            font-weight: bolder;
        }
        .right .box_inputs .box input {
            padding: 1em;
            border-radius: 8px;
            border: .1em solid #9b9b9b;
        }
        .right .buttons {
            width: 90%;
            margin: 1.5em auto;
            text-align: center;
            font-size: 14px;
            display: flex;
            flex-direction: column;
            gap: 1em;
        }
        .right .buttons button {
            display: inline-block;

            width: 100%;
            padding: 1em;
            background-color: #1E1E1E;
            color: #fff;
            border-radius: 8px;
            font-weight: bolder;
        }
        .right .buttons p {
            margin: 0;
            color: #000;
            font-size: 14px;
            font-weight: bold;
        }
        .right .buttons .regis {
            display: inline-block;

            width: 100%;
            padding: 1em;
            border-radius: 8px;
            font-weight: bolder;

            background-color: #ffffff;
            border: .1em solid #9b9b9b;
            color: #000;

            text-decoration: none;
        }
        .right .forgot {
            display: inline-block;
            width: 90%;
            margin-top: 1em;
            font-size: 12px;
            text-align: end;
            text-decoration: none;
            color: #000;
            font-weight: bolder;
        }
    </style>
<body>
    <div class="left">
        <p class="p">
            Proyecto Estudiantil: gestión eficiente de almacenes para el crecimiento empresarial.
        </p>
        <div class="mails">
            <a href="">@Emmanuel Garcia</a>
            <a href="">@Javier Emiliano</a>
            <a href="">@Emiliano Vargas</a>
            <a href="">@Cristian Uriegas</a>
            <a href="">@Ezequiel Torres</a>
        </div>
    </div>
    <form action="login_usuario_be.php" method="POST" class="right">
        <p class="p2">
            Bienvenido <br> de nuevo
        </p>
        <div class="box_inputs">
            <div class="box">
                Usuario:
                <input type="text" name="correo" placeholder="Ingresa tu usuario" required>
            </div>
            <div class="box">
                Contraseña:
                <input type="password" name="contrasena" placeholder="Ingresa tu contraseña" required>
            </div>
        </div>
        <a href="" class="forgot">Olvidé mi contraseña</a>
        <div class="buttons">
            <div style="margin: 0;">
                <button class="button" type="submit">Ingresar</button>
        </div>
            <p>O</p>
            <div style="margin: 0;">
                <a href="registro_usuario.php" class="button regis">Regístrate</a>
            </div>
        </div>
    </form>
</body>
