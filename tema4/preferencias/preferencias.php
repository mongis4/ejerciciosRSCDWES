<?php
    session_start();

    $idioma = $_SESSION['preferencias']['idioma'] ?? 'es';
    $perfilpublico = $_SESSION['preferencias']['perfilpublico'] ?? 'si';
    $zonahoraria = $_SESSION['preferencias']['zonahoraria'] ?? 'GMT';

    if(isset($_POST['submit'])){
        $idioma = $_POST['idioma'] ?? 'es';
        $perfilpublico = $_POST['perfil'] ?? 'no';
        $zonahoraria =$_POST['zonahoraria'] ?? 'GMT';

        $_SESSION['preferencias'] = [
        'idioma' => $idioma,
        'perfilpublico' => $perfilpublico,
        'zonahoraria' => $zonahoraria
    ];
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
    <link rel="stylesheet" href="estilo.css">

    <title>Preferencias</title>
</head>
<body class="container-fluid">
<form name="enviar" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="col g-3">
    <h1>Preferencias Usuario</h1>
  <div class="col-auto">
    <label for="idioma" class="visually-hidden">Idioma</label>
    <select class="form-select" aria-label="Default select example" id="idioma">
        <option value="es">Español</option>
        <option value="en">Inglés</option>
    </select>
  </div>
  <div class="col-auto">
    <label for="perfil" class="visually-hidden">Perfil público</label>
    <select class="form-select" aria-label="Default select example" id="perfil">
        <option value="si" <?=$_SESSION['preferencias']['perfilsi'] ?>>Si</option>
        <option value="no" <?=$_SESSION['preferencias']['perfilno'] ?>>No</option>
    </select>
  </div>
  <div class="col-auto">
    <label for="zonahoraria">Zona horaria</label>
    <select class="form-select" aria-label="Default select example" id="zonahoraria">
        <option value="GMT-1">GMT-1</option>
        <option value="GMT-2">GMT-2</option>
        <option value="GMT">GMT</option>
        <option value="GMT+1">GMT+1</option>
        <option value="GMT+2">GMT+2</option>
    </select>
  </div>
  <div class="col-auto">
    <button type="mostrar" class="btn btn-secondary mb-3">Mostrar preferencias</button>
    <button type="submit" class="btn btn-primary mb-3">Establecer preferencias</button>
  </div>
</form>
</body>
</html>