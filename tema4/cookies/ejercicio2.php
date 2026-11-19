<?php
// Si el usuario no se ha autentificado, pedimos las credenciales.
if (!isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])) {
    header('WWW-Authenticate: Basic realm="Contenido restringido"');
    header('HTTP/1.0 401 Unauthorized');
    exit;
}
// Guardaremos el usuario en una variable de sesión.
// Si no existe, comprobamos sus credenciales.
session_start();
if (!isset($_SESSION['usuario'])) {
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
    // Hacemos la consulta con las credenciales recibidas.
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
    // Si las credenciales son correctas, guardamos el nombre en la sesión.
    $_SESSION['usuario'] = $_SERVER['PHP_AUTH_USER'];
} else {
    // Si ya está autentificado, registramos la visita.
    date_default_timezone_set('Europe/Madrid');
    $formato = new IntlDateFormatter(
        'es_ES',
        IntlDateFormatter::FULL,
        IntlDateFormatter::MEDIUM,
        'Europe/Madrid',
        IntlDateFormatter::GREGORIAN,
        "'Tu última visita fue el' EEEE, dd 'de' MMMM 'de' yyyy 'a las'
HH:mm:ss"
    );
    $fecha = $formato->format(new DateTime());
    // Comprobamos si se ha enviado el formulario para limpiar el registro.
    if (isset($_POST['limpiar'])) {
        unset($_SESSION['visita']);
    } else {
        $_SESSION['visita'][] = $fecha;
    }
}
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
    <title>Ejemplo Sesiones</title>
</head>

<body style="background: gainsboro;">
    <h4 class="mt-3 text-center font-weight-bold">
        Ejercicio Apartado 3.2
    </h4>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-4 font-weight-bold">
                Nombre Usuario:
            </div>
            <div class="col-md-4">
                <?php
                echo htmlspecialchars(
                    $_SESSION['usuario'],
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
                <?php echo hash('sha256', $_SERVER['PHP_AUTH_PW']); ?>
            </div>
        </div>
        <?php if (!isset($_SESSION['visita'])): ?>
            <p class="text-success font-weight-bold mt-3">
                Bienvenido, es tu primera visita.
            </p>
        <?php else: ?>
            <p class="text-success font-weight-bold mt-3">
                Tus anteriores visitas han sido:
            </p>
            <ul>
                <?php foreach ($_SESSION['visita'] as $k => $v): ?>
                    <li>
                        <?php echo htmlspecialchars($v, ENT_QUOTES, 'UTF-
8'); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <form name="vaciar" action="" method="post">
            <input
                type="submit"
                name="limpiar"
                value="Limpiar registro"
                class="btn btn-warning">
        </form>
    </div>
</body>

</html>