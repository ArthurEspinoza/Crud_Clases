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
                    Crud Parametros
                </div>
                <div class="card-body">
                    <h5 class="card-title">Parametros</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr align='center'>
                                    <th>Nombre</th>
                                    <th>Tipo</th>
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
    $idClase = $_GET['idClase'];
    echo "<script>\n";
    echo "idClase='".$idClase."'\n";
    echo "</script>\n";

    //Obteniendo el modelo 
    $idModelo = $_GET['idModelo'];
    echo "<script>\n";
    echo "idModelo='".$idModelo."'\n";
    echo "</script>\n";

    //Obteniendo el metodo 
    $idMetodo = $_GET['idMetodo'];
    echo "<script>\n";
    echo "idMetodo='".$idMetodo."'\n";
    echo "</script>\n";
    
    //Muestra parametros
    $metodos = getParametros($idMetodo);
    foreach ($metodos as $row) {
        //$_POST['nombre']=$row['nombre'];
        $parametros = [
            "parametros" => ""
        ];
        $parametrosData[] = array(
        'idParametros'=> urlencode($row['idParametros']), 
        'nombre'=> $row['nombre'],
        'tipo'=> $row['tipo'],
        'idMetodos'=> urlencode($row['idMetodos']), 
        'idClases'=> urlencode($row['idClases']),             
        'idModelo'=> urlencode($row['idModelo']), 
        'idUsuario'=> urlencode($row['idUsuario']) 
        );
    }
    $parametros["parametros"]=$parametrosData;
    $_POST['parametros']=$parametros;
    echo "<script>\n";
    echo "res='".json_encode($_POST['parametros'])."'\n";
    echo "</script>\n";  

?>
<script type="text/javascript">
    console.log(idModelo);
    console.log(idClase);
    console.log(idMetodo);
