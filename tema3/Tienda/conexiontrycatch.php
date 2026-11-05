<?php
try {
    $conProyecto = new mysqli('localhost', 'gestor', 'secreto', 'proyecto');
    echo "Conexión establecida";
} catch (mysqli_sql_exception $e) {
    echo "<p>Error " . $e->getCode() .
        " conectando a la base de datos: " .
        htmlspecialchars($e->getMessage()) . htmlspecialchars("</p>"); //El navegador
    //interpretará las etiquetas y mostrará el texto como un encabezado. Así
    //evitaremos problemas de seguridad
    die();
}
