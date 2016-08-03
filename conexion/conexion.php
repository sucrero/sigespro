<?php
require_once 'DataAccess.php';
$motor="Postgres";
$host="127.0.0.1";
//$usuario="carrocar_usersigespro";
//$usuario = "usersigespro";
$usuario="postgres";
//$clave = "Osfran..1705";
//$clave="osfran..1705";
$clave="postgres";
//$base_datos="sigespro";
//$base_datos="carrocar_sigespro";
//$base_datos="sigespro_060912";
$base_datos="sigespro";
$acceso = new DataAccess($motor, $host, $usuario, $clave, $base_datos);
?>