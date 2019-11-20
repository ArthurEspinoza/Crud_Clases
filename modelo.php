<?php
    session_start();
    include('controller/acciones.php');
    $usuario = $_SESSION['usuario'];
    //var_dump($modelo);
    //$eliminado = "";
    //echo $mod;
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
                    Crud Modelos
                </div>
                <div class="card-body">
                    <h5 class="card-title">Modelos</h5>
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
            <button onclick="location.href='index.html'"></button>
        </div>
    </div>
    <div id="res"></div>
</body>
</html>
<?php


    $modelo = getModelo($usuario);

    foreach ($modelo as $row) {
        //$_POST['nombre']=$row['nombre'];
        $modelos = [
            "modelos" => ""
        ];
        $modelData[] = array('idModelo'=> urlencode($row['idModelo']), 'nombre'=> $row['nombre']);
    }
    $modelos["modelos"]=$modelData;
    $_POST['modelos']=$modelos;
    echo "<script>\n";
    echo "res='".json_encode($_POST['modelos'])."'\n";
    echo "</script>\n";        

?>
<script>
var usuario = '<?php echo $usuario;?>';
function mostrar(){

    var r = JSON.parse(res);
    var output="<table border='1px' cellpadding='10' width='50%' height='150%'>";      
    var id;
    for (var i in r.modelos) 
    {
        output+="<tr align='center'>";
        id = r.modelos[i].idModelo;
            output+="<td id='nombre' data-id_nombre='" + id + "' contenteditable>" + r.modelos[i].nombre + "</td>";
            output+="<td><button class='boton_personalizado' id='eliminar' data-id='" + id + "'>Eliminar</button>"; 
            output+="<a class='boton_personalizado' href=editarModelo.php?idModelo="+ id + ">Modificar</a></td>";
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
            
            var type = "eliminarModelo";
            console.log(type);
            var parametros ={
                "id" : ids,
                "usuario" : usuario,
                "type": type
            };
            console.log(parametros)
            $.ajax({
                url: "../Crud_Clases/controller/crud.php",
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
                    for (var i in re.modelos) 
                    {
                        out+="<tr align='center'>";
                            idd = re.modelos[i].idModelo;
                            out+="<td id='nombre' data-id_nombre='" + idd + "' contenteditable>" + re.modelos[i].nombre + "</td>";
                            out+="<td><button class='boton_personalizado' id='eliminar' data-id='" + idd + "'>Eliminar</button>"; 
                            out+="<a class='boton_personalizado' href=editarModelo.php?idModelo="+ idd + ">Modificar</a></td>";
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
        var type = "actualizarModelo";
        $.ajax({
            url: "../Crud_Clases/controller/actualizar.php",
            method: "POST",
            data: {
                id: id, 
                "usuario" : usuario,
                "type": type,
                texto: texto,
                columna: columna
            },
            success: function(answers){
                console.log(answers);
                var res = JSON.parse(answers);
                console.log(res);        
                var out="<table border='1px' cellpadding='10' width='50%' height='150%'>";             
                var idd;
                for (var i in res.modelos) 
                {
                    out+="<tr align='center'>";
                        idd = res.modelos[i].idModelo;
                        out+="<td id='nombre' data-id_nombre='" + idd + "' contenteditable>" + res.modelos[i].nombre + "</td>";
                        out+="<td><button class='boton_personalizado' id='eliminar' data-id='" + idd + "'>Eliminar</button>"; 
                        out+="<a class='boton_personalizado' href=editarModelo.php?idModelo="+ idd + ">Modificar</a></td>";
                    out+="</tr>";            
                }
                out+="<tr align='center'>" +
                    "<td id='nombre_add' contenteditable></td>" +
                    "<td><button id='add'>Agregar</button></td>" +
                "</tr>";                      
                out+="</table>";
                //var outi="";
                //$("#ress").html(outi);
                $("#ress").html(out);
            }
        });
    }
    //Agregar modelo
    $(document).on("click","#add",function(){
        var nombre = $("#nombre_add").text();  
        var type = "agregarModelo";
        var parametros ={
            "usuario" : usuario,
            "type": type,
            "nombre": nombre
        };
        $.ajax({
            url: "../Crud_Clases/controller/agregar.php",
            method: "POST",
            data: parametros,
            success: function(asw){
                console.log(asw);
                var res = JSON.parse(asw);
                console.log(res);        
                var out="<table border='1px' cellpadding='10' width='50%' height='150%'>";             
                var idd;
                for (var i in res.modelos) 
                {
                    out+="<tr align='center'>";
                        idd = res.modelos[i].idModelo;
                        out+="<td id='nombre' data-id_nombre='" + idd + "' contenteditable>" + res.modelos[i].nombre + "</td>";
                        out+="<td><button class='boton_personalizado' id='eliminar' data-id='" + idd + "'>Eliminar</button>"; 
                        out+="<a class='boton_personalizado' href=editarModelo.php?idModelo="+ idd + ">Modificar</a></td>";
                    out+="</tr>";            
                }
                out+="<tr align='center'>" +
                    "<td id='nombre_add' contenteditable></td>" +
                    "<td><button id='add'>Agregar</button></td>" +
                "</tr>";                      
                out+="</table>";
                $("#ress").html(out);                
            }
        })
    })
</script>  
