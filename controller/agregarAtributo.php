<?php
include('acciones.php');
$idm=$_POST['idm'];
$idc=$_POST['idc'];
$usuario=$_POST['usuario'];
$type=$_POST['type'];
$nombre=$_POST['nombre'];
$tipo=$_POST['tipo'];

$atributos = [
    "atributos" => "",
    "status" =>""
];
if($type = 'agregarAtributo'){
    $infoAtributos = agregarAtributo($idm, $idc, $usuario, $nombre, $tipo); 
    foreach ($infoAtributos as $row) {
        $atributosData[] = array('idAtributos'=> urlencode($row['idAtributos']), 'nombre'=> $row['nombre'], 'tipo'=> $row['tipo']);
    }
    $atributos["atributos"]=$atributosData;
    $metodos["status"]="OK";
}
echo json_encode($atributos);
?>
