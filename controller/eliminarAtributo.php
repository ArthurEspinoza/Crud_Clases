<?php
include('acciones.php');
$ida=$_POST['ida'];
$idc=$_POST['idc'];
$usuario=$_POST['usuario'];
$type=$_POST['type'];

$atributos = [
    "atributos" => "",
    "status" =>""
];

if($type = 'eliminarAtributo'){
    $infoAtributos = deleteAtributo($usuario, $ida, $idc); 
    //var_dump($infoMetodo);
    foreach ($infoAtributos as $row) {
        $atributosData[] = array('idAtributos'=> urlencode($row['idAtributos']), 'nombre'=> $row['nombre'], 'tipo'=> $row['tipo']);
    }
    $atributos["atributos"]=$atributosData;
    $atributos["status"]="OK";
}

echo json_encode($atributos);
?>