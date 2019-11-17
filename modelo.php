<?php 
    session_start();
    include('controller/acciones.php');
    $usuario = $_SESSION['usuario'];
    $idU = $_SESSION['idUsuario'];
    echo $idU;
    $modelo = getModelo($usuario);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/Bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/Bootstrap/bootstrap-grid.min.css">
    <link rel="stylesheet" href="css/crud.css">
    <script src="js/Bootstrap/bootstrap.min.js"></script>
    <script src="js/Bootstrap/bootstrap.js"></script>
    <script src="js/jquery-3.4.1.min.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    Crud Clases
                </div>
                <div class="card-body">
                    <h5 class="card-title">Modelos</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Operaciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach ($modelo as $row) {
                                        echo '<tr>
                                                <td>'.$row['nombre'].'</td>
                                                <td>
                                                    <a href="clases.php?idModelo='.urlencode($row['idModelo']).'">Ver</a>
                                                    <a href="editarModelo.php?idModelo='.urlencode($row['idModelo']).'">Editar</a>
                                                    <a href="controller/borrarModelo.php?idModelo='.urlencode($row['idModelo']).'">Eliminar</a>
                                                </td>
                                            </tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <button onclick="location.href='clases.php'">Ir a clases</button>
            <button onclick="location.href='index.html'"></button>
        </div>
        
    </div>
</body>
</html>