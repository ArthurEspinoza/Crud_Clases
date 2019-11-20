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
                if (count($clase->{'atributos'})!= 0) {
                    echo "Atributos\n";//Recorremos lo atributos
                    foreach ($clase->{'atributos'} as $j => $atributo) {
                        echo $atributo->{'nombre'};
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
        echo "Ya existe un modelo guardado con ese nombre";
    }
}else{
    echo "Algo salio mal con la consulta";
}
?>