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
// Hacemos la consulta.
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
// Si no se encuentra el usuario, las credenciales son erróneas.
if ($usuario === false) {
    header('WWW-Authenticate: Basic realm="Contenido restringido"');
    header('HTTP/1.0 401 Unauthorized');
    $stmt = null;
    $conProyecto = null;
    exit;
}
$stmt = null;
$conProyecto = null;
// Configuramos el idioma y la zona horaria.
date_default_timezone_set('Europe/Madrid');
// Obtenemos la fecha y la hora del acceso actual.

$formato = new IntlDateFormatter(
    'es_ES',
    IntlDateFormatter::FULL,
    IntlDateFormatter::MEDIUM,
    'Europe/Madrid',
    null,
    "EEEE, dd 'de' MMMM 'de' yyyy 'a las' HH:mm:ss"
);
$ahora = time();

$fecha = 'Tu última visita fue el ' . $formato->format($ahora);
// Si existe la cookie, recuperamos su valor.
$nombreCookie = $_SERVER['PHP_AUTH_USER'];
if (isset($_COOKIE[$nombreCookie])) {
    $mensaje = $_COOKIE[$nombreCookie];
} else {
    $mensaje = 'Es la primera vez que visitas la página.';
}
// Creamos o actualizamos la cookie. Durará una semana.
setcookie(
    $nombreCookie,
    $fecha,
    time() + 7 * 24 * 60 * 60
);
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
    <title>Cookies</title>
</head>

<body style="background: gainsboro;">
    <p class="m-3">
        <?php
        echo htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8');
        ?>
    </p>
    <h4 class="mt-3 text-center font-weight-bold">
        Ejercicio Apartado 2 Unidad 4
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