<?php

session_start();


require ("lib.php");
$conex_mysql = new ConectorBD();

$title=$_POST["titulo"];
$start_date= $_POST["start_date"];



if ($_POST["allDay"]=="true") {
    $all_day=1;
    $start_hour= 'NULL';
    $end_date='NULL';
    $end_hour= 'NULL';

}else{
    $all_day=0;
    $start_hour= "'".$_POST["start_hour"]."'";
    $end_date= "'".$_POST["end_date"]."'";
    $end_hour= "'". $_POST["end_hour"]."'";
} 

$response = ["msg" => ""];


if ($conex_mysql->initConexion("agenda")=="OK") {


    $query = "INSERT INTO events (id, title, start_date, allDay, start_hour, end_date, end_hour, IdUser) 
              VALUES (NULL,
              '" . $title . "',
              '". $start_date ."',
               ". $all_day .", 
               ". $start_hour .",
               ". $end_date .", 
               ". $end_hour .",
               ". $_SESSION["id"].")";


    if($conex_mysql->ejecutarQuery($query)){
        $response["msg"]="OK";
        $response["idEvent"]= $conex_mysql->getInsertID();


    }else{
        $response["msg"]="ERROR: No se pudo guardar el nuevo evento";
        $response["error"]=$conex_mysql->getError();
        $response["sql"]=$query;
    };


}else{

    $response["msg"]="ERROR: Imposible conectar con el Servidor";

}



echo json_encode($response);







