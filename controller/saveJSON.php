<?php 
header("Content-Type: application/json");
session_start();
include('config.php');
$db = Singleton::getInstance();
$idU = $_SESSION['idUsuario'];
$data = json_decode(file_get_contents("php://input"));//Se almacena el json que se recibe del cliente
//var_dump($data[0]);
$nomModelo = $data[count($data)-1]->{'nombreModelo'};
//echo($nomModelo);
$queryM = $db->db->prepare('SELECT * from modelo where idUsuario=:i and nombre=:n');
$queryM->bindParam(':i', $idU, PDO::PARAM_INT);
$queryM->bindParam(':n', $nomModelo, PDO::PARAM_STR);
if ($queryM->execute()) {
    if ($queryM->rowCount()==0) {
        foreach ($data as $i => $clase) {
            if ($i != count($data)-1) {
                //echo $clase->{'nombre'};
                echo "Atributos\n";
                foreach ($clase->{'atributos'} as $j => $atributo) {
                    echo $atributo->{'nombre'};
                }
                echo "Metodos\n";
                foreach ($clase->{'metodos'} as $z => $metodo) {
                    echo $metodo->{'nombre'};
                }
            }
        }
    }else{
        echo "Ya existe un modelo guardado con ese nombre";
    }
}else{
    echo "Algo salio mal con la consulta";
}
?>