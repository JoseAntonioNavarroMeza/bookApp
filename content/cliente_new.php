<?php
if (isset($_GET['error'])) {
    if ($_GET['error'] === 'repetido') {
        echo '<script>alert("El teléfono ya está registrado");</script>';
    } elseif ($_GET['error'] === 'datos') {
        echo '<script>alert("Faltan datos obligatorios");</script>';
    }
}
?>

<form class="" action="../content/cliente_new_commit.php" method="post">
  <h2 class="form-header">NUEVO CLIENTE</h2>
  
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
      <input type="tel" name="telefono" id="telefono" required>
    </div>
  </div>
  
  <div class="dato">
    <div class="etiqueta">
      <label for="correo">Correo:</label>
    </div>
    <div class="control">
      <input type="email" name="correo" id="correo">
    </div>
  </div>
  
  <div class="dato">
    <div class="etiqueta">
      <label >&nbsp;</label>
    </div>
    <div class="control" id="botones">
      <button type="button" onclick="window.location.href='../base/index.php?op=20'">Cancelar</button>
      <button type="submit">Enviar</button>
    </div>
  </div>
</form>