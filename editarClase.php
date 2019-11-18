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
                    Crud Metodos
                </div>
                <div class="card-body">
                    <h5 class="card-title">Metodos</h5>
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
                <div class="card-header">
                    Crud Atributos
                </div>                
                <div class="card-body">
                    <h5 class="card-title">Atributos</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr align='center'>
                                    <th>Nombre</th>
                                    <th>Tipo</th>
                                    <th>Operaciones</th>
                                </tr>
                            </thead>
                            <tbody id="resss">                                
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
    
    //Muestra clases 
    $metodo = getMetodos($idClase);
    foreach ($metodo as $row) {
        //$_POST['nombre']=$row['nombre'];
        $metodos = [
            "metodos" => ""
        ];
        $metodoData[] = array(
        'idMetodos'=> urlencode($row['idMetodos']), 
        'nombre'=> $row['nombre'],
        'tipo'=> $row['tipo'],
        'idClases'=> urlencode($row['idClases']),             
        'idModelo'=> urlencode($row['idModelo']), 
        'idUsuario'=> urlencode($row['idUsuario']) 
        );
    }
    $metodos["metodos"]=$metodoData;
    $_POST['metodos']=$metodos;
    echo "<script>\n";
    echo "res='".json_encode($_POST['metodos'])."'\n";
    echo "</script>\n";  

    $atributo = getAtributos($idClase);
    foreach ($atributo as $row) {
        //$_POST['nombre']=$row['nombre'];
        $atributos = [
            "atributos" => ""
        ];
        $atributoData[] = array(
        'idAtributos'=> urlencode($row['idAtributos']), 
        'nombre'=> $row['nombre'],
        'tipo'=> $row['tipo'],
        'idClases'=> urlencode($row['idClases']),             
        'idModelo'=> urlencode($row['idModelo']), 
        'idUsuario'=> urlencode($row['idUsuario']) 
        );
    }
    $atributos["atributos"]=$atributoData;
    $_POST['atributos']=$atributos;
    echo "<script>\n";
    echo "ress='".json_encode($_POST['atributos'])."'\n";
    echo "</script>\n";  
?>
<script type="text/javascript">
    console.log(idClase);
    console.log(idModelo);
