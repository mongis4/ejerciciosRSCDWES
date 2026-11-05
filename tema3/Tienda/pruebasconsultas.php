
<?php
$conProyecto = new mysqli('localhost', 'gestor', 'secreto', 'proyecto');
$resultado = $conProyecto->query("SELECT id FROM tiendas WHERE nombre = 'SUCURSAL2'");

foreach ($resultado as $fila) {
    echo $fila['id'] . "<br>";
}
$resultado->free();
$conProyecto->close();