var usuario = '<?php echo $usuario;?>';
function mostrar(){

    var r = JSON.parse(res);
    //console.log(r);
    var output="<table border='1px' cellpadding='10' width='50%' height='150%'>";      
    var id;
    for (var i in r.parametros) 
    {
        output+="<tr align='center'>";
        id = r.parametros[i].idParametros;
            output+="<td id='nombre' data-id_nombre='" + id + "' contenteditable>" + r.parametros[i].nombre + "</td>";
            output+="<td id='tipo' data-id_tipo='" + id + "' contenteditable>" + r.parametros[i].tipo + "</td>";
            output+="<td><button class='boton_personalizado' id='eliminar' data-id='" + id + "'>Eliminar</button>"; 
            //output+="<a class='boton_personalizado' href=editarMetodo.php?idModelo="+ idModelo +"&idClase="+ idClase +"&idMetodo="+ id + ">Modificar</a></td>";
        output+="</tr>";
    }
    output+="<tr align='center'>" +
        "<td id='nombre_add' contenteditable></td>  " +
        "<td id='tipo_add' contenteditable></td>  " +
        "<td><button id='add'>Agregar</button></td>" +
    "</tr>";    
    output+="</table>";       
    
    $("#ress").html(output);  
}    
    //DELETE FUNCTION FOR PARAMETROS
    $(document).on("click","#eliminar",function(){
        if(confirm("esta seguro de que desea eliminar este registro."))
        {
            var ids = $(this).data("id");
            console.log(ids);
            console.log(usuario);
            
            var type = "eliminarParametro";
            console.log(type);
            var parametros ={
                "idp": ids,
                "idm" : idMetodo,
                "usuario" : usuario,
                "type": type
            };
            console.log(parametros)
            $.ajax({
                url: "../Crud_Clases/controller/eliminarParametro.php",
                method: "POST",
                data: parametros,
                success: function(answer)
                {
                    console.log("answer", answer);
                    var a = JSON.parse(answer);
                    //console.log(rr);
                    var output="<table border='1px' cellpadding='10' width='50%' height='150%'>";      
                    var id;
                    console.log(a.parametros);
                    for (var i in a.parametros) 
                    {
                        output+="<tr align='center'>";
                            id = a.parametros[i].idParametros;
                            output+="<td id='nombre' data-id_nombre='" + id + "' contenteditable>" + a.parametros[i].nombre + "</td>";
                            output+="<td id='tipo' data-id_tipo='" + id + "' contenteditable>" + a.parametros[i].tipo + "</td>";
                            output+="<td><button class='boton_personalizado' id='eliminar' data-id='" + id + "'>Eliminar</button>"; 
                            //output+="<a class='boton_personalizado' href=editarClase.php?idClase="+ id + ">Modificar</a></td>";
                        output+="</tr>";
                    }
                    output+="<tr align='center'>" +
                        "<td id='nombre_add' contenteditable></td>  " +
                        "<td id='tipo_add' contenteditable></td>  " +
                        "<td><button id='add'>Agregar</button></td>" +
                    "</tr>";    
                    output+="</table>";  
                    $("#ress").html(output); 
                }
            });
        }
    })        
    //Actualizar Parametros
    //Nombre
    $(document).on("blur","#nombre",function(){
        var id = $(this).data("id_nombre");
        var nombre = $(this).text();
        actualizar_datos(id,nombre,"nombre");
    })   
    //Tipo
    $(document).on("blur","#tipo",function(){
        var id = $(this).data("id_tipo");
        var tipo = $(this).text();
        actualizar_datos(id,tipo,"tipo");
    })   
    function actualizar_datos(id, texto, columna){
        var type = "actualizarParametro";
        $.ajax({
            url: "../Crud_Clases/controller/actualizarParametro.php",
            method: "POST",
            data: {
                "idm": idMetodo,
                id: id, 
                "usuario" : usuario,
                "type": type,
                texto: texto,
                columna: columna
            },
            success: function(answer){
                console.log("answer", answer);
                var a = JSON.parse(answer);
                //console.log(rr);
                var output="<table border='1px' cellpadding='10' width='50%' height='150%'>";      
                var id;
                console.log(a.parametros);
                for (var i in a.parametros) 
                {
                    output+="<tr align='center'>";
                        id = a.parametros[i].idParametros;
                        output+="<td id='nombre' data-id_nombre='" + id + "' contenteditable>" + a.parametros[i].nombre + "</td>";
                        output+="<td id='tipo' data-id_tipo='" + id + "' contenteditable>" + a.parametros[i].tipo + "</td>";
                        output+="<td><button class='boton_personalizado' id='eliminar' data-id='" + id + "'>Eliminar</button>"; 
                        //output+="<a class='boton_personalizado' href=editarClase.php?idClase="+ id + ">Modificar</a></td>";
                    output+="</tr>";
                }
                output+="<tr align='center'>" +
                    "<td id='nombre_add' contenteditable></td>  " +
                    "<td id='tipo_add' contenteditable></td>  " +
                    "<td><button id='add'>Agregar</button></td>" +
                "</tr>";    
                output+="</table>";  
                $("#ress").html(output);
            }
        });
    }    
    //Agregar Parametro
    $(document).on("click","#add",function(){
        var nombre = $("#nombre_add").text();  
        var tipo = $("#tipo_add").text();  
        var type = "agregarParametro";
        
        var parametros ={
            "idm": idModelo,
            "idc": idClase,
            "idmm": idMetodo,
            "usuario": usuario,
            "type": type,
            "nombre": nombre,
            "tipo": tipo
        };
        console.log(parametros);
        $.ajax({
            url: "../Crud_Clases/controller/agregarParametro.php",
            method: "POST",
            data: parametros,
            success: function(asw){
                console.log("answer", asw);
                var a = JSON.parse(asw);
                //console.log(rr);
                var output="<table border='1px' cellpadding='10' width='50%' height='150%'>";      
                var id;
                console.log(a.parametros);
                for (var i in a.parametros) 
                {
                    output+="<tr align='center'>";
                        id = a.parametros[i].idParametros;
                        output+="<td id='nombre' data-id_nombre='" + id + "' contenteditable>" + a.parametros[i].nombre + "</td>";
                        output+="<td id='tipo' data-id_tipo='" + id + "' contenteditable>" + a.parametros[i].tipo + "</td>";
                        output+="<td><button class='boton_personalizado' id='eliminar' data-id='" + id + "'>Eliminar</button>"; 
                        //output+="<a class='boton_personalizado' href=editarClase.php?idClase="+ id + ">Modificar</a></td>";
                    output+="</tr>";
                }
                output+="<tr align='center'>" +
                    "<td id='nombre_add' contenteditable></td>  " +
                    "<td id='tipo_add' contenteditable></td>  " +
                    "<td><button id='add'>Agregar</button></td>" +
                "</tr>";    
                output+="</table>";  
                $("#ress").html(output);              
            }
        })
    })       
</script>