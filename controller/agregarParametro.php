<?php
include('acciones.php');
$idm=$_POST['idm'];
$idc=$_POST['idc'];
$idmm = $_POST['idmm'];
$usuario=$_POST['usuario'];
$type=$_POST['type'];
$nombre=$_POST['nombre'];
$tipo=$_POST['tipo'];

$parametros = [
    "parametros" => "",
    "status" =>""
];
if($type = 'agregarParametro'){
    $infoParametros = agregarParametro($idm, $idc, $idmm,$usuario, $nombre, $tipo); 
    foreach ($infoParametros as $row) {
        $parametrosData[] = array('idParametros'=> urlencode($row['idParametros']), 'nombre'=> $row['nombre'], 'tipo'=> $row['tipo']);
    }
    $parametros["parametros"]=$parametrosData;
    $parametros["status"]="OK";
}
echo json_encode($parametros);
?>
