<?php
$conProyecto = new mysqli('localhost', 'gestor', 'secreto', 'proyecto');
$resultado = $conProyecto->query(
    'SELECT id, nombre FROM productos',
    MYSQLI_USE_RESULT
);
foreach ($resultado as $fila) {
    echo $fila['id'] . " - " . $fila['nombre'] . "<br>";
}
$resultado->free();
$conProyecto->close();
