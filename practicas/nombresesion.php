<?php
    session_start();

    $mensaje = "";
    if (isset($_POST['submit'])) {
    if (!empty($_POST['nombre']) && !empty($_POST['contrasena'])) {
        $nombre = $_POST['nombre'];
        $contrasena = $_POST['contrasena'];

        // Comprobar si ya existe la sesión y coincide con el usuario introducido
        if (isset($_SESSION['nombre']) && $_SESSION['nombre'] === $nombre) {
            $mensaje = '<div class="alert alert-success">La sesión ya existía y coincide con el usuario.</div>';
        } else {
            // Si no existía o era otro usuario, guardamos la nueva sesión
            $_SESSION['nombre'] = $nombre;
            $_SESSION['contrasena'] = $contrasena;
            $mensaje = '<div class="alert alert-info">Nueva sesión iniciada para ' . htmlspecialchars($nombre) . '.</div>';
        }
    }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>
    <main>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-sm-8 col-md-5 col-lg-4">
            <div class="card shadow-sm border-0">
              <div class="card-body p-4">
                <h1 class="h4 mb-4 text-center">Iniciar sesión</h1>
                <form
                  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
                  method="POST"
                >
                  <div class="mb-3">
                    <label for="usuario" class="form-label">Usuario</label>
                    <input
                      type="text"
                      class="form-control"
                      id="usuario"
                      name="usuario"
                      placeholder="Introduce tu usuario"
                      required
                    />
                  </div>
                  <div class="mb-3">
                    <label for="contrasena" class="form-label"
                      >Contraseña</label
                    >
                    <input
                      type="password"
                      class="form-control"
                      id="contrasena"
                      name="contrasena"
                      placeholder="Introduce tu contraseña"
                      required
                    />
                  </div>
                  <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                      Entrar
                    </button>
                  </div>
                </form>
              </div>
              <p><?= $mensaje?></p>
            </div>
          </div>
        </div>
      </div>
    </main>
  </body>
</html>
