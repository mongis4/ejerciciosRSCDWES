<?php

echo "<style>
    td{
        border: 1px solid black
    }
    </style>";

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
    //$resultado = $conProyecto->query('SELECT familia, count(*) as total FROM productos GROUP BY familia HAVING total>2 ORDER BY total DESC');
    $resultado = $conProyecto->query('SELECT p.nombre as nombreP, p.pvp, f.nombre FROM productos p, familias f WHERE p.familia=f.cod ORDER BY p.pvp DESC');

    echo "<br> <h2>Resultado de (SELECT p.nombre as nombreP, p.pvp, f.nombre FROM productos p, familias f WHERE p.familia=f.cod ORDER BY p.pvp DESC):</h2>";
    if ($resultado) {

        echo "<table>";
        echo "<thead>";
        echo "<tr><td>Nombre</td><td>PVP</td><td>Nombre familia completo</td></tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($resultado as $r) {

            $producto = $r;
            echo "<tr><td> $r[nombreP]</td><td> $r[pvp]</td><td> $r[nombre]</td></tr>";
            //echo "<tr><td>Producto $r[nombre]</td> <td>$r[pvp] tel</td> </tr>";
        }
        echo "</tbody>";
        echo "</table>";
    }
    $conProyecto->close(); //cerramos la conexión
}
