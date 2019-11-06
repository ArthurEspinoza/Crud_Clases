<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/Bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/Bootstrap/bootstrap-grid.min.css">
    <link rel="stylesheet" href="css/index.css">
    <script src="js/Bootstrap/bootstrap.min.js"></script>
    <script src="js/Bootstrap/bootstrap.js"></script>
    <script src="js/jquery-3.4.1.min.js"></script>
    <title>Login</title>
</head>
<body>
    <section id="login">
        <div id="loginHeader">
            <img src="img/fondo_login.jpg" alt="fondo-login">
            <div class="textoImg">Inicio de Sesión</div>
        </div>
        <div>
            <form action="controller/acciones.php" method="POST">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="usuario">Usuario</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Introduce tu nombre de usuario">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="correo" class="col-sm-2 col-form-label">Contraseña</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="contra" id="contra" placeholder="Introduce tu contraseña">
                    </div>
                </div>
                <input type="submit" class="btnPrimario" name="loginBtn" id="loginBtn" value="Entrar">
            </form>
        </div>
    </section>
</body>
</html>