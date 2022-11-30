<?php
$host = "localhost";
$usuario = "root";
$senha = "5691";
$db =  "nodemcu";

$mysqli = new mysqli($host, $usuario, $senha, $db);

if($mysqli->connect_errno){
    echo "falha (" . $mysqli->connect_errno . ")". $mysqli->connect_error;
}   



?>