<?php
//Mostrar los productos y su precio

require_once('conexion.php');

try{
    $sql = 'SELECT nombre, pvp FROM productos ORDER BY pvp';
    $stmt = $conProyecto->query($sql);

    echo '<h1>Consulta mostrar los productos y su precio</h1>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>PVP</th>
                </tr>
            </thead>
        <tbody>';
    foreach($stmt as $producto){
        echo '<tr>' . '<td>' . htmlspecialchars($producto['nombre']) . '</td>' . 
        '<td>' . htmlspecialchars($producto['pvp']) . '</td>' . '</tr>';
    }
    echo '</tbody>
    </table>';

}catch(PDOException $ex){
    die('Error al listar los productos' . $ex->getMessage());
}

