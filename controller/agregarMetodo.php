<?php
include('acciones.php');
$idm=$_POST['idm'];
$idc=$_POST['idc'];
$usuario=$_POST['usuario'];
$type=$_POST['type'];
$nombre=$_POST['nombre'];
$tipo=$_POST['tipo'];

$metodos = [
    "metodos" => "",
    "status" =>""
];
if($type = 'agregarMetodo'){
    $infoMetodo = agregarMetodo($idm, $idc, $usuario, $nombre, $tipo); 
    foreach ($infoMetodo as $row) {
        $modelData[] = array('idMetodos'=> urlencode($row['idMetodos']), 'nombre'=> $row['nombre'], 'tipo'=> $row['tipo']);
    }
    $metodos["metodos"]=$modelData;
    $metodos["status"]="OK";
}
echo json_encode($metodos);
?>
