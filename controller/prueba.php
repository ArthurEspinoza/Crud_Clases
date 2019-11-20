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
            $_SESSION['idUsuario'] = $infoUsuario['idUsuario'];
            //echo $infoUsuario['nombre_usuario'].$infoUsuario['contrasena'];
            echo '<script>location.href="../modelo.php"</script>';
        }
    }
    public function getModelo($usuario){
        //echo $usuario;
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
                        $infoModelo = $queryModelo->fetchAll();
                        return $infoModelo;
                    }
                }
            }
        }else{
            echo "Consulta erronea";
        }
    }    
    public function deleteModelo($usuario, $id){
        //Elimina atributos
        $databases = Singleton::getInstance();
        $queryIds = $databases->db->prepare("DELETE FROM atributos WHERE idModelo=:id");
        $queryIds->bindParam(':id', $id, PDO::PARAM_STR);
        if($queryIds->execute()){
            //Elimina parametros
            $data = Singleton::getInstance();
            $query = $data->db->prepare("DELETE FROM parametros WHERE idModelo=:id");
            $query->bindParam(':id', $id, PDO::PARAM_STR);
            if($query->execute()){
                //Elimina metodos
                $datas = Singleton::getInstance();
                $querys = $datas->db->prepare("DELETE FROM metodos WHERE idModelo=:id");
                $querys->bindParam(':id', $id, PDO::PARAM_STR);
                if($querys->execute()){
                    //Elimina clases
                    $dats = Singleton::getInstance();
                    $quers = $dats->db->prepare("DELETE FROM clases WHERE idModelo=:id");
                    $quers->bindParam(':id', $id, PDO::PARAM_STR);
                    if($quers->execute()){
                        //Elimina modelo 
                        $d = Singleton::getInstance();
                        $q = $d->db->prepare("DELETE FROM modelo WHERE idModelo=:id");
                        $q->bindParam(':id', $id, PDO::PARAM_STR);
                        if($q->execute()){
                            return getModelo($usuario);
                        }else{
                            echo "Consulta erronea";
                        }
                    }else{
                        echo "Consulta erronea";
                    }
                }else{
                    echo "Consulta erronea";
                }
            }else{
                echo "Consulta erronea";
            }
        }else{
            echo "Consulta erronea";
        }
    }
    public function actualizarModelo($usuario, $id, $texto, $columna){
        $databases = Singleton::getInstance();
        $queryIds = $databases->db->prepare("UPDATE modelo SET $columna=:texto WHERE idModelo=:id");
        //$queryIds->bindParam(':columna', $columna, ':texto', $texto, ':id', $id, PDO::PARAM_STR);
        $queryIds->bindParam(':id', $id, PDO::PARAM_INT);
        $queryIds->bindParam(':texto', $texto, PDO::PARAM_STR);
        //$queryIds->bindParam(':columna', $columna, PDO::PARAM_STR);
        if($queryIds->execute()){
            return getModelo($usuario);
        }else{
            echo "Consulta erronea";
        }        
    }
    public function agregarModelo($usuario, $nombre){
        $database = Singleton::getInstance();
        $queryId = $database->db->prepare("SELECT idUsuario from usuario where nombre_usuario=:u");
        $queryId->bindParam(':u', $usuario, PDO::PARAM_STR);
        if($queryId->execute()){
            if ($queryId->rowCount()>0) {
                $infoUsuario = $queryId->fetch(PDO::FETCH_ASSOC);
                $id = $infoUsuario['idUsuario'];
            }
        }
        $databases = Singleton::getInstance();
        $queryIds = $databases->db->prepare("INSERT INTO modelo(nombre, idUsuario) VALUES (:n, :id)");
        $queryIds->bindParam(':n', $nombre, PDO::PARAM_STR);
        $queryIds->bindParam(':id', $id, PDO::PARAM_INT);
        if($queryIds->execute()){
            return getModelo($usuario);
        }else{
            echo "Consulta erronea";
        }           
    }
    public function agregarMetodo($idm, $idc, $usuario, $nombre, $tipo){
        $database = Singleton::getInstance();
        $queryId = $database->db->prepare("SELECT idUsuario from usuario where nombre_usuario=:u");
        $queryId->bindParam(':u', $usuario, PDO::PARAM_STR);
        if($queryId->execute()){
            if ($queryId->rowCount()>0) {
                $infoUsuario = $queryId->fetch(PDO::FETCH_ASSOC);
                $idu = $infoUsuario['idUsuario'];
            }
        }     
        $databases = Singleton::getInstance();
        $queryIds = $databases->db->prepare("INSERT INTO metodos(nombre, tipo, idClases, idModelo, idUsuario) VALUES (:n, :t, :idc, :idm, :idu)");
        $queryIds->bindParam(':n', $nombre, PDO::PARAM_STR);
        $queryIds->bindParam(':t', $tipo, PDO::PARAM_STR);
        $queryIds->bindParam(':idc', $idc, PDO::PARAM_STR);
        $queryIds->bindParam(':idm', $idm, PDO::PARAM_INT);
        $queryIds->bindParam(':idu', $idu, PDO::PARAM_INT);
        if($queryIds->execute()){
            return getMetodos($idc);
        }else{
            echo "Consulta erronea";
        }         
    }
    public function agregarAtributo($idm, $idc, $usuario, $nombre, $tipo){
        $database = Singleton::getInstance();
        $queryId = $database->db->prepare("SELECT idUsuario from usuario where nombre_usuario=:u");
        $queryId->bindParam(':u', $usuario, PDO::PARAM_STR);
        if($queryId->execute()){
            if ($queryId->rowCount()>0) {
                $infoUsuario = $queryId->fetch(PDO::FETCH_ASSOC);
                $idu = $infoUsuario['idUsuario'];
            }
        }     
        $databases = Singleton::getInstance();
        $queryIds = $databases->db->prepare("INSERT INTO atributos(nombre, tipo, idClases, idModelo, idUsuario) VALUES (:n, :t, :idc, :idm, :idu)");
        $queryIds->bindParam(':n', $nombre, PDO::PARAM_STR);
        $queryIds->bindParam(':t', $tipo, PDO::PARAM_STR);
        $queryIds->bindParam(':idc', $idc, PDO::PARAM_STR);
        $queryIds->bindParam(':idm', $idm, PDO::PARAM_INT);
        $queryIds->bindParam(':idu', $idu, PDO::PARAM_INT);
        if($queryIds->execute()){
            return getAtributos($idc);
        }else{
            echo "Consulta erronea";
        }         
    }
    public function agregarParametro($idm, $idc, $idmm,$usuario, $nombre, $tipo){
        $database = Singleton::getInstance();
        $queryId = $database->db->prepare("SELECT idUsuario from usuario where nombre_usuario=:u");
        $queryId->bindParam(':u', $usuario, PDO::PARAM_STR);
        if($queryId->execute()){
            if ($queryId->rowCount()>0) {
                $infoUsuario = $queryId->fetch(PDO::FETCH_ASSOC);
                $idu = $infoUsuario['idUsuario'];
            }
        }     
        $databases = Singleton::getInstance();
        $queryIds = $databases->db->prepare("INSERT INTO parametros(nombre, tipo, idMetodos, idClases, idModelo, idUsuario) VALUES (:n, :t, :idmm, :idc, :idm, :idu)");
        $queryIds->bindParam(':n', $nombre, PDO::PARAM_STR);
        $queryIds->bindParam(':t', $tipo, PDO::PARAM_STR);
        $queryIds->bindParam(':idmm', $idmm, PDO::PARAM_INT);
        $queryIds->bindParam(':idc', $idc, PDO::PARAM_STR);
        $queryIds->bindParam(':idm', $idm, PDO::PARAM_INT);
        $queryIds->bindParam(':idu', $idu, PDO::PARAM_INT);
        if($queryIds->execute()){
            return getParametros($idmm);
        }else{
            echo "Consulta erronea";
        }         
    }
    public function deleteClase($usuario, $idm, $idc){
        //Elimina atributos
        $databases = Singleton::getInstance();
        $queryIds = $databases->db->prepare("DELETE FROM atributos WHERE idClases=:id");
        $queryIds->bindParam(':id', $idc, PDO::PARAM_STR);
        if($queryIds->execute()){
            //Elimina parametros
            $data = Singleton::getInstance();
            $query = $data->db->prepare("DELETE FROM parametros WHERE idClases=:id");
            $query->bindParam(':id', $idc, PDO::PARAM_STR);
            if($query->execute()){
                //Elimina metodos
                $datas = Singleton::getInstance();
                $querys = $datas->db->prepare("DELETE FROM metodos WHERE idClases=:id");
                $querys->bindParam(':id', $idc, PDO::PARAM_STR);
                if($querys->execute()){
                    //Elimina clases
                    $dats = Singleton::getInstance();
                    $quers = $dats->db->prepare("DELETE FROM clases WHERE idClases=:id");
                    $quers->bindParam(':id', $idc, PDO::PARAM_STR);
                    if($quers->execute()){
                        return getClases($idm);
                    }else{
                        echo "Consulta erronea";
                    }
                }else{
                    echo "Consulta erronea";
                }
            }else{
                echo "Consulta erronea";
            }
        }else{
            echo "Consulta erronea";
        }        
    }
    public function deleteMetodo($usuario, $idm, $idc){
        //Eliminar parametros
        $data = Singleton::getInstance();
        $query = $data->db->prepare("DELETE FROM parametros WHERE idMetodos=:id");
        $query->bindParam(':id', $idm, PDO::PARAM_STR);
        if($query->execute()){
            //Elimina metodos
            $datas = Singleton::getInstance();
            $querys = $datas->db->prepare("DELETE FROM metodos WHERE idMetodos=:id");
            $querys->bindParam(':id', $idm, PDO::PARAM_STR);
            if($querys->execute()){
                return getMetodos($idc);
            }else{
                echo "Consulta erronea";
            }
        }else{
            echo "Consulta erronea";
        }          
    }
    public function deleteAtributo($usuario, $ida, $idc){
        //Elimina atributos
        $databases = Singleton::getInstance();
        $queryIds = $databases->db->prepare("DELETE FROM atributos WHERE idAtributos=:id");
        $queryIds->bindParam(':id', $ida, PDO::PARAM_STR);
        if($queryIds->execute()){
            return getAtributos($idc);
        }else{
            echo "Consulta erronea";
        }             
    }
    public function deleteParametro($usuario, $idp, $idm){
        //Elimina Parametros
        $databases = Singleton::getInstance();
        $queryIds = $databases->db->prepare("DELETE FROM parametros WHERE idParametros=:id");
        $queryIds->bindParam(':id', $idp, PDO::PARAM_STR);
        if($queryIds->execute()){
            return getParametros($idm);
        }else{
            echo "Consulta erronea";
        }            
    }
    public function actualizarClase($usuario, $id, $texto, $columna, $idm){
        $databases = Singleton::getInstance();
        $queryIds = $databases->db->prepare("UPDATE clases SET $columna=:texto WHERE idClases=:id");
        //$queryIds->bindParam(':columna', $columna, ':texto', $texto, ':id', $id, PDO::PARAM_STR);
        $queryIds->bindParam(':id', $id, PDO::PARAM_INT);
        $queryIds->bindParam(':texto', $texto, PDO::PARAM_STR);
        //$queryIds->bindParam(':columna', $columna, PDO::PARAM_STR);
        if($queryIds->execute()){
            return getClases($idm);
        }else{
            echo "Consulta erronea";
        }           
    }
    public function actualizarMetodo($usuario, $id, $texto, $columna, $idc){
        $databases = Singleton::getInstance();
        $queryIds = $databases->db->prepare("UPDATE metodos SET $columna=:texto WHERE idMetodos=:id");
        //$queryIds->bindParam(':columna', $columna, ':texto', $texto, ':id', $id, PDO::PARAM_STR);
        $queryIds->bindParam(':id', $id, PDO::PARAM_INT);
        $queryIds->bindParam(':texto', $texto, PDO::PARAM_STR);
        //$queryIds->bindParam(':columna', $columna, PDO::PARAM_STR);
        if($queryIds->execute()){
            return getMetodos($idc);
        }else{
            echo "Consulta erronea";
        }            
    }
    public function actualizarAtributo($usuario, $id, $texto, $columna, $idc){
        $databases = Singleton::getInstance();
        $queryIds = $databases->db->prepare("UPDATE atributos SET $columna=:texto WHERE idAtributos=:id");
        //$queryIds->bindParam(':columna', $columna, ':texto', $texto, ':id', $id, PDO::PARAM_STR);
        $queryIds->bindParam(':id', $id, PDO::PARAM_INT);
        $queryIds->bindParam(':texto', $texto, PDO::PARAM_STR);
        //$queryIds->bindParam(':columna', $columna, PDO::PARAM_STR);
        if($queryIds->execute()){
            return getAtributos($idc);
        }else{
            echo "Consulta erronea";
        }           
    }
    public function actualizarParametros($usuario, $id, $texto, $columna, $idm){
        $databases = Singleton::getInstance();
        $queryIds = $databases->db->prepare("UPDATE parametros SET $columna=:texto WHERE idParametros=:id");
        //$queryIds->bindParam(':columna', $columna, ':texto', $texto, ':id', $id, PDO::PARAM_STR);
        $queryIds->bindParam(':id', $id, PDO::PARAM_INT);
        $queryIds->bindParam(':texto', $texto, PDO::PARAM_STR);
        //$queryIds->bindParam(':columna', $columna, PDO::PARAM_STR);
        if($queryIds->execute()){
            return getParametros($idm);
        }else{
            echo "Consulta erronea";
        }           
    }
    public function getClases($id){
        $database = Singleton::getInstance();
        $queryClases = $database->db->prepare("SELECT * from clases where idModelo=:i");
        $queryClases->bindParam(':i', $id, PDO::PARAM_INT);
        if ($queryClases->execute()) {
            if ($queryClases->rowCount()>0) {
                $infoClases = $queryClases->fetchAll();
                return $infoClases;
            }
        }
    }
    public function getAtributos($id){
        $database = Singleton::getInstance();
        $queryAttr = $database->db->prepare("SELECT * from atributos where idClases=:i");
        $queryAttr->bindParam(':i', $id, PDO::PARAM_STR);
        if ($queryAttr->execute()) {
            if ($queryAttr->rowCount()>0) {
                $infoAttr = $queryAttr->fetchAll();
                return $infoAttr;
            }
        }
    }
    public function getMetodos($id){
        $database = Singleton::getInstance();
        $queryAttr = $database->db->prepare("SELECT * from metodos where idClases=:i");
        $queryAttr->bindParam(':i', $id, PDO::PARAM_STR);
        if ($queryAttr->execute()) {
            if ($queryAttr->rowCount()>0) {
                $infoAttr = $queryAttr->fetchAll();
                return $infoAttr;
            }
        }
    }
    public function getParametros($idMetodo){
        $database = Singleton::getInstance();
        $queryAttr = $database->db->prepare("SELECT * from parametros where idMetodos=:i");
        $queryAttr->bindParam(':i', $idMetodo, PDO::PARAM_STR);
        if ($queryAttr->execute()) {
            if ($queryAttr->rowCount()>0) {
                $infoAttr = $queryAttr->fetchAll();
                return $infoAttr;
            }
        }        
    }
}

?>