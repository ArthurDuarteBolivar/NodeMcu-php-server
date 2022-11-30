<?php
    session_start();
    if(!$_SESSION['usuario']){
        header('Location: pagina-login.php');
        exit();
    }

?>