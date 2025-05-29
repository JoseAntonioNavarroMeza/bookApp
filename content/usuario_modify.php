<?php
require_once('../base/bd.php');

if (!isset($_GET['username'])) {
    die('Usuario no especificado');
}

$username = addslashes($_GET['username']);
$query = "SELECT username, nombre, password FROM usuario WHERE username = '$username'";
$resultado = bd_consulta($query);

if (!$resultado || mysqli_num_rows($resultado) == 0) {
    die('Usuario no encontrado');
}

$usuario = mysqli_fetch_assoc($resultado);

if (isset($_GET['error'])) {
    $mensajes = [
        'datos' => 'Faltan datos obligatorios',
        'repetido' => 'El nombre ya está registrado'
    ];

    if (isset($mensajes[$_GET['error']])) {
        echo '<script>alert("'.$mensajes[$_GET['error']].'");</script>';
    }
}
?>

<form action="../content/usuario_modify_commit.php" method="post">
  <h2 class="form-header">EDITAR USUARIO</h2>

  <input type="hidden" name="username_original" value="<?= htmlspecialchars($usuario['username']) ?>">

  <div class="dato">
    <div class="etiqueta">
      <label for="username">Usuario:</label>
    </div>
    <div class="control">
      <input type="text" name="username" id="username" readonly value="<?= htmlspecialchars($usuario['username']) ?>">
    </div>
  </div>

  <div class="dato">
    <div class="etiqueta">
      <label for="nombre">Nombre:</label>
    </div>
    <div class="control">
      <input type="text" name="nombre" id="nombre" required value="<?= htmlspecialchars($usuario['nombre']) ?>">
    </div>
  </div>

  <div class="dato">
    <div class="etiqueta">
      <label for="password">Contraseña:</label>
    </div>
    <div class="control">
      <input type="password" name="password" id="password" required value="<?= htmlspecialchars($usuario['password']) ?>">
    </div>
  </div>

  <div class="dato">
    <div class="etiqueta">
      <label>&nbsp;</label>
    </div>
    <div class="control" id="botones">
      <button type="button" onclick="window.location.href='../base/index.php?op=02'">Cancelar</button>
      <button type="submit">Guardar Cambios</button>
    </div>
  </div>
</form>
