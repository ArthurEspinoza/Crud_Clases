<?php
include('acciones.php');
$idc=$_POST['idc'];
$id=$_POST['id'];
$usuario=$_POST['usuario'];
$type=$_POST['type'];
$texto=$_POST['texto'];
$columna=$_POST['columna'];

$atributos = [
    "atributos" => "",
    "status" =>""
];
if($type = 'actualizarAtributo'){
    $infoAtributos = actualizarAtributo($usuario, $id, $texto, $columna, $idc); 
    foreach ($infoAtributos as $row) {
        $atributosData[] = array('idAtributos'=> urlencode($row['idAtributos']), 'nombre'=> $row['nombre'], 'tipo'=> $row['tipo']);
    }
    $atributos["atributos"]=$atributosData;
    $atributos["status"]="OK";
}
echo json_encode($atributos);
?>