<?php
include('acciones.php');
$idm=$_POST['idm'];
$idc=$_POST['idc'];
$usuario=$_POST['usuario'];
$type=$_POST['type'];

$clases = [
    "clases" => "",
    "status" =>""
];

if($type = 'eliminarClase'){
    $infoClass = deleteClase($usuario, $idm, $idc); 
    foreach ($infoClass as $row) {
        $claseData[] = array('idClases'=> $row['idClases'], 'nombre'=> $row['nombre']);
    }
    $clases["clases"]=$claseData;
    $clases["status"]="OK";
}

echo json_encode($clases);
?>