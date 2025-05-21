<?php// Conexión:
$server = 'bjgxdw6eknypx7xpgifz-mysql.services.clever-cloud.com';
$username = 'ux0v0ymrpggfhvxj';
$password = '1tW0pGI6z4s7CBQ1eaiw';
$database = 'bjgxdw6eknypx7xpgifz';
$db = mysqli_connect($server, $username, $password, $database);

mysqli_query($db, "SET NAMES 'utf8'");

// Iniciar la sesión:
if (!isset($_SESSION)) {
   session_start();
}

?>
