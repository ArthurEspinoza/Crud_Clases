<?php 
    session_start();
    //include('controller/acciones.php');
    $usuario = $_SESSION['usuario'];
    //$modelo = getModelo($usuario);
    echo $usuario;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Editar Modelo <?php echo $usuario['nombre']?></h1>
</body>
</html>