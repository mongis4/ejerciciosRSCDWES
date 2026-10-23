<?php
$errores = [];
$modulos = [];
function comprobarCadenas($cadena, $campo)
{
    global $errores;
    if ($cadena == '') {
        $errores[] = "El campo $campo está vacío";
        return false;
    }
    return true;
}
function existenModulos()
{
    global $errores;
    if (!isset($_POST['modulo'])) {
        $errores[] = "No has elegido ningún módulo, revíselo";
        return false;
    }
    return true;
}
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width,
user-scalable=no,
initial-scale=1.0,
maximum-scale=1.0,
minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formularios</title>
</head>

<body style="background: gainsboro">
    <?php
    $nombre = trim($_POST['nombre']);
    comprobarCadenas($nombre, "Nombre");
    $apellidos = trim($_POST['apellidos']);
    comprobarCadenas($apellidos, "Apellidos");
    $mail = trim($_POST['mail']);
    comprobarCadenas($mail, "Mail");
    $edad = $_POST['edad'];
    /* Comprobamos los módulos */
    if (existenModulos()) {
        foreach ($_POST['modulo'] as $v) {
            $modulos[] = $v;
        }
    }
    /* Mostramos errores o datos */
    if (count($errores) > 0) {
        echo "Ha habido " . count($errores) . " errores, estos han sido:<br>";
        echo "<ol>";
        foreach ($errores as $v) {
            echo "<li>$v</li>";
        }
        echo "</ol>";
    } else {
        echo "Sin errores. Los datos son:";
        echo "<br>Apellidos, Nombre: " . $apellidos . ", " . $nombre;
        echo "<br>e-mail: " . $mail;
        echo "<br>Edad: " . $edad . " años";
        echo "<br>Módulos matriculados:<br>";
        echo "<ol>";
        foreach ($modulos as $v) {
            echo "<li>$v</li>";
        }
        echo "</ol>";
    }
    ?>
</body>

</html>