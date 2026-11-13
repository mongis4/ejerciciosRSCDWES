<?php
// Si el usuario no se ha autentificado, pedimos las credenciales.
if (!isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])) {
    header('WWW-Authenticate: Basic realm="Contenido restringido"');
    header('HTTP/1.0 401 Unauthorized');
    exit;
}
// Conexión a la base de datos proyecto.
$host = 'localhost';
$db = 'proyecto';
$user = 'gestor';
$pass = 'secreto';
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
try {
    $conProyecto = new PDO($dsn, $user, $pass);
    $conProyecto->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );
} catch (PDOException $ex) {
    die('Error en la conexión: ' . $ex->getMessage());
}
