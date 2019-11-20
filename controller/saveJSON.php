<?php 
header("Content-Type: application/json");
session_start();
include('config.php');
$db = Singleton::getInstance();
$idU = $_SESSION['idUsuario'];
$data = json_decode(file_get_contents("php://input"));//Se almacena el json que se recibe del cliente
var_dump($data[0]);
$nomModelo = $data[count($data)-1]->{'nombreModelo'};
//echo($nomModelo);
$queryM = $db->db->prepare('SELECT * from modelo where idUsuario=:i and nombre=:n');
$queryM->bindParam(':i', $idU, PDO::PARAM_INT);
$queryM->bindParam(':n', $nomModelo, PDO::PARAM_STR);
if ($queryM->execute()) {
    if ($queryM->rowCount()==0) {
        $insertModel = $db->db->prepare('INSERT INTO modelo(nombre, idUsuario) VALUES(:n, :i)');
        $insertModel->bindParam(':n', $nomModelo,PDO::PARAM_STR);
        $insertModel->bindParam(':i', $idU, PDO::PARAM_INT);
        if ($insertModel->execute()) {
            $idModelo = $db->db->lastInsertId();
            echo "Id del MODELO".$idModelo;
            foreach ($data as $i => $clase) {
                if ($i != count($data)-1) {
                    //INSERTAMOS LA CLASE
                    $insertClase = $db->db->prepare('INSERT INTO clases(idClases, nombre, herencia, idModelo, idUsuario)
                                                             VALUES(:iC, :n, :h, :iM, :iU)');
                    $insertClase->bindParam(':iC', $clase->{'id'}, PDO::PARAM_STR);
                    $insertClase->bindParam(':n', $clase->{'nombre'}, PDO::PARAM_STR);
                    $insertClase->bindParam(':h', $clase->{'herencia'}, PDO::PARAM_STR);
                    $insertClase->bindParam(':iM', $idModelo, PDO::PARAM_INT);
                    $insertClase->bindParam(':iU', $idU, PDO::PARAM_INT);
                    $insertClase->execute();
                    
                    $idClase = $clase->{'id'};
                    if (count($clase->{'atributos'})!= 0) {
                        echo "Atributos\n";//Recorremos lo atributos
                        foreach ($clase->{'atributos'} as $j => $atributo) {
                            echo $atributo->{'nombre'};
                            $insertAttr = $db->db->prepare('INSERT INTO atributos(nombre, tipo, idClases, idModelo, idUsuario)
                                                                        VALUES(:n, :t,:iC, :iM, :iU)');
                            $insertAttr->bindParam(':n',$atributo->{'nombre'},PDO::PARAM_STR);
                            $insertAttr->bindParam(':t',$atributo->{'tipo'},PDO::PARAM_STR);
                            $insertAttr->bindParam(':iC',$idClase, PDO::PARAM_STR);
                            $insertAttr->bindParam(':iM', $idModelo, PDO::PARAM_INT);
                            $insertAttr->bindParam(':iU', $idU, PDO::PARAM_INT);
                            $insertAttr->execute();
                        }
                    }else{
                        echo "La clase ".$clase->{'nombre'}." no tiene atributos\n";
                    }
                    if (count($clase->{'metodos'})!=0) {
                        echo "\nMetodos\n";//Recorremos los metodos
                        foreach ($clase->{'metodos'} as $z => $metodo) {
                            echo $metodo->{'nombre'};
                            foreach ($metodo->{'parametros'} as $k => $parametro) {//Recorremos los parametros de cada metodo
                                echo "\nParametro:".$parametro->{'nombre'};
                            }
                        }
                    }else{
                        echo "La clase ".$clase->{'nombre'}." no tiene metodos\n";
                    }
                }
            }
        }else{
            echo "Algo salió mal al insertar modelo";
        }
        
    }else{
        echo "Ya existe un modelo guardado con ese nombre";
    }
}else{
    echo "Algo salio mal con la consulta";
}
?>