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
    return $infoModelo;
}
?>