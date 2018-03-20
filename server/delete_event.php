<?php

session_start();


require ("lib.php");
$conex_mysql = new ConectorBD();


$idEvents=$_POST["id"];


$response = ["msg" => ""];


if ($conex_mysql->initConexion("agenda")=="OK") {

    $query = "DELETE FROM events WHERE (id =". $idEvents ." ) AND (idUser =". $_SESSION["id"] .")";

    if($conex_mysql->ejecutarQuery($query)){
        $response["msg"]="OK";
    }else{
        $response["msg"]="ERROR: No se pudo guardar el nuevo evento";
        $response["error"]=$conex_mysql->getError();
        $response["sql"]=$query;
    };


}else{

    $response["msg"]="ERROR: Imposible conectar con el Servidor";

}



echo json_encode($response);




