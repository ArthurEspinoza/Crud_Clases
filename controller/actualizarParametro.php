<?php
include('acciones.php');
$idm=$_POST['idm'];
$id=$_POST['id'];
$usuario=$_POST['usuario'];
$type=$_POST['type'];
$texto=$_POST['texto'];
$columna=$_POST['columna'];

$parametros = [
    "parametros" => "",
    "status" =>""
];
if($type = 'actualizarParametros'){
    $infoParametros = actualizarParametros($usuario, $id, $texto, $columna, $idm); 
    foreach ($infoParametros as $row) {
        $parametroData[] = array('idParametros'=> urlencode($row['idParametros']), 'nombre'=> $row['nombre'], 'tipo'=> $row['tipo']);
    }
    $parametros["parametros"]=$parametroData;
    $parametros["status"]="OK";
}
echo json_encode($parametros);
?>