<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-color: wheat;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        button {
            border: 2px solid #AD1E00;
            border-radius: 5px;
            padding: 5px;
            background-color: #F54927;
            color: #400D00;
        }

        #btn-enviar {
            background-color: #2C8A0F;
            color: white;
            border: 2px solid #0D4203;
        }

        .contenedor-form {
            display: flex;
            justify-content: center;
        }

        input {
            border: 2px solid #FFC814;
            border-radius: 5px;
            padding: 5px;
            background-color: #FFF3C2;
            margin-left: 10px;
        }

        fieldset {
            border: 2px solid #b72305;
        }
    </style>
</head>

<body>
    <?php
    $agenda = [];

    if (!isset($_POST['vaciar']) && isset($_POST['agenda_oculta']) && is_array($_POST['agenda_oculta'])) {
        $agenda = $_POST['agenda_oculta'];
    }

    if (isset($_POST['nombre'])) {
        $nombre = trim($_POST['nombre']);
        $telefono = trim($_POST['telefono']);

        $agenda[$nombre] = $telefono;

        if (isset($_POST['telefono'])) {

            if ($telefono == "") {
                foreach ($agenda as $clave => $valor) {
                    if ($clave == $nombre) {
                        unset($agenda[$clave]);
                        break;
                    }
                }
            }
        }

        if (count($agenda) > 0) {
            echo ' <fieldset style="width:50%; margin:auto">';
            echo       '<legend>Datos Agenda</legend>';
            echo        '<ul>';

            foreach ($agenda as $contacto => $telefono) {
                echo "<li>$contacto: $telefono</li>";
            }

            echo        '</ul>';
            echo    '</fieldset>';
        }
    }
    ?>
    <div>
        <fieldset style="width:50%; margin:auto">
            <legend>Nuevo Contacto</legend>
            <div class="contenedor-form">
                <form name="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" required><br><br>
                    <label for="telefono">Teléfono</label>
                    <input type="tel" name="telefono"><br><br>
                    <button id="btn-enviar" type="submit" value="Añadir contacto" name="enviar">Enviar</button>
                    <button type="reset" value="Limpiar campos">Limpiar</button>
                    <?php foreach ($agenda as $nombre => $telefono): ?>
                        <input type="hidden" name="agenda_oculta[<?= $nombre ?>]" value="<?= $telefono ?>">
                    <?php endforeach; ?>
                </form>
            </div>
        </fieldset>
        <fieldset style="width:50%; margin:auto">
            <legend>Vaciar Agenda</legend>
            <div class="contenedor-form">
                <form name="formvaciar" <?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <button name="submit" value="vaciar" name="vaciar">Vaciar</button>
                </form>
            </div>
        </fieldset>
    </div>
</body>

</html>