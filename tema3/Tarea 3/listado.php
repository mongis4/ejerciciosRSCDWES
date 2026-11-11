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
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS para usar Bootstrap -->
    <link rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
        crossorigin="anonymous">
    <title>Ejercicio Tema 3: CRUD</title>
</head>

<body style="background: antiquewhite">
    <h3 class="text-center mt-2 font-weight-bold">Gestión de productos</h3>
    <div class="container mt-3">
        <div class="mt-2">
            <a href="crear.php">
                <input type="button"
                    class="btn btn-info mr-3"
                    value="Crear"
                    name="crear">
            </a>
        </div>
        <br>
        <?php

        try {
            $consulta1 = "SELECT id, nombre FROM productos";
            $resultado1 = $conProyecto->query($consulta1);
        } catch (PDOException $e) {
            die("Error al recuperar los productos: " . htmlspecialchars($e->getMessage()));
        }

        echo "<table class='table table-striped table-dark'>";
        echo "<thead>";
        echo "<tr class='text-center font-weight-bold'><th>Código</th><th>Nombre</th>";
        echo "<th>Acciones</th></tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($filas = $resultado1->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr><td>{$filas['id']}</td><td class='text-
center'>{$filas['nombre']}</td><td>
        <form action='borrar.php' method='POST' style='display:inline;'>
            <button type='submit' class='btn btn-danger mr-3'>Borrar</button>
            <input type='hidden' name='borrar' value='{$filas['id']}'>
        </form>
            </td>
        </tr>";
        }
        echo "</tbody>";
        echo "</table>";
        cerrarConexion();

        ?>
    </div>
</body>

</html