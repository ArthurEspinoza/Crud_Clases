<?php 
include('prueba.php');
if (isset($_POST['loginBtn'])) {
    $usuario = $_POST['usuario'];
    $contra = $_POST['contra'];
    $gestor = new GestorDB;
    $gestor->ingresar($usuario, $contra);
}
function getModelo($usuario){
    $gestor = new GestorDB;
    $infoModelo = $gestor->getModelo($usuario);
    //var_dump($infoModelo);
    return $infoModelo;
}
function getClases($idModelo){
    $gestor = new GestorDB;
    $infoClases = $gestor->getClases($idModelo);
    return $infoClases;
}
function getAtributos($idClases){
    $gestor = new GestorDB;
    $infoAtributos = $gestor->getAtributos($idClases);
    return $infoAtributos;
}
?>