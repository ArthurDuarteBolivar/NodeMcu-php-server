<?php
session_start();
session_destroy();
header('Location: pagina-login.php');
exit();


?>