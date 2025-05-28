<?php
require_once('../base/bd.php');

if (isset($_GET['error'])) {
    if ($_GET['error'] === 'repetido') {
        echo '<script>alert("El autor ya existe, intenta uno diferente");</script>';
    } elseif ($_GET['error'] === 'asociado') {
        echo '<script>alert("No se puede eliminar, el autor tiene libros asociados");</script>';
    }
}

// Get countries for dropdown
$paises_query = "SELECT id, nombre FROM pais ORDER BY nombre";
$paises_result = bd_consulta($paises_query);
?>

<form class="" action="../content/autores_new_commit.php" method="post">
  <h2 class="form-header">NUEVO AUTOR</h2>
  
  <div class="dato">
    <div class="etiqueta">
      <label for="nombre">Nombre del autor:</label>
    </div>
    <div class="control">
      <input type="text" name="nombre" id="nombre" required>
    </div>
  </div>
  
  <div class="dato">
    <div class="etiqueta">
      <label for="nacionalidad">Nacionalidad:</label>
    </div>
    <div class="control">
      <select name="nacionalidad" id="nacionalidad" required>
        <option value="">Seleccione un país</option>
        <?php while ($pais = mysqli_fetch_assoc($paises_result)) { ?>
          <option value="<?= $pais['id'] ?>"><?= $pais['nombre'] ?></option>
        <?php } ?>
      </select>
    </div>
  </div>
  
  <div class="dato">
    <div class="etiqueta">
      <label >&nbsp;</label>
    </div>
    <div class="control" id="botones">
      <button type="button" onclick="window.location.href='../base/index.php?op=90'">Cancelar</button>
      <button type="submit">Enviar</button>
    </div>
  </div>
</form>