<?php
session_start();
//unset($_SESSION['session_usuario']);
//unset($_SESSION['mensaje']);
session_destroy();
header ("refresh: 5; url= usuarios/login.php");

echo "en 5 segundos sera redireccionado al login"
?>