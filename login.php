<?php
session_start();
$conn = mysqli_connect('localhost','root','5691','nodemcu');
if(empty($_POST['usuario']) || empty($_POST['senha'])){
    header('Location: pagina-login.php');
    exit();
}
$usuario = mysqli_real_escape_string($conn, $_POST['usuario']);
$senha = mysqli_real_escape_string($conn, $_POST['senha']);

$query = "select * from login where usuario = '{$usuario}' and senha = '{$senha}'";
$result = mysqli_query($conn , $query);

$row  = mysqli_num_rows($result);


if($row == 1){
    $_SESSION['usuario'] = $usuario;
    header('location: pagina-maquinas.php');
    exit();
}else{
    header('location: pagina-login.php');
    exit();
}
?>