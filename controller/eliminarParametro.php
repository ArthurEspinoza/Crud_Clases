<?php
include('acciones.php');
$idp=$_POST['idp'];
$idm=$_POST['idm'];
$usuario=$_POST['usuario'];
$type=$_POST['type'];

$parametros = [
    "parametros" => "",
    "status" =>""
];

if($type = 'eliminarParametro'){
    $infoParametro = deleteParametro($usuario, $idp, $idm); 
    //var_dump($infoMetodo);
    foreach ($infoParametro as $row) {
        $parametroData[] = array('idParametros'=> urlencode($row['idParametros']), 'nombre'=> $row['nombre'], 'tipo'=> $row['tipo']);
    }
    $parametros["parametros"]=$parametroData;
    $parametros["status"]="OK";
}

echo json_encode($parametros);
?>