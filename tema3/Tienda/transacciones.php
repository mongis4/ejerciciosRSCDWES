<?php

try {
    $conProyecto = new mysqli('localhost', 'gestor', 'secreto', 'proyecto');
    echo "<p>Conexión establecida</p>";

    $conProyecto->autocommit(false);

    //compruebo si hay stock en la tienda 1
    $consulta_stock_t1 = "SELECT unidades FROM stocks WHERE tienda = 1 AND producto = 
                            (SELECT id FROM productos WHERE nombre_corto = '3DSNG')";
    $res_ud_t1 = $conProyecto->query($consulta_stock_t1);
    $dato = $res_ud_t1->fetch_assoc();
    echo "Quedan " . $dato['unidades'] . "<br>";

    if ($dato['unidades'] > 0) {

        $cantidad_restar = 1;

        $update = "UPDATE stocks
SET unidades = unidades - $cantidad_restar
WHERE producto = (
SELECT id
FROM productos
WHERE nombre_corto = '3DSNG'
)
AND tienda = 1";

        $conProyecto->query($update);
    } else {
        echo "No queda stock";
        throw new Exception("No hay suficiente stock en tienda de origen");
    }

    // 4. Segunda consulta: UPDATE si ya existe 3DSNG, INSERT si no existe 3DSNG

    $unidades_en_sucursal2 = "SELECT unidades FROM stocks WHERE tienda = 3 
                          AND producto = (SELECT id FROM productos WHERE nombre_corto = '3DSNG')"; //saber si hay registros en SUCURSAL2
    $resultado_ud = $conProyecto->query($unidades_en_sucursal2);
    $fila = $resultado_ud->fetch_assoc();

    //echo "<br>" . $fila;

    echo "<br>";
    if ($fila != null) {

        $update_sucursal_dos = "UPDATE stocks
SET unidades = unidades + $cantidad_restar
WHERE producto = (
SELECT id
FROM productos
WHERE nombre_corto = '3DSNG'
)
AND tienda = 3";

        echo "Se ha hecho UPDATE";
        $conProyecto->query($update_sucursal_dos);
    } else {

        $insert = "INSERT INTO stocks (producto, tienda, unidades)
SELECT id,3, 1
FROM productos
WHERE nombre_corto = '3DSNG'";

        echo "Se ha hecho INSERT";
        $conProyecto->query($insert);
    }

    $consulta_stock_t2 = "SELECT unidades FROM stocks WHERE tienda = 3 AND producto = 
                            (SELECT id FROM productos WHERE nombre_corto = '3DSNG')";
    $res_ud_t2 = $conProyecto->query($consulta_stock_t2);
    $dato2 = $res_ud_t2->fetch_assoc();
    echo "<br><br>Hay " . $dato2['unidades'] . " unidades en la tienda de destino" . "<br>";

    $conProyecto->commit();
    echo "<p>Los cambios se han realizado correctamente.</p>";
} catch (mysqli_sql_exception $e) {
    if (isset($conProyecto)) {
        $conProyecto->rollback();
    }

    echo "<p>No se han podido realizar los cambios.</p>";
    echo "Error $e" . htmlspecialchars($e->getMessage());
} finally {
    if (isset($conProyecto)) {
        $conProyecto->close();
    }
}
