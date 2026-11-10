<?php
// Hacemos la conexión con la base de datos.
// Sería buena idea hacerlo en un archivo aparte
// y utilizar require o require_once.
$host = "localhost";
$db = "proyecto";
$user = "gestor";
$pass = "secreto";
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
// Establecemos la conexión PDO
$conProyecto = new PDO($dsn, $user, $pass);
// Configuramos PDO para lanzar excepciones
$conProyecto->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS para utilizar Bootstrap -->
    <link rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/boots
trap.min.css">
    <title>Ejercicio Tema 3 PDO</title>
</head>

<body style="background: antiquewhite">
    <h3 class="text-center mt-2 font-weight-bold">
        Ejercicio Transacción con PDO
    </h3>
    <div class="container mt-3">
        <?php
        try {
            // 1. Iniciamos la transacción
            $conProyecto->beginTransaction();
            // 2. Actualizamos las unidades del producto en la tienda 1
            $update = "UPDATE stocks
SET unidades = 1
WHERE producto = (
SELECT id
FROM productos
WHERE nombre_corto = 'PAPYRE62GB'
)
AND tienda = 1";
            $conProyecto->exec($update);
            // 3. Insertamos el producto en la tienda 2
            $insert = "INSERT INTO stocks (producto, tienda, unidades)
SELECT id, 2, 1
FROM productos
WHERE nombre_corto = 'PAPYRE62GB'";
            $conProyecto->exec($insert);
            // 4. Confirmamos los cambios
            $conProyecto->commit();
            echo "<p class='text-primary font-weight-bold'>
Los cambios se realizaron correctamente.
</p>";
        } catch (PDOException $e) {
            // 5. Si ocurre un error, deshacemos los cambios
            if ($conProyecto->inTransaction()) {
                $conProyecto->rollBack();
            }
            echo "<p class='text-danger font-weight-bold'>
No se han podido realizar los cambios.
</p>";
            echo "<p>Error: " .
                htmlspecialchars($e->getMessage()) .
                "</p>";
        }
        // 6. Cerramos la conexión
        $conProyecto = null;
        ?>
    </div>
</body>

</html>