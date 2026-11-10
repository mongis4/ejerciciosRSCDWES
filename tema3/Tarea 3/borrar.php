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

if (isset($_POST['borrar'])) {
    echo "No hay ningun producto que borrar";
} else {
    try {
        $id = $_POST['borrar'];
        $consulta_delete = "DELETE FROM productos WHERE id= :id";
        $stmt = $conProyecto->prepare($consulta_delete);
        $stmt->execute([':id' => $id]);
        if ($stmt->rowCount() > 0) {
            echo "Producto borrado correctamente";
        } else {
            echo "nada";
        }
    } catch (PDOException $e) {
        die("Error al recuperar los productos: " . htmlspecialchars($e->getMessage()));
    }
}
