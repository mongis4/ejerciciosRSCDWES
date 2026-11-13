<?php
require_once 'conexion.php';

$consulta = 'SELECT * FROM usuarios WHERE usuario = :u AND pass = :p';
$password = hash('sha256', $_SERVER['PHP_AUTH_PW']);
try {
    $stmt = $conProyecto->prepare($consulta);
    $stmt->execute([
        ':u' => $_SERVER['PHP_AUTH_USER'],
        ':p' => $password
    ]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $ex) {
    $conProyecto = null;
    die('Error al recuperar los datos de MySQL: ' . $ex->getMessage());
}
// Si la consulta no devuelve ningún usuario, las credenciales son erróneas.
if ($usuario === false) {
    header('WWW-Authenticate: Basic realm="Contenido restringido"');
    header('HTTP/1.0 401 Unauthorized');
    $stmt = null;
    $conProyecto = null;
    exit;
}
$stmt = null;
$conProyecto = null;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CDN de Bootstrap -->
    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstr
ap.min.css"
        integrity="sha384-
Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
        crossorigin="anonymous">
    <title>Ejercicio 1.3 Unidad 4</title>
</head>

<body style="background: gainsboro;">
    <h4 class="mt-3 text-center font-weight-bold">
        Solución Ejercicio
    </h4>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-4 font-weight-bold">
                Nombre Usuario:
            </div>
            <div class="col-md-4">
                <?php
                echo htmlspecialchars(
                    $_SERVER['PHP_AUTH_USER'],
                    ENT_QUOTES,
                    'UTF-8'
                );
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 font-weight-bold">
                Password Usuario (sha256):
            </div>
            <div class="col-md-4">
                <?php echo $password; ?>
            </div>
        </div>
    </div>
</body>

</html>