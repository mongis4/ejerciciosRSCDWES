<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-color: wheat;
        }
    </style>
</head>

<body>
    <?php
    $agenda = [];
    function vaciarAgenda()
    {
        $agenda = [];
    }

    if (isset($_POST['nombre'])) {
        $nombre = trim($_POST['nombre']);
        $telefono = trim($_POST['telefono']);

        $agenda[$nombre] = $telefono;

        if (isset($agenda)) {
            echo ' <fieldset style="width:50%; margin:auto">';
            echo       '<legend>Datos Agenda</legend>';
            echo        '<ul>';

            foreach ($agenda as $contacto => $telefono) {
                echo "<li>$contacto: $telefono</li>";
            }

            echo        '</ul>';
            echo    '</fieldset>';;
        }
    }
    ?>
    <div>

        <fieldset style="width:50%; margin:auto">
            <legend>Nuevo Contacto</legend>
            <form name="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" required><br><br>
                <label for="telefono">Teléfono</label>
                <input type="tel" name="telefono" required><br><br>
                <input type="submit" value="Añadir contacto" name="enviar">
                <input type="reset" value="Limpiar campos">
            </form>
        </fieldset>
        <fieldset style="width:50%; margin:auto">
            <legend>Vaciar Agenda</legend>
            <button name="vaciar" type="button action=" <?php echo $_SERVER['PHP_SELF']; ?>" method="POST">Vaciar</button>
        </fieldset>
    </div>
</body>

</html>