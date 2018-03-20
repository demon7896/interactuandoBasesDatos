<?php

session_start();


require ("lib.php");
$conex_mysql = new ConectorBD();


$idEvent=$_POST["id"];
$start_date= $_POST["start_date"];



if (validateDate($_POST["end_date"])){
    $end_date= "'".$_POST["end_date"]."'";
}else{
    $end_date= "NULL";
}

$response = ["msg" => ""];


if ($conex_mysql->initConexion("agenda")=="OK") {


    $query = "UPDATE events SET start_date = '". $start_date ."', end_date = $end_date WHERE (id = ".$idEvent .")";

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




function validateDate($test_date){

      $y = substr($test_date, 0,4);
      $m = substr($test_date, 5,2);
      $d = substr($test_date, 8,2);


      if (is_numeric($d) && is_numeric($d) && is_numeric($d)){

          if (checkdate($m ,$d,$y)){

            return  true;

          }else{

             //return "NO  VALIDA DIA:".$d." MES:".$m."Año: ".$y;
             return false;
          }
     }else{

          return false;
     }

      //return "Fecha Imput:".$test_date." Output: ".$test;
}

