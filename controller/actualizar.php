<?php
include('acciones.php');
$id=$_POST['id'];
$usuario=$_POST['usuario'];
$type=$_POST['type'];
$texto=$_POST['texto'];
$columna=$_POST['columna'];

$modelos = [
    "modelos" => "",
    "status" =>""
];
if($type = 'actualizarModelo'){
    $infoModel = actualizarModelo($usuario, $id, $texto, $columna); 
    foreach ($infoModel as $row) {
        $modelData[] = array('idModelo'=> urlencode($row['idModelo']), 'nombre'=> $row['nombre']);
    }
    $modelos["modelos"]=$modelData;
    $modelos["status"]="OK";
}
echo json_encode($modelos);
?>