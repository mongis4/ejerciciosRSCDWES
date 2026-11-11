<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Crear producto</title>
    <style>
        #id-form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 1fr;
        }
    </style>
</head>

<body style="background: gainsboro">
    <h3 style="text-align: center; font-weight: bold">Crear producto</h3>
    <?php
    /*aqui procesaremos el formulario comprobando si hemos pulsado el submit
si lo hemos hecho procesamos los datos, si no mostramos el formulario
fijate donde cerramos el "else" */
    if (isset($_POST['enviar'])) {
        // --> procesamos los datos
        echo "Tu nombre es: <b>{$_POST['nombre']}</b> y tu mail <b>{$_POST['mail']}</b>";
    } else {
        // -->Si no hemos dado al boton enviar, pintamos el formulario
    ?>
        <fieldset style="width:50%; margin:auto">
            <legend>Datos</legend>
            <form id="id-form" name="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <label for="nombre">Nombre: <br><input type="text" name="nombre" placeholder="Nombre" required></label>
                <label for="nombre">Nombre corto: <br><input type="text" name="nombre-corto" placeholder="Nombre corto" name="nombre-corto" required><br>
                    <label for="nombre">Precio(Euros): <br><input type="number" name="precio" placeholder="20" required></label>
                    <label for="nombre">Familia: <br><input type="text" name="familia" placeholder="Nombre corto" name="familia" required>
                        <input type="submit" value="Enviar" name="enviar">&nbsp;&nbsp;
                        <input type="reset" value="Limpiar">
            </form>
        </fieldset>
    <?php } ?>
</body>

</html>