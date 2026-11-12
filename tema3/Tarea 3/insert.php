<?php
require_once 'conexion.php';

if (isset($_POST['Enviar'])) {
    try {
    } catch (Exception $e) {
        echo "Error al insertar . $e";
    }
}
