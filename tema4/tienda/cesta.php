
<?php
session_start();

if (!isset($_SESSION['nombre'])) {
    header('Location:login.php');
    exit;
}

require_once 'conexion.php';

if (isset($_SESSION['cesta'])) {

    foreach ($_SESSION['cesta'] as $k => $v) {
        $producto = consultarProducto($k);
        $listado[$k] = [$producto->nombre, $producto->pvp];
        $producto = null;
    }

    cerrar($conProyecto);
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSS para usar Bootstrap -->
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
          crossorigin="anonymous">

    <!-- CSS Fontawesome -->
    <link rel="stylesheet"
          href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
          crossorigin="anonymous">

    <title>Tema 4</title>
</head>

<body style="background: gray;">

    <div class="float-right d-inline-flex mt-2">

        <i class="fa fa-shopping-cart mr-2 fa-2x"></i>

        <?php
        if (isset($_SESSION['cesta'])) {
            $cantidad = count($_SESSION['cesta']);

            echo "<input type='text' disabled
                         class='form-control mr-2 bg-transparent text-white'
                         value='$cantidad' size='2'>";
        } else {
            echo "<input type='text' disabled
                         class='form-control mr-2 bg-transparent text-white'
                         value='0' size='2'>";
        }
        ?>

        <i class="fas fa-user mr-3 fa-2x"></i>

        <input type="text"
               size="10"
               value="<?php echo htmlspecialchars($_SESSION['nombre'], ENT_QUOTES, 'UTF-8'); ?>"
               class="form-control mr-2 bg-transparent text-white"
               disabled>

        <a href="cerrar.php" class="btn btn-warning mr-2">
            Salir
        </a>

    </div>

    <br>

    <h4 class="container text-center mt-4 font-weight-bold">
        Comprar Productos
    </h4>

    <div class="container mt-3">

        <div class="card text-white bg-success mb-3 m-auto"
             style="width:40rem; max-width:100%;">

            <div class="card-body">

                <h5 class="card-title">
                    <i class="fa fa-shopping-cart mr-2"></i>
                    Carrito
                </h5>

                <?php
                if (!isset($_SESSION['cesta']) || empty($_SESSION['cesta'])) {

                    echo "<p class='card-text'>Carrito Vacío</p>";

                } else {

                    $total = 0;

                    echo "<ul>";

                    foreach ($listado as $k => $v) {

                        echo "<li>" .
                             htmlspecialchars($v[0], ENT_QUOTES, 'UTF-8') .
                             ", PVP (" . htmlspecialchars((string)$v[1], ENT_QUOTES, 'UTF-8') .
                             ") €.</li>";

                        $total += $v[1];
                    }

                    echo "</ul>";

                    echo "<hr style='border:none; height:2px; background-color:white'>";

                    echo "<p class='card-text'>
                            <b>Total:</b>
                            <span class='ml-3'>$total (€)</span>
                          </p>";
                }
                ?>

                <a href="listado.php" class="btn btn-primary mr-2">
                    Volver
                </a>

                <a href="pagar.php" class="btn btn-danger">
                    Pagar
                </a>

            </div>
        </div>
    </div>

</body>
</html>
