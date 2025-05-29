<?php
require_once('../base/bd.php');

if (!isset($_GET['id'])) {
    die('Proveedor no especificado');
}

$id = $_GET['id'];
$query = "SELECT RFC, nombre, telefono, correo FROM proveedor WHERE RFC = '".addslashes($id)."'";
$resultado = bd_consulta($query);

if (!$resultado || mysqli_num_rows($resultado) == 0) {
    die('Proveedor no encontrado');
}

$proveedor = mysqli_fetch_assoc($resultado);

if (isset($_GET['error'])) {
    $mensajes = [
        'datos' => 'Faltan datos obligatorios',
        'rfc_repetido' => 'El RFC ya está registrado',
        'telefono_repetido' => 'El teléfono ya está registrado',
        'correo_repetido' => 'El correo ya está registrado',
        'telefono_invalido' => 'El teléfono debe tener 10 dígitos',
        'correo_invalido' => 'El correo electrónico no es válido',
        'rfc_invalido' => 'El RFC no tiene un formato válido'
    ];
    
    if (isset($mensajes[$_GET['error']])) {
        echo '<script>alert("'.$mensajes[$_GET['error']].'");</script>';
    }
}
?>

<form action="../content/proveedores_modify_commit.php" method="post">
  <h2 class="form-header">EDITAR PROVEEDOR</h2>

  <input type="hidden" name="rfc_original" value="<?= htmlspecialchars($proveedor['RFC']) ?>">

  <div class="dato">
    <div class="etiqueta">
      <label for="rfc">RFC:</label>
    </div>
    <div class="control">
      <input type="text" name="rfc" id="rfc" readonly value="<?= htmlspecialchars($proveedor['RFC']) ?>">
    </div>
  </div>

  <div class="dato">
    <div class="etiqueta">
      <label for="nombre">Nombre:</label>
    </div>
    <div class="control">
      <input type="text" name="nombre" id="nombre" required value="<?= htmlspecialchars($proveedor['nombre']) ?>">
    </div>
  </div>

  <div class="dato">
    <div class="etiqueta">
      <label for="telefono">Teléfono:</label>
    </div>
    <div class="control">
      <input type="tel" name="telefono" id="telefono" required pattern="[0-9]{10}" value="<?= htmlspecialchars($proveedor['telefono']) ?>">
    </div>
  </div>

  <div class="dato">
    <div class="etiqueta">
      <label for="correo">Correo:</label>
    </div>
    <div class="control">
      <input type="email" name="correo" id="correo" required value="<?= htmlspecialchars($proveedor['correo']) ?>">
    </div>
  </div>

  <div class="dato">
    <div class="etiqueta">
      <label>&nbsp;</label>
    </div>
    <div class="control" id="botones">
      <button type="button" onclick="window.location.href='../base/index.php?op=30'">Cancelar</button>
      <button type="submit">Guardar Cambios</button>
    </div>
  </div>
</form>
