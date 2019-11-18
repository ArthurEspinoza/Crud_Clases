<?php
include('acciones.php');
$idc=$_POST['idc'];
$id=$_POST['id'];
$usuario=$_POST['usuario'];
$type=$_POST['type'];
$texto=$_POST['texto'];
$columna=$_POST['columna'];

$metodos = [
    "metodos" => "",
    "status" =>""
];
if($type = 'actualizarMetodo'){
    $infoMetodos = actualizarMetodo($usuario, $id, $texto, $columna, $idc); 
    foreach ($infoMetodos as $row) {
        $motodoData[] = array('idMetodos'=> urlencode($row['idMetodos']), 'nombre'=> $row['nombre'], 'tipo'=> $row['tipo']);
    }
    $metodos["metodos"]=$motodoData;
    $metodos["status"]="OK";
}
echo json_encode($metodos);
?>