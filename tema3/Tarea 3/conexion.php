<?php
// Hacemos la conexión, sería buena idea hacerla en un archivo aparte
// y utilizar 'require' o 'require_once', por ejemplo.

$host = "localhost";
$db = "proyecto";
$user = "gestor";
$pass = "secreto";
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

$conProyecto = new PDO($dsn, $user, $pass);
// Configuramos PDO para lanzar excepciones
$conProyecto->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
function cerrarConexion()
{
    global $conProyecto;
    $conProyecto = null;
}
