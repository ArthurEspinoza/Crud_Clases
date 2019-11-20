<?php
include('acciones.php');
//$id=$_POST['id'];
$usuario=$_POST['usuario'];
$type=$_POST['type'];
$nombre=$_POST['nombre'];

$modelos = [
    "modelos" => "",
    "status" =>""
];
if($type = 'agregarModelo'){
    $infoModel = agregarModelo($usuario, $nombre); 
    foreach ($infoModel as $row) {
        $modelData[] = array('idModelo'=> urlencode($row['idModelo']), 'nombre'=> $row['nombre']);
    }
    $modelos["modelos"]=$modelData;
    $modelos["status"]="OK";
}
echo json_encode($modelos);
?>