var usuario = '<?php echo $usuario;?>';
function mostrar(){

    var r = JSON.parse(res);
    //console.log(r);
    var output="<table border='1px' cellpadding='10' width='50%' height='150%'>";      
    var id;
    for (var i in r.metodos) 
    {
        output+="<tr align='center'>";
        id = r.metodos[i].idMetodos;
            output+="<td id='nombre' data-id_nombre='" + id + "' contenteditable>" + r.metodos[i].nombre + "</td>";
            output+="<td id='tipo' data-id_tipo='" + id + "' contenteditable>" + r.metodos[i].tipo + "</td>";
            output+="<td><button class='boton_personalizado' id='eliminar' data-id='" + id + "'>Eliminar</button>"; 
            output+="<a class='boton_personalizado' href=editarMetodo.php?idModelo="+ idModelo +"&idClase="+ idClase +"&idMetodo="+ id + ">Modificar</a></td>";
        output+="</tr>";
    }
    output+="<tr align='center'>" +
        "<td id='nombre_add' contenteditable></td>  " +
        "<td id='tipo_add' contenteditable></td>  " +
        "<td><button id='add'>Agregar</button></td>" +
    "</tr>";    
    output+="</table>";       
    
    $("#ress").html(output);  

    var rr = JSON.parse(ress);
    //console.log(rr);
    var output="<table border='1px' cellpadding='10' width='50%' height='150%'>";      
    var id;
    for (var i in rr.atributos) 
    {
        output+="<tr align='center'>";
        id = rr.atributos[i].idAtributos;
            output+="<td id='nombrea' data-id_nombrea='" + id + "' contenteditable>" + rr.atributos[i].nombre + "</td>";
            output+="<td id='tipoa' data-id_tipoa='" + id + "' contenteditable>" + rr.atributos[i].tipo + "</td>";
            output+="<td><button class='boton_personalizado' id='eliminara' data-ida='" + id + "'>Eliminar</button>"; 
            //output+="<a class='boton_personalizado' href=editarClase.php?idClase="+ id + ">Modificar</a></td>";
        output+="</tr>";
    }
    output+="<tr align='center'>" +
        "<td id='nombre_adda' contenteditable></td>  " +
        "<td id='tipo_adda' contenteditable></td>  " +
        "<td><button id='adda'>Agregar</button></td>" +
    "</tr>";    
    output+="</table>";       
    
    $("#resss").html(output);  
}    
    //DELETE FUNCTION FOR METODOS
    $(document).on("click","#eliminar",function(){
        if(confirm("esta seguro de que desea eliminar este registro."))
        {
            var ids = $(this).data("id");
            console.log(ids);
            console.log(usuario);
            
            var type = "eliminarMetodo";
            console.log(type);
            var parametros ={
                "idm": ids,
                "idc" : idClase,
                "usuario" : usuario,
                "type": type
            };
            console.log(parametros)
            $.ajax({
                url: "../Crud_Clases/controller/eliminarMetodo.php",
                method: "POST",
                data: parametros,
                success: function(answer)
                {
            //var answer = "";
                    console.log(answer);
                    var r = JSON.parse(answer);
                    console.log(r);
                    var output="<table border='1px' cellpadding='10' width='50%' height='150%'>";      
                    var id;
                    for (var i in r.metodos) 
                    {
                        output+="<tr align='center'>";
                            id = r.metodos[i].idMetodos;
                            output+="<td id='nombre' data-id_nombre='" + id + "' contenteditable>" + r.metodos[i].nombre + "</td>";
                            output+="<td id='tipo' data-id_tipo='" + id + "' contenteditable>" + r.metodos[i].tipo + "</td>";
                            output+="<td><button class='boton_personalizado' id='eliminar' data-id='" + id + "'>Eliminar</button>"; 
                            output+="<a class='boton_personalizado' href=editarClase.php?idClase="+ id + ">Modificar</a></td>";
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
    //DELETE FUNCTION FOR ATRIBUTOS
    $(document).on("click","#eliminara",function(){
        if(confirm("esta seguro de que desea eliminar este registro."))
        {
            var ids = $(this).data("ida");
            console.log(ids);
            console.log(usuario);
            
            var type = "eliminarAtributo";
            console.log(type);
            var parametros ={
                "ida": ids,
                "idc" : idClase,
                "usuario" : usuario,
                "type": type
            };
            console.log(parametros)
            $.ajax({
                url: "../Crud_Clases/controller/eliminarAtributo.php",
                method: "POST",
                data: parametros,
                success: function(answer)
                {
                    var rr = JSON.parse(answer);
                    //console.log(rr);
                    var output="<table border='1px' cellpadding='10' width='50%' height='150%'>";      
                    var id;
                    for (var i in rr.atributos) 
                    {
                        output+="<tr align='center'>";
                        id = rr.atributos[i].idAtributos;
                            output+="<td id='nombrea' data-id_nombrea='" + id + "' contenteditable>" + rr.atributos[i].nombre + "</td>";
                            output+="<td id='tipoa' data-id_tipoa='" + id + "' contenteditable>" + rr.atributos[i].tipo + "</td>";
                            output+="<td><button class='boton_personalizado' id='eliminara' data-ida='" + id + "'>Eliminar</button>"; 
                            //output+="<a class='boton_personalizado' href=editarClase.php?idClase="+ id + ">Modificar</a></td>";
                        output+="</tr>";
                    }
                    output+="<tr align='center'>" +
                        "<td id='nombre_adda' contenteditable></td>  " +
                        "<td id='tipo_adda' contenteditable></td>  " +
                        "<td><button id='adda'>Agregar</button></td>" +
                    "</tr>";    
                    output+="</table>";       
    
                    $("#resss").html(output);               
                }
            });
        }
    })        
    //Actualizar Metodo
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
        var type = "actualizarMetodo";
        $.ajax({
            url: "../Crud_Clases/controller/actualizarMetodo.php",
            method: "POST",
            data: {
                "idc": idClase,
                id: id, 
                "usuario" : usuario,
                "type": type,
                texto: texto,
                columna: columna
            },
            success: function(answer){
                console.log("answer", answer);
                var r = JSON.parse(answer);
                console.log(r);
                var output="<table border='1px' cellpadding='10' width='50%' height='150%'>";      
                var id;
                console.log(r.metodos);
                for (var i in r.metodos) 
                {
                    output+="<tr align='center'>";
                        id = r.metodos[i].idMetodos;
                        output+="<td id='nombre' data-id_nombre='" + id + "' contenteditable>" + r.metodos[i].nombre + "</td>";
                        output+="<td id='tipo' data-id_tipo='" + id + "' contenteditable>" + r.metodos[i].tipo + "</td>";
                        output+="<td><button class='boton_personalizado' id='eliminar' data-id='" + id + "'>Eliminar</button>"; 
                        output+="<a class='boton_personalizado' href=editarClase.php?idClase="+ id + ">Modificar</a></td>";
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
    //Actualizar Atributos
    //Nombre
    $(document).on("blur","#nombrea",function(){
        var id = $(this).data("id_nombrea");
        var nombre = $(this).text();
        actualizar_datoss(id,nombre,"nombre");
    })   
    //Tipo
    $(document).on("blur","#tipao",function(){
        var id = $(this).data("id_tipoa");
        var tipo = $(this).text();
        actualizar_datoss(id,tipo,"tipo");
    })   
    function actualizar_datoss(id, texto, columna){
        var type = "actualizarAtributo";
        $.ajax({
            url: "../Crud_Clases/controller/actualizarAtributo.php",
            method: "POST",
            data: {
                "idc": idClase,
                id: id, 
                "usuario" : usuario,
                "type": type,
                texto: texto,
                columna: columna
            },
            success: function(ans){
                console.log("answer", ans);
                var a = JSON.parse(ans);
                //console.log(rr);
                var output="<table border='1px' cellpadding='10' width='50%' height='150%'>";      
                var id;
                console.log(a.atributos);
                for (var i in a.atributos) 
                {
                    output+="<tr align='center'>";
                        id = a.atributos[i].idAtributos;
                        output+="<td id='nombrea' data-id_nombrea='" + id + "' contenteditable>" + a.atributos[i].nombre + "</td>";
                        output+="<td id='tipoa' data-id_tipoa='" + id + "' contenteditable>" + a.atributos[i].tipo + "</td>";
                        output+="<td><button class='boton_personalizado' id='eliminara' data-ida='" + id + "'>Eliminar</button>"; 
                        //output+="<a class='boton_personalizado' href=editarClase.php?idClase="+ id + ">Modificar</a></td>";
                    output+="</tr>";
                }
                output+="<tr align='center'>" +
                    "<td id='nombre_adda' contenteditable></td>  " +
                    "<td id='tipo_adda' contenteditable></td>  " +
                    "<td><button id='adda'>Agregar</button></td>" +
                "</tr>";    
                output+="</table>";  
                $("#resss").html(output); 
            }
        });
    } 
    //Agregar Metodo
    $(document).on("click","#add",function(){
        var nombre = $("#nombre_add").text();  
        var tipo = $("#tipo_add").text();  
        var type = "agregarMetodo";
        
        var parametros ={
            "idm": idModelo,
            "idc": idClase,
            "usuario": usuario,
            "type": type,
            "nombre": nombre,
            "tipo": tipo
        };
        console.log(parametros);
        $.ajax({
            url: "../Crud_Clases/controller/agregarMetodo.php",
            method: "POST",
            data: parametros,
            success: function(asw){
                console.log("answer", asw);
                var r = JSON.parse(asw);
                console.log(r);
                var output="<table border='1px' cellpadding='10' width='50%' height='150%'>";      
                var id;
                console.log(r.metodos);
                for (var i in r.metodos) 
                {
                    output+="<tr align='center'>";
                        id = r.metodos[i].idMetodos;
                        output+="<td id='nombre' data-id_nombre='" + id + "' contenteditable>" + r.metodos[i].nombre + "</td>";
                        output+="<td id='tipo' data-id_tipo='" + id + "' contenteditable>" + r.metodos[i].tipo + "</td>";
                        output+="<td><button class='boton_personalizado' id='eliminar' data-id='" + id + "'>Eliminar</button>"; 
                        output+="<a class='boton_personalizado' href=editarClase.php?idClase="+ id + ">Modificar</a></td>";
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
    //Agregar Atributo
    $(document).on("click","#adda",function(){
        var nombre = $("#nombre_adda").text();  
        var tipo = $("#tipo_adda").text();  
        var type = "agregarAtributo";
        
        var parametros ={
            "idm": idModelo,
            "idc": idClase,
            "usuario": usuario,
            "type": type,
            "nombre": nombre,
            "tipo": tipo
        };
        console.log(parametros);
        $.ajax({
            url: "../Crud_Clases/controller/agregarAtributo.php",
            method: "POST",
            data: parametros,
            success: function(asw){
                console.log("answer", asw);
                var a = JSON.parse(asw);
                //console.log(rr);
                var output="<table border='1px' cellpadding='10' width='50%' height='150%'>";      
                var id;
                console.log(a.atributos);
                for (var i in a.atributos) 
                {
                    output+="<tr align='center'>";
                        id = a.atributos[i].idAtributos;
                        output+="<td id='nombrea' data-id_nombrea='" + id + "' contenteditable>" + a.atributos[i].nombre + "</td>";
                        output+="<td id='tipoa' data-id_tipoa='" + id + "' contenteditable>" + a.atributos[i].tipo + "</td>";
                        output+="<td><button class='boton_personalizado' id='eliminara' data-ida='" + id + "'>Eliminar</button>"; 
                        //output+="<a class='boton_personalizado' href=editarClase.php?idClase="+ id + ">Modificar</a></td>";
                    output+="</tr>";
                }
                output+="<tr align='center'>" +
                    "<td id='nombre_adda' contenteditable></td>  " +
                    "<td id='tipo_adda' contenteditable></td>  " +
                    "<td><button id='adda'>Agregar</button></td>" +
                "</tr>";    
                output+="</table>";  
                $("#resss").html(output);              
            }
        })
    })     
</script>