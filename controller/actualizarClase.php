<?php
include('acciones.php');
$idm=$_POST['idm'];
$id=$_POST['id'];
$usuario=$_POST['usuario'];
$type=$_POST['type'];
$texto=$_POST['texto'];
$columna=$_POST['columna'];

$clases = [
    "clases" => "",
    "status" =>""
];
if($type = 'actualizarClase'){
    $infoClases = actualizarClase($usuario, $id, $texto, $columna, $idm); 
    foreach ($infoClases as $row) {
        $ClassData[] = array('idClases'=> urlencode($row['idClases']), 'nombre'=> $row['nombre']);
    }
    $clases["clases"]=$ClassData;
    $clases["status"]="OK";
}
echo json_encode($clases);
?>