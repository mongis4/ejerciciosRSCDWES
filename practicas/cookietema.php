<?php
    require_once('conexion.php');

    if(isset($_POST['enviar'])){
        $modoelegido = $_POST['tipo'];
        setCookie("Tipo", $modoelegido, Time() + 3600);
    }
?>
<form name="form1"
    action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
    method="POST">
    <h1>Selecciona un tema</h1>
      <label for="dark">Light
        
      </label><input type="radio" name="tipo" id="dark" value="Dark" />
      <label for="light">Dark
        
      </label><input type="radio" name="tipo" id="light" value="Light" />

      <div class="mt-2">
            <input type="submit"
                    class="btn btn-info mr-3"
                    value="Guardar"
                    name="enviar">
      </div>
</form>

<?php
    if(isset($_COOKIE["Tipo"])){
        echo 'Modo elegido ' . $_COOKIE["Tipo"];

        if($_COOKIE["Tipo"]=="Dark"){
            echo '
                <body style="background-color: black; color: white;"></body>
            ';
        } else {
            echo '
                <body style="background-color: white ; color: black;"></body>
            ';
        }
    }

?>


