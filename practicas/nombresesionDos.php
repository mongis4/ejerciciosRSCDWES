<?php
session_start();

// 1. Cerrar sesión
if (isset($_GET['cerrar'])) {
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params['path'], $params['domain'],
            $params['secure'], $params['httponly']
        );
    }
    session_destroy();
    header('Location: ' . strtok($_SERVER['REQUEST_URI'], '?'));
    exit;
}

$mensaje = '';
$claseAlerta = '';

// 2. Comprobar o iniciar sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $contrasena = trim($_POST['contrasena'] ?? '');

    if ($nombre !== '' && $contrasena !== '') {
        if (isset($_SESSION['nombre']) && $_SESSION['nombre'] === $nombre) {
            $mensaje = 'La sesión ya existe y coincide con <strong>' . htmlspecialchars($nombre) . '</strong>.';
            $claseAlerta = 'alerta-exito';
        } elseif (isset($_SESSION['nombre'])) {
            $mensaje = 'Hay una sesión activa de <strong>' . htmlspecialchars($_SESSION['nombre']) . '</strong> (no coincide).';
            $claseAlerta = 'alerta-aviso';
        } else {
            $_SESSION['nombre'] = $nombre;
            $mensaje = 'Sesión iniciada para <strong>' . htmlspecialchars($nombre) . '</strong>.';
            $claseAlerta = 'alerta-info';
        }
    }
}

$usuarioActivo = $_SESSION['nombre'] ?? null;
session_write_close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Control de sesión</title>
  <link rel="stylesheet" href="estilosesion.css">
</head>
<body>

  <div class="card">
    <h1>Control de sesión</h1>

    <?php if ($mensaje !== ''): ?>
      <div class="alerta <?= $claseAlerta ?>">
        <?= $mensaje ?>
      </div>
    <?php endif; ?>

    <?php if ($usuarioActivo): ?>
      <div class="sesion-activa">
        Sesión actual: <strong><?= htmlspecialchars($usuarioActivo) ?></strong>
      </div>
    <?php endif; ?>

    <form action="" method="POST">
      <div class="grupo-campo">
        <label for="nombre">Usuario</label>
        <input type="text" id="nombre" name="nombre" required>
      </div>

      <div class="grupo-campo">
        <label for="contrasena">Contraseña</label>
        <input type="password" id="contrasena" name="contrasena" required>
      </div>

      <button type="submit" class="btn-primario">Comprobar / Entrar</button>

      <?php if ($usuarioActivo): ?>
        <a href="?cerrar=1" class="btn-cerrar">Cerrar sesión</a>
      <?php endif; ?>
    </form>
  </div>

</body>
</html>



