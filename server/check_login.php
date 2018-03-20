<?php
require ("lib.php");
$conex_mysql = new ConectorBD();

$username=$_POST["username"];
$password= $_POST["password"];

$response = ["msg" => ""];


session_start();
$_SESSION = array();


if ($conex_mysql->initConexion("agenda")=="OK") {

        if($query = $conex_mysql->ejecutarQuery("SELECT id, username,password FROM users WHERE username='".$username."'")){


            if ($query->num_rows>0){

                $fila = $query->fetch_assoc();

                if (password_verify($password, $fila["password"])) {

                    $_SESSION['id'] = $fila["id"];
                    $_SESSION['username'] = $fila["username"];

                    $response["msg"]="OK";

                } else {


                    $response["msg"]="Usuario y/o contraseña no válidos";

                }

            }else{

                $response["msg"]="Usuario Invalido.";
            }


        }else{
            $response["msg"]="ERROR: Consulta SQL no Valida.";

        }

}else{

    $response["msg"]="ERROR: Imposible conectar con el Servidor";;


}


if($response["msg"]!="OK"){
    session_destroy();
}


echo json_encode($response);


