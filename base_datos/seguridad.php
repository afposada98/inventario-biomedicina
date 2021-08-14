<?php
//COMPRUEBA QUE EL USUARIO ESTA AUTENTIFICADO 
if(!isset($_SESSION["P29"]) || $_SESSION["P29"]==null){
    print "<script>alert(\"Acceso invalido!\");window.location='../index.php';</script>";
    exit();
}
    $perfil = $_SESSION['P29'];
    $usuario = $_SESSION['usuario'];
    $login= $_SESSION['login'];

    date_default_timezone_set('America/Bogota');
?>