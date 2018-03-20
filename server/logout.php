<?php

$response = ["msg" => ""];

session_start();
$_SESSION = array();

if(session_destroy()){
  $response=["msg"=> "OK"];
}else{
  $response["msg"]="Error: No se pudo cerrar la sesión, Intente Nuevamnete.";
 }

 echo json_encode($response);