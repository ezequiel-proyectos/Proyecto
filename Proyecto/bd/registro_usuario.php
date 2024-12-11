<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
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
        .right .box_inputs .box input,
        .right .box_inputs .box select {
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
            background-color: #ffffff;
            border: .1em solid #9b9b9b;
            color: #000;
        }
        #token-container {
            display: none;
        }
    </style>
    <script>
        function toggleTokenField() {
            const tipoUsuario = document.getElementById('tipo_usuario').value;
            const tokenContainer = document.getElementById('token-container');
            const tokenInput = document.getElementById('token_acceso');
            
            if (tipoUsuario === 'proveedor' || tipoUsuario === 'administrador') {
                tokenContainer.style.display = 'block';
                if (tipoUsuario === 'proveedor') {
                } else if (tipoUsuario === 'administrador') {
                }
            } else {
                tokenContainer.style.display = 'none';
                tokenInput.value = '';  
            }
        }
    </script>
</head>
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
    <div class="right">
        <p class="p2">
            Crea tu cuenta
        </p>
        <div class="box_inputs">
            <form action="registro_usuario_be.php" method="POST" style="margin: 0;">
                <div class="box">
                    Nombre Completo:
                    <input type="text" name="nombre_completo" placeholder="Ingresa tu nombre completo" required>
                </div>
                <div class="box">
                    Correo Electrónico:
                    <input type="email" name="correo" placeholder="Ingresa tu correo electrónico" required>
                </div>
                <div class="box">
                    Usuario:
                    <input type="text" name="usuario" placeholder="Ingresa tu usuario" required>
                </div>
                <div class="box">
                    Contraseña:
                    <input type="password" name="contrasena" placeholder="Ingresa tu contraseña" required>
                </div>
                <div class="box">
                    Tipo de Registro:
                    <select id="tipo_usuario" name="tipo_usuario" onchange="toggleTokenField()" required>
                        <option value="usuario">Usuario</option>
                        <option value="proveedor">Proveedor</option>
                        <option value="administrador">Administrador</option>
                    </select>
                </div>
                <div id="token-container" class="box">
                    Token de Acceso:
                    <input type="text" name="token_acceso" id="token_acceso" placeholder="Ingresa el token de acceso">
                </div>
                <div class="buttons">
                    <button type="submit">Registrarse</button>
                    <a href="../bd/login.php">
                        <button type="button" class="regis">Inicia sesión</button>
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
