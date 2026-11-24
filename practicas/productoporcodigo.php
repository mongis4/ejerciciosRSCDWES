<?php
    //Buscar un producto por su código con una consulta preparada
    require_once 'conexion.php';

    $valorid = 2;

    try{
        $sql = 'SELECT nombre FROM productos WHERE id=:id';

    $stmt = $conProyecto->prepare($sql);
    $stmt->execute([
        ':id' => $valorid
    ]);

    $resultado = $stmt->fetch();

    if($resultado){
        echo '<br><br>' . $resultado['nombre'];
    }else{
        echo '<p style="color: #ed0e0e;">' . 'No se ha encontrado ningun producto' . '</p>';
    }
    

    }catch(PDOException $ex){
        die('Error al buscar el producto' . $ex->getMessage());
        $stmt = null;
        $conProyecto = null;
    }finally{
        $stmt = null;
        $conProyecto = null;
    }
?>
