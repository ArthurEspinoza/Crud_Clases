<?php 
include('config.php');
class GestorDB{
    public function ingresar($usuario, $contra){
        $database = Singleton::getInstance();
        $validarCredenciales = $database->db->prepare("SELECT * FROM usuario WHERE nombre_usuario=:user AND contrasena=:contra");
        $validarCredenciales->bindParam(':user', $usuario, PDO::PARAM_STR);
        $validarCredenciales->bindParam(':contra', $contra, PDO::PARAM_STR);
        $validarCredenciales->execute();
        if ($validarCredenciales->rowCount()>0) {
            session_start();
            $_SESSION['usuario'] = $usuario;
            $infoUsuario = $validarCredenciales->fetch(PDO::FETCH_ASSOC);
            //echo $infoUsuario['nombre_usuario'].$infoUsuario['contrasena'];
            echo '<script>location.href="../editarModelo.php"</script>';
        }
    }
    public function getModelo($usuario){
        echo $usuario;
        $database = Singleton::getInstance();
        $queryId = $database->db->prepare("SELECT idUsuario from usuario where nombre_usuario=:u");
        $queryId->bindParam(':u', $usuario, PDO::PARAM_STR);
        if($queryId->execute()){
            if ($queryId->rowCount()>0) {
                $infoUsuario = $queryId->fetch(PDO::FETCH_ASSOC);
                $_SESSION['idUsuario'] = $infoUsuario['idUsuario'];
                $queryModelo = $database->db->prepare("SELECT * from modelo where idUsuario=:i");
                $queryModelo->bindParam(':i', $infoUsuario['idUsuario'], PDO::PARAM_INT);
                if ($queryModelo->execute()) {
                    if ($queryModelo->rowCount()>0) {
                        $infoModelo = $queryModelo->fetch(PDO::FETCH_ASSOC);
                        return $infoModelo;
                    }
                }
            }
        }else{
            echo "Consulta erronea";
        }
    }
}

?>