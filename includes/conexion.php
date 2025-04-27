<?php
// Conexión:
$server = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'blog';
$db = mysqli_connect($server, $username, $password, $database);

mysqli_query($db, "SET NAMES 'utf8'");

// Iniciar la sesión:
if (!isset($_SESSION)) {
   session_start();
}

?>
