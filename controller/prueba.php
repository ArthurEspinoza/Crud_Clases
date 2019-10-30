<?php 
include('config.php');
class GestorDB{
    public function ingresar($usuario, $contra){
        $database = Singleton::getInstance();
        $validarCredenciales = $database->db->prepare("SELECT * FROM usuario WHERE nombre_usuario=:user AND contrasena=:contra");
        $validarCredenciales->bindParam(':user', $usuario, PDO::PARAM_STR);
        $validarCredenciales->bindParam(':contra', $contra, PDO::PARAM_STR);
        $validarCredenciales->execute();
        if ($validarCredenciales->rowCount(0)>0) {
            $infoUsuario = $validarCredenciales->fetch(PDO::FETCH_ASSOC);
            echo $infoUsuario['nombre_usuario'].$infoUsuario['contrasena'];
        }
    }
}

?>