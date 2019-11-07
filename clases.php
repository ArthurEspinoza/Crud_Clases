<?php 
    session_start();
    include('controller/acciones.php');
    $usuario = $_SESSION['usuario'];
    $idModelo = $_GET['idModelo'];
    $clases = getClases($idModelo);
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
    <title>Clases</title>
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
                                    foreach ($clases as $row) {
                                        echo '<tr>
                                                <td>'.$row['nombre'].'</td>
                                                <td>
                                                    <a href="editarClase.php?idModelo='.urlencode($row['idModelo']).'" id='.$row['idClases'].'>Editar</a>
                                                    <a href="controller/borrarClase.php?idModelo='.urlencode($row['idModelo']).'">Eliminar</a>
                                                </td>
                                            </tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>