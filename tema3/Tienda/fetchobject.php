<?php
try {
    // 1. Establecemos la conexión
    $conProyecto = new mysqli('localhost', 'gestor', 'secreto', 'proyecto');

    // 2. Ejecutamos la consulta SQL
    $sql = "SELECT s.unidades, p.nombre FROM stocks s, productos p WHERE s.producto=p.id AND s.unidades < 2";

    $resultado = $conProyecto->query($sql);

    // 3. Recuperamos el primer registro como objeto
    $stock = $resultado->fetch_object();

    // 4. Recorremos los registros obtenidos
    while ($stock != null) {
        echo "<p>Producto $stock->nombre: $stock->unidades unidades.</p>";

        // Recuperamos el siguiente registro
        $stock = $resultado->fetch_object();
    }
    // 5. Liberamos los resultados
    $resultado->free();
} catch (mysqli_sql_exception $e) {
    echo "<p>Error en la consulta: "
        . htmlspecialchars($e->getMessage()) . "</p>";
} finally {

    // 6. Cerramos la conexión
    if (isset($conProyecto)) {
        $conProyecto->close();
    }
}
