

<?php

    if(isset($_POST['enviar'])){
        $modoelegido = $_POST['tipo'];
        setCookie("Tipo", $modoelegido, Time() + 3600);
        $_COOKIE['Tipo'] = $modoelegido;
    }
?>
<?php
    if(isset($_COOKIE['Tipo'])){
        echo 'Modo elegido ' . $_COOKIE["Tipo"];

        if($_COOKIE['Tipo']=="Dark"){
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
<form name="form1"
    action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
    method="POST">
    <h1>Selecciona un tema</h1>
      <select name="tipo" id="tipo">
          <option value="Dark">Dark</option>
          <option value="Light">Light</option>
        </select>
        <input type="submit" class="btn btn-info mr-3" value="Guardar" name="enviar">
</form>


