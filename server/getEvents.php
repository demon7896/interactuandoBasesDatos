<?php
require ("lib.php");
$conex_mysql = new ConectorBD();
$response = ["msg" => ""];

$eventos = array();

session_start();


if(!isset($_SESSION["id"])){
    $response["msg"]="Acceso Denegado...";
    session_destroy();
    exit(json_encode($response));

}else {


    if ($conex_mysql->initConexion("agenda") == "OK") {


        $query = $conex_mysql->ejecutarQuery("SELECT * FROM events WHERE IdUser=" . $_SESSION["id"]);


        //SELECT `id`, `title`, `start_date`, `allDay`, `start_hour`, `end_date`, `end_hour`, `done`, `IdUser` FROM `events` WHERE `IdUser`=51

        while ($fila = $query->fetch_assoc()) {

            $eventos[] = ['id' => $fila["id"],
                'title' => $fila["title"],
                'start' => $fila["start_date"],
                'end' => $fila["end_date"],
                'allDay' => $fila["allDay"]];;

        }


        $response = ["msg" => "OK", "eventos" => $eventos, "username"=>$_SESSION["username"]];


    } else {
        $response["msg"] = "ERROR: Imposible conectar con el Servidor para obtener los eventos";

    }


    echo json_encode($response);

}
