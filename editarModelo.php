<?php
    session_start();
    include('controller/acciones.php');
    $usuario = $_SESSION['usuario'];
    //echo $usuario;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/Bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/Bootstrap/bootstrap-grid.min.css">
    <!--<link rel="stylesheet" href="css/crud.css">-->
    <script src="js/Bootstrap/bootstrap.min.js"></script>
    <script src="js/Bootstrap/bootstrap.js"></script>
    <script src="js/jquery-3.4.1.min.js"></script>

    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js" integrity="sha384-kW+oWsYx3YpxvjtZjFXqazFpA7UP/MbiY4jvs+RWZo2+N94PFZ36T6TFkc9O3qoB" crossorigin="anonymous"></script>
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/google/code-prettify@master/loader/run_prettify.js"></script>        
    <title>Modelos</title>
</head>
<body onload="mostrar()">
    <div class="container">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    Crud Clases
                </div>
                <div class="card-body">
                    <h5 class="card-title">Clases</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr align='center'>
                                    <th>Nombre</th>
                                    <th>Operaciones</th>
                                </tr>
                            </thead>
                            <tbody id="ress">                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>        
            <button onclick="location.href='clases.php'">Ir a clases</button>
        </div>
    </div>
    <div id="res"></div>
</body>
</html>
<?php
    //Obtiene id seleccionado
    $idModelo = $_GET['idModelo'];
    echo "<script>\n";
    echo "idModelo='".$idModelo."'\n";
    echo "</script>\n";
    
    //Muestra clases 
    $clase = getClases($idModelo);
    //if(!$class)
    //{
            foreach ($clase as $row) {
        //$_POST['nombre']=$row['nombre'];
        $clases = [
            "clases" => ""
        ];
        $classData[] = array(
        'idClases'=> urlencode($row['idClases']), 
        'nombre'=> $row['nombre'],
        'herencia'=> $row['herencia'],
        'idModelo'=> urlencode($row['idModelo']), 
        'idUsuario'=> urlencode($row['idUsuario']) 
        );
    }
    $clases["clases"]=$classData;
    $_POST['clases']=$clases;
    echo "<script>\n";
    echo "res='".json_encode($_POST['clases'])."'\n";
    echo "</script>\n";  
    //}

?>
<script type="text/javascript">
    console.log(idModelo);
var usuario = '<?php echo $usuario;?>';
function mostrar(){

    var r = JSON.parse(res);
    var output="<table border='1px' cellpadding='10' width='50%' height='150%'>";      
    var id;
    for (var i in r.clases) 
    {
        output+="<tr align='center'>";
        id = r.clases[i].idClases;
            output+="<td id='nombre' data-id_nombre='" + id + "' contenteditable>" + r.clases[i].nombre + "</td>";
            output+="<td><button class='boton_personalizado' id='eliminar' data-id='" + id + "'>Eliminar</button>"; 
            output+="<a class='boton_personalizado' href=editarClase.php?idModelo="+ idModelo +"&idClase="+ id + ">Modificar</a></td>";
        output+="</tr>";
    }
    output+="<tr align='center'>" +
        "<td id='nombre_add' contenteditable></td>  " +
        "<td><button id='add'>Agregar</button></td>" +
    "</tr>";    
    output+="</table>";       
    
    $("#ress").html(output);    
}    
    //DELETE FUNCTION
    $(document).on("click","#eliminar",function(){
        if(confirm("esta seguro de que desea eliminar este registro."))
        {
            var ids = $(this).data("id");
            console.log(ids);
            console.log(usuario);
            
            var type = "eliminarClase";
            console.log(type);
            var parametros ={
                "idm": idModelo,
                "idc" : ids,
                "usuario" : usuario,
                "type": type
            };
            console.log(parametros)
            $.ajax({
                url: "../Crud_Clases/controller/eliminarClase.php",
                method: "POST",
                data: parametros,
                success: function(answer)
                {
            //var answer = "";
                    console.log(answer);
                    var re = JSON.parse(answer);
                    console.log(re);        
                    var out="<table border='1px' cellpadding='10' width='50%' height='150%'>";
                    var idd;
                    for (var i in re.clases) 
                    {
                        out+="<tr align='center'>";
                            idd = re.clases[i].idClases;
                            out+="<td id='nombre' data-id_nombre='" + idd + "' contenteditable>" + re.clases[i].nombre + "</td>";
                            out+="<td><button class='boton_personalizado' id='eliminar' data-id='" + idd + "'>Eliminar</button>"; 
                            out+="<a class='boton_personalizado' href=editarClase.php?idModelo="+ idModelo +"&idClase="+ idd + ">Modificar</a></td>";
                        out+="</tr>";            
                    }
                    out+="<tr align='center'>" +
                        "<td id='nombre_add' contenteditable></td>" +
                        "<td><button id='add'>Agregar</button></td>" +
                    "</tr>";                    
                    out+="</table>";
                    $("#ress").html(out);
                }
            });
        }
    })    
    //Actualizar Modelo
    $(document).on("blur","#nombre",function(){
        var id = $(this).data("id_nombre");
        var nombre = $(this).text();
        actualizar_datos(id,nombre,"nombre");
    })   
    function actualizar_datos(id, texto, columna){
        var type = "actualizarClase";
        $.ajax({
            url: "../Crud_Clases/controller/actualizarClase.php",
            method: "POST",
            data: {
                "idm": idModelo,
                id: id, 
                "usuario" : usuario,
                "type": type,
                texto: texto,
                columna: columna
            },
            success: function(answer){
                    console.log(answer);
                    var re = JSON.parse(answer);
                    console.log(re);        
                    var out="<table border='1px' cellpadding='10' width='50%' height='150%'>";
                    var idd;
                    for (var i in re.clases) 
                    {
                        out+="<tr align='center'>";
                            idd = re.clases[i].idClases;
                            out+="<td id='nombre' data-id_nombre='" + idd + "' contenteditable>" + re.clases[i].nombre + "</td>";
                            out+="<td><button class='boton_personalizado' id='eliminar' data-id='" + idd + "'>Eliminar</button>"; 
                            out+="<a class='boton_personalizado' href=editarClase.php?idModelo="+ idModelo +"&idClase="+ idd + ">Modificar</a></td>";
                        out+="</tr>";            
                    }
                    out+="<tr align='center'>" +
                        "<td id='nombre_add' contenteditable></td>" +
                        "<td><button id='add'>Agregar</button></td>" +
                    "</tr>";                    
                    out+="</table>";
                    $("#ress").html(out);
            }
        });
    }
</script>