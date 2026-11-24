<?php
    require_once 'conexion.php';

    if(isset($_POST['enviar'])){
        $modoelegido = $_POST[]
    }

?>
<form name="form1"
    action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
    method="POST">
    <h1>Selecciona un tema</h1>
      <label for="dark">Dark
        <input type="radio" name="tipo" id="dark" value="dark" />
      </label>
      <label for="light">Light
        <input type="radio" name="tipo" id="light" value="light" />
      </label>

      <div class="mt-2">
            <input type="submit"
                    class="btn btn-info mr-3"
                    value="Consultar Stock"
                    name="enviar">
      </div>
</form>



