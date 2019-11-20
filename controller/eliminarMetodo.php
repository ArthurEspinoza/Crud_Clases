<?php
include('acciones.php');
$idm=$_POST['idm'];
$idc=$_POST['idc'];
$usuario=$_POST['usuario'];
$type=$_POST['type'];

$metodos = [
    "metodos" => "",
    "status" =>""
];

if($type = 'eliminarMetodo'){
    $infoMetodo = deleteMetodo($usuario, $idm, $idc); 
    //var_dump($infoMetodo);
    foreach ($infoMetodo as $row) {
        $metodoData[] = array('idMetodos'=> urlencode($row['idMetodos']), 'nombre'=> $row['nombre'], 'tipo'=> $row['tipo']);
    }
    $metodos["metodos"]=$metodoData;
    $metodos["status"]="OK";
}

echo json_encode($metodos);
?>