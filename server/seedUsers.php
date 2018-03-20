<?php

require ("lib.php");
$conex_mysql = new ConectorBD();

if ($conex_mysql->initConexion("agenda")=="OK"){
    echo "<p>Conexion ok, con la Base de Datos</p><br>";
}else {
    die("<p>Ups..!!!!   Error en Conexion</p><br>");
}

$result = $conex_mysql->ejecutarQuery("TRUNCATE users");
$result = $conex_mysql->ejecutarQuery("TRUNCATE events");

$user1 = "INSERT INTO users (username, name, password, birthday) VALUES ('diegoarmando.rs@gmail.com', 'Diego Rodriguez', '". password_hash("12345", PASSWORD_DEFAULT)  ."', '1985-11-01')";
$user2 = "INSERT INTO users (username, name, password, birthday) VALUES ('diegorodriguez__@hotmail.com', 'Diego A Rodriguez', '". password_hash("12345", PASSWORD_DEFAULT)  ."', '1985-11-01')";
$user3 = "INSERT INTO users (username, name, password, birthday) VALUES ('diego@nextu.com', 'Diego Rodriguez S', '". password_hash("12345", PASSWORD_DEFAULT)  ."', '1985-11-01')";

$conex_mysql->ejecutarQuery($user1);
$conex_mysql->ejecutarQuery($user2);
$conex_mysql->ejecutarQuery($user3);

echo "<p> Usuarios Insertados con Exito</p><br>";
