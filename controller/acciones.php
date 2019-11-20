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
function deleteModelo($usuario, $id){
    $gestor = new GestorDB;
    $infoModelo = $gestor->deleteModelo($usuario, $id);
    //var_dump($infoModelo);
    return $infoModelo;
}
function deleteClase($usuario, $idm, $idc){
    $gestor = new GestorDB;
    $infoModelo = $gestor->deleteClase($usuario, $idm, $idc);
    //var_dump($infoModelo);
    return $infoModelo;    
}
function deleteMetodo($usuario, $idm, $idc){
    $gestor = new GestorDB;
    $infoModelo = $gestor->deleteMetodo($usuario, $idm, $idc);
    return $infoModelo;     
}
function deleteAtributo($usuario, $ida, $idc){
    $gestor = new GestorDB;
    $infoAtributo = $gestor->deleteAtributo($usuario, $ida, $idc);
    return $infoAtributo;
}
function deleteParametro($usuario, $idp, $idm){
    $gestor = new GestorDB;
    $infoAtributo = $gestor->deleteParametro($usuario, $idp, $idm);
    return $infoAtributo;    
}
function actualizarModelo($usuario, $id, $texto, $columna){
    $gestor = new GestorDB;
    $infoModelo = $gestor->actualizarModelo($usuario, $id, $texto, $columna);
    return $infoModelo;    
} 
function actualizarClase($usuario, $id, $texto, $columna, $idm){
    $gestor = new GestorDB;
    $infoModelo = $gestor->actualizarClase($usuario, $id, $texto, $columna, $idm);
    return $infoModelo;    
}
function actualizarMetodo($usuario, $id, $texto, $columna, $idc){
    $gestor = new GestorDB;
    $infoModelo = $gestor->actualizarMetodo($usuario, $id, $texto, $columna, $idc);
    return $infoModelo;        
}
function actualizarAtributo ($usuario, $id, $texto, $columna, $idc){
    $gestor = new GestorDB;
    $infoModelo = $gestor->actualizarAtributo($usuario, $id, $texto, $columna, $idc);
    return $infoModelo;      
}
function actualizarParametros($usuario, $id, $texto, $columna, $idm){
    $gestor = new GestorDB;
    $infoModelo = $gestor->actualizarParametros($usuario, $id, $texto, $columna, $idm);
    return $infoModelo;     
}
function agregarModelo($usuario, $nombre){
    $gestor = new GestorDB;
    $infoModelo = $gestor->agregarModelo($usuario, $nombre);
    return $infoModelo;       
}
function agregarMetodo($idm, $idc, $usuario, $nombre, $tipo){
    $gestor = new GestorDB;
    $infoModelo = $gestor->agregarMetodo($idm, $idc, $usuario, $nombre, $tipo);
    return $infoModelo;        
}
function agregarAtributo($idm, $idc, $usuario, $nombre, $tipo){
    $gestor = new GestorDB;
    $infoModelo = $gestor->agregarAtributo($idm, $idc, $usuario, $nombre, $tipo);
    return $infoModelo;     
}
function agregarParametro($idm, $idc, $idmm,$usuario, $nombre, $tipo){
    $gestor = new GestorDB;
    $infoModelo = $gestor->agregarParametro($idm, $idc, $idmm,$usuario, $nombre, $tipo);
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
function getMetodos($idClases){
    $gestor = new GestorDB;
    $infoAtributos = $gestor->getMetodos($idClases);
    return $infoAtributos;
}
function getParametros($idMetodo){
    $gestor = new GestorDB;
    $infoAtributos = $gestor->getParametros($idMetodo);
    return $infoAtributos;
}
?>