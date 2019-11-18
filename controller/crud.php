<?php
include('acciones.php');
$id=$_POST['id'];
$usuario=$_POST['usuario'];
$type=$_POST['type'];
$modelos = [
    "modelos" => "",
    "status" =>""
];
$clases = [
    "clases" => "",
    "status" =>""
];

if($type = 'eliminarModelo'){
    $infoModel = deleteModelo($usuario, $id); 
    //var_dump($infoModel);
    foreach ($infoModel as $row) {
        $modelData[] = array('idModelo'=> urlencode($row['idModelo']), 'nombre'=> $row['nombre']);
    }
    $modelos["modelos"]=$modelData;
    $modelos["status"]="OK";
    //echo $modelos;
}
/*if($type = 'eliminarClase'){
    $infoClass = deleteClase($usuario, $id); 
    //var_dump($infoModel);
    foreach ($infoClass as $row) {
        $claseData[] = array('idClases'=> $row['idClases'], 'nombre'=> $row['nombre']);
    }
    $clases["clases"]=$claseData;
    $clases["status"]="OK";
    //echo $modelos;
}
*/
echo json_encode($modelos);
?>