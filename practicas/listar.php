<?php
require_once('conexion.php');

try {
    $query = 'SELECT DISTINCT cod, nombre FROM familias ORDER BY nombre ASC';

    $consulta = $conProyecto->query($query);
    echo '<br>' . "hola";
    echo '<ul>';

    foreach ($consulta as $familia) {
        echo '<li>' . htmlspecialchars($familia['cod']) . ' ' . htmlspecialchars($familia['nombre']) . '</li>';
    }

    echo '</ul>';
} catch (PDOException $ex) {
    die('Error al realizar la consulta: ' . $ex->getMessage());
} finally {
    $conProyecto = null;
}
