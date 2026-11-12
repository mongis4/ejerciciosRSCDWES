<?php
require_once 'conexion.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Crear producto</title>
    <link rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
        crossorigin="anonymous">
    <style>
        #id-form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 1fr;
        }

        #div-textarea {
            grid-column: span 2;
            /* Ocupa las 2 columnas disponibles */
        }

        #id-textarea {
            height: 200px;
            margin-bottom: 20px;
        }

        .divs {
            margin: 10px;
        }

        input {
            width: 100%;
        }

        #div-botones {
            display: flex;
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
        try {
            $nombre = $_POST['nombre'];
            $nombre_corto = $_POST['nombre-corto'];
            $precio = $_POST['precio'];
            $familia = $_POST['familia'];
            $descripcion = $_POST['textarea'];

            $sql = "INSERT INTO productos (nombre,nombre_corto,descripcion,pvp,familia) VALUES (:nombre,:nombre_corto,:descripcion,:pvp,:familia)";
            $stmt = $conProyecto->prepare($sql);
            $stmt->execute([':nombre' => $nombre, ':nombre_corto' => $nombre_corto, ':descripcion' => $descripcion, ':pvp' => $precio, ':familia' => $familia]);
            echo "Producto insertado correctamente";
        } catch (Exception $e) {
            echo "Error al insertar . $e";
        } finally {
            $conProyecto = null;
        }
        echo "
    <form action='listado.php' method='POST' style='display:inline;'>
        <button type='submit' class='btn btn-danger mr-3'>Volver</button>
    </form>
    ";
    } else {
        // -->Si no hemos dado al boton enviar, pintamos el formulario
    ?>
        <fieldset style="width:50%; margin:auto">
            <legend>Datos</legend>
            <form id="id-form" name="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="divs">
                    <label for="nombre">Nombre: <br><input type="text" name="nombre" placeholder="Nombre" required></label>
                </div>
                <div class="divs">
                    <label for="nombre">Nombre corto: <br><input type="text" name="nombre-corto" placeholder="Nombre corto" name="nombre-corto" required><br>
                </div>
                <div class="divs">
                    <label for="nombre">Precio(Euros): <br><input type="number" name="precio" placeholder="Precio (€)" required></label>
                </div>
                <div class="divs">
                    <label for="familia">Familia: <br>
                        <select name="familia" id="familia-select">
                            <?php
                            try {
                                $consulta1 = "SELECT cod, nombre FROM familias";
                                $resultado1 = $conProyecto->query($consulta1);
                            } catch (PDOException $e) {
                                die("Error al recuperar los productos: " . htmlspecialchars($e->getMessage()));
                            }
                            echo "<option value=''>--Elige una opción--</option>";
                            while ($r = $resultado1->fetch()) {
                                echo "<option value='{$r['cod']}'>$r[nombre]</option>";
                            }
                            ?>
                        </select>
                    </label>
                </div>
                <div id="div-textarea">
                    <label>Descripcion: <br><textarea name="textarea" rows="5" cols="30"></textarea></label>
                </div>
                <div id="div-botones">
                    <input type="submit" value="Enviar" name="enviar" class="btn btn-info mr-2">&nbsp;&nbsp;
                    <input type="reset" value="Limpiar" class="btn btn-info mr-2">
                    <a href="listado.php"><input type="button" value="Volver" class="btn btn-info mr-3"></a>
                </div>
            </form>
        </fieldset>
    <?php } ?>
</body>

</html>