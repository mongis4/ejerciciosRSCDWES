<?php
// Hacemos la conexión con la base de datos
// Sería buena idea hacerlo en un archivo aparte
// y utilizar require o require_once.
$conProyecto = new mysqli('localhost', 'gestor', 'secreto', 'proyecto');
// Comprobamos la conexión
if ($conProyecto->connect_error) {
    die('Error de conexión (' . $conProyecto->connect_errno . ') ' .
        $conProyecto->connect_error);
}
// Función para cerrar la conexión
function cerrarConexion()
{
    global $conProyecto;
    $conProyecto->close();
}
// Función para mostrar el botón de volver
function pintarBoton()
{
    $pagina = htmlspecialchars($_SERVER['PHP_SELF']);
    echo "<a href='$pagina' class='btn btn-success mb-2'>
Consultar otro artículo
</a>";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS de Bootstrap -->
    <link rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/boots
trap.min.css">
    <title>Ejercicio Tema 3: Conjuntos de resultados en MySQLi</title>
</head>

<body style="background: antiquewhite">
    <h3 class="text-center mt-2 font-weight-bold">
        Ejercicio Resuelto
    </h3>
    <div class="container mt-3">
        <?php
        // OPCIÓN 1: Consultar las unidades de un producto
        if (isset($_POST['enviar'])) {
            $codProd = (int) $_POST['producto'];
            // Inicializamos las sentencias preparadas
            $stmt = $conProyecto->stmt_init();
            $stmt1 = $conProyecto->stmt_init();
            // Consulta para obtener los datos del producto
            $consulta1 = "SELECT nombre, nombre_corto
FROM productos
WHERE id = ?";
            // Consulta para obtener el stock por tienda
            $consulta = "SELECT unidades, tienda, producto,
tiendas.nombre AS nombreTienda
FROM stocks, tiendas
WHERE tienda = tiendas.id AND producto = ?";
            // Preparamos las consultas
            if (!$stmt->prepare($consulta) || !$stmt1->prepare($consulta1)) {
                die("Error al preparar las consultas: " . $conProyecto->error);
            }
            // Asociamos los parámetros
            $stmt->bind_param('i', $codProd);
            $stmt1->bind_param('i', $codProd);
            // Ejecutamos la consulta del producto
            if (!$stmt1->execute()) {
                die("Error al recuperar producto: " . $stmt1->error);
            }
            // Asociamos las columnas a las variables
            $stmt1->bind_result($n, $nc);
            // Obtenemos el producto
            if (!$stmt1->fetch()) {
                die("No se ha encontrado el producto.");
            }
            $stmt1->close();
            // Ejecutamos la consulta de stock
            if (!$stmt->execute()) {
                die("Error al recuperar unidades: " . $stmt->error);
            }
            // Asociamos las columnas del resultado
            $stmt->bind_result($u, $ct, $cp, $nt);
            // Mostramos el nombre del producto
            echo "<h4 class='mt-3 mb-3 text-center'>
Unidades del Producto: " .
                htmlspecialchars($n) . " (" . htmlspecialchars($nc) . ")
</h4>";
            pintarBoton();
            // Creamos la tabla
            echo "<table class='table table-striped table-dark'>";
            echo "<thead>";
            echo "<tr class='font-weight-bold'>
<th class='text-center'>Nombre Tienda</th>
<th>Unidades</th>
<th class='text-center'>Acciones</th>
</tr>";
            echo "</thead>";
            echo "<tbody>";
            // Recorremos los registros obtenidos
            while ($stmt->fetch()) {
                $pagina = htmlspecialchars($_SERVER['PHP_SELF']);
                echo "<tr class='text-center'>";
                echo "<td>" . htmlspecialchars($nt) . "</td>";
                echo "<td class='text-center m-auto'>";
                // Formulario para modificar el stock
                echo "<form name='a' action='$pagina'
method='POST' class='form-inline'>";
                echo "<input type='number'
class='form-control'
step='1'
min='0'
name='stock'
value='$u'
required>";
                echo "<input type='hidden' name='ct' value='$ct'>";
                echo "<input type='hidden' name='cp' value='$cp'>";
                echo "</td><td>";
                echo "<input type='submit'
class='btn btn-warning ml-2'
name='enviar1'
value='Actualizar'>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            $stmt->close();
            cerrarConexion();
            // OPCIÓN 2: Actualizar las unidades de un producto
        } elseif (isset($_POST['enviar1'])) {
            $codTienda = (int) $_POST['ct'];
            $codProducto = (int) $_POST['cp'];
            $unidades = (int) $_POST['stock'];
            // Consulta para actualizar las unidades
            $update = "UPDATE stocks
SET unidades = ?
WHERE producto = ? AND tienda = ?";
            // Inicializamos la sentencia preparada
            $stmt = $conProyecto->stmt_init();
            // Preparamos la consulta
            if (!$stmt->prepare($update)) {
                die("Error al preparar actualización: " . $conProyecto->error);
            }
            // Asociamos los parámetros
            $stmt->bind_param('iii', $unidades, $codProducto, $codTienda);
            // Ejecutamos la actualización
            if (!$stmt->execute()) {
                die("Error al actualizar unidades: " . $stmt->error);
            }
            echo "<p class='font-weight-bold text-success mt-3'>
Unidades actualizadas correctamente.
</p>";
            $stmt->close();
            cerrarConexion();
            pintarBoton();
            // OPCIÓN 3: Mostrar el formulario inicial
        } else {
        ?>
            <form name="f1"
                action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
                method="POST">
                <div class="form-group">
                    <label for="p" class="font-weight-bold">
                        Elige un producto
                    </label>
                    <select class="form-control" id="p" name="producto">
                        <?php
                        // Obtenemos todos los productos
                        $consulta = "SELECT id, nombre, nombre_corto FROM productos ORDER BY nombre";
                        $resultado = $conProyecto->query($consulta);
                        if (!$resultado) {
                            die("Error al recuperar productos: " . $conProyecto->error);
                        }
                        // Recorremos los productos
                        while ($fila = $resultado->fetch_assoc()) {
                            echo "<option value='" . (int) $fila['id'] . "'>" .
                                htmlspecialchars($fila['nombre']) .
                                "</option>";
                        }
                        cerrarConexion();
                        ?>
                    </select>
                </div>
                <div class="mt-2">
                    <input type="submit"
                        class="btn btn-info mr-3"
                        value="Consultar Stock"
                        name="enviar">
                </div>
            </form>
        <?php
        }
        ?>
    </div>
</body>

</html>