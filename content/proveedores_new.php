<?php
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

<form class="" action="../content/proveedores_new_commit.php" method="post">
  <h2 class="form-header">NUEVO PROVEEDOR</h2>
  
  <div class="dato">
    <div class="etiqueta">
      <label for="rfc">RFC:</label>
    </div>
    <div class="control">
      <input type="text" name="rfc" id="rfc" required maxlength="13" pattern="[A-Za-z0-9]{12,13}">
    </div>
  </div>
  
  <div class="dato">
    <div class="etiqueta">
      <label for="nombre">Nombre:</label>
    </div>
    <div class="control">
      <input type="text" name="nombre" id="nombre" required>
    </div>
  </div>
  
  <div class="dato">
    <div class="etiqueta">
      <label for="telefono">Teléfono:</label>
    </div>
    <div class="control">
      <input type="tel" name="telefono" id="telefono" required pattern="[0-9]{10}">
    </div>
  </div>
  
  <div class="dato">
    <div class="etiqueta">
      <label for="correo">Correo:</label>
    </div>
    <div class="control">
      <input type="email" name="correo" id="correo" required>
    </div>
  </div>
  
  <div class="dato">
    <div class="etiqueta">
      <label >&nbsp;</label>
    </div>
    <div class="control" id="botones">
      <button type="button" onclick="window.location.href='../base/index.php?op=30'">Cancelar</button>
      <button type="submit">Enviar</button>
    </div>
  </div>
</form>