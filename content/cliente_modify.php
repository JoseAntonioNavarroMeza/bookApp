<?php
require_once('../base/bd.php');

if (!isset($_GET['telefono'])) {
    echo '<script>alert("No se especificó el cliente a editar."); window.location.href="../base/index.php?op=20";</script>';
    exit;
}

$telefono = $_GET['telefono'];
$query = "SELECT * FROM cliente WHERE telefono = '".mysqli_real_escape_string(mysqli_connect("127.0.0.1", "root", "", "books"), $telefono)."'";
$result = bd_consulta($query);
$cliente = mysqli_fetch_assoc($result);

if (!$cliente) {
    echo '<script>alert("Cliente no encontrado."); window.location.href="../base/index.php?op=20";</script>';
    exit;
}
?>

<form action="../content/cliente_modify_commit.php" method="post">
  <h2 class="form-header">EDITAR CLIENTE</h2>

  <input type="hidden" name="telefono_original" value="<?= htmlspecialchars($cliente['telefono']) ?>">

  <div class="dato">
    <div class="etiqueta">
      <label for="nombre">Nombre:</label>
    </div>
    <div class="control">
      <input type="text" name="nombre" id="nombre" required value="<?= htmlspecialchars($cliente['nombre']) ?>">
    </div>
  </div>

  <div class="dato">
    <div class="etiqueta">
      <label for="telefono">Teléfono:</label>
    </div>
    <div class="control">
      <input type="tel" name="telefono" id="telefono" required pattern="[0-9]{10}" value="<?= htmlspecialchars($cliente['telefono']) ?>">
    </div>
  </div>

  <div class="dato">
    <div class="etiqueta">
      <label for="correo">Correo:</label>
    </div>
    <div class="control">
      <input type="email" name="correo" id="correo" required value="<?= htmlspecialchars($cliente['correo']) ?>">
    </div>
  </div>

  <div class="dato">
    <div class="etiqueta">
      <label>&nbsp;</label>
    </div>
    <div class="control" id="botones">
      <button type="button" onclick="window.location.href='../base/index.php?op=20'">Cancelar</button>
      <button type="submit">Guardar Cambios</button>
    </div>
  </div>
</form>
