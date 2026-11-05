<?php
try {
    // Establecemos la conexión
    $conProyecto = new mysqli('localhost', 'gestor', 'secreto', 'proyecto');
    echo "<p>Conexión establecida</p>";
    // Ejecutamos la consulta
    $resultado = $conProyecto->query('SELECT * FROM productos');
    // Mostramos los registros eliminados

    echo "<p>Se han encontrado $conProyecto->affected_rows registros.</p>";
    echo "<ul>";
    foreach ($resultado as $r) {
        $producto = $r;
        echo "<li>Producto $r[nombre]: $r[pvp] euros</li><br>";
    }
    echo "</ul>";
    // Cerramos la conexión
    $conProyecto->close();
} catch (mysqli_sql_exception $e) {
    echo "<p>Error en la base de datos: "
        . htmlspecialchars($e->getMessage()) . "</p>";
}
