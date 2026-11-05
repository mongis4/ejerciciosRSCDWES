<?php
try {
    // Conectamos a la base de datos
    $conProyecto = new mysqli('localhost', 'gestor', 'secreto', 'proyecto');
    // Definimos el límite de unidades
    $limite = 5;

    $stmt = $conProyecto->stmt_init();

    // Preparamos la consulta
    $stmt = $conProyecto->prepare(
        'SELECT producto, unidades FROM stocks WHERE unidades < ?'
    );
    // Asociamos el parámetro y ejecutamos
    $stmt->bind_param('i', $limite);
    $stmt->execute();
    // Asociamos las columnas a las variables
    $stmt->bind_result($producto, $unidades);
    // Mostramos los resultados
    while ($stmt->fetch()) {
        echo "<p>Producto $producto: $unidades unidades.</p>";
    }
    // Cerramos
    $stmt->close();
    $conProyecto->close();
} catch (mysqli_sql_exception $e) {
    echo "<p>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
}
