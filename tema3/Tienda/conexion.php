<?php
// 2. Conexión utilizando funciones (estilo procedimental)
$conexion = mysqli_connect('localhost', 'gestor', 'secreto', 'proyecto');

echo "<h3>Conexión procedimental</h3>";
echo "Versión del servidor: " . mysqli_get_server_info($conexion);

mysqli_close($conexion);
