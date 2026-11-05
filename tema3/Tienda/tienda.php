<?php

// Otra opcion: utilizando el método connect
//$conProyecto = new mysqli();
//$conProyecto->connect('localhost', 'gestor', 'secreto', 'proyecto');

try {
    // instancia de la clase mysqli
    $conProyecto = new mysqli('localhost', 'gestor', 'secreto', 'proyecto');
    echo "Conexión establecida";
} catch (mysqli_sql_exception $e) {
    echo "<p>Error " . $e->getCode() .
        " conectando a la base de datos: " .
        htmlspecialchars($e->getMessage()) . "</p>"; //El navegador
    //interpretará las etiquetas y mostrará el texto como un encabezado. Así
    //evitaremos problemas de seguridad
    die();
}

$error = $conProyecto->connect_errno;
if ($error == null) {
    $resultado = $conProyecto->query('DELETE FROM stock WHERE unidades=0');
    if ($resultado) {
        echo "<p>Se han borrado $conProyecto->affected_rows registros.</p>";
    }
    $conProyecto->close(); //cerramos la conexión
}
