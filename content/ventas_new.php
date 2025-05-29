<?php
$clientes = bd_consulta("SELECT telefono, nombre FROM cliente");
?>

<form action="../content/ventas_new_commit.php" method="post">
<div class="dato">
  <div class="etiqueta">
    <label for="cliente">Cliente:</label>
  </div>
  <div class="control">
    <select name="cliente_id">
      <?php
      while ($row = mysqli_fetch_assoc($clientes)) {
        echo "<option value='{$row['telefono']}'>{$row['nombre']}</option>";
      }
      ?>
    </select>
  </div>
</div>

<div id="librosCompra">
  <div class="dato libro">
    <div class="bloque-libro">
      <div class="etiqueta">
        <label for="libro_id[]">Libro:</label>
      </div>
      <div class="control">
        <select name="libro_id[]">
          <?php
          $libros = bd_consulta("SELECT id, titulo, stock FROM book");
          while ($row = mysqli_fetch_assoc($libros)) {
            echo "<option value='{$row['id']}'>{$row['titulo']}  (Stock: {$row['stock']})</option>";
          }
          ?>
        </select>
      </div>

      <div class="etiqueta">
        <label for="cantidad[]">Cantidad:</label>
      </div>
      <div class="control">
        <input type="number" name="cantidad[]" min="1" value="1" required>
      </div>
    </div>
  </div>
</div>

<div class="dato">
  <div class="etiqueta">
    <label>&nbsp;</label>
  </div>
  <div class="control">
    <button type="button" onclick="agregarLibroCompra()">Agregar otro libro</button>
  </div>
</div>

<div class="dato">
  <div class="etiqueta">
    <label for="">&nbsp;</label>
  </div>
  <div class="control" id="botones">
    <button type="reset">Cancelar</button>
    <button type="submit">Registrar compra</button>
  </div>
</div>
</form>

<script>
  function agregarLibroCompra() {
    const container = document.getElementById("librosCompra");
    const nuevoLibro = container.firstElementChild.cloneNode(true);
    nuevoLibro.querySelectorAll("input[name='cantidad[]']").forEach(input => input.value = 1);
    container.appendChild(nuevoLibro);
  }
</script>

<style>
.bloque-libro {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  align-items: center;
  margin-bottom: 10px;
  padding: 10px;
  border-radius: 8px;
}

.bloque-libro .etiqueta {
  width: 100%;
  max-width: 150px;
  font-weight: bold;
}

.bloque-libro .control {
  flex: 1;
  min-width: 300px;
}

.bloque-libro select,
.bloque-libro input {
  width: 100%;
  padding: 5px;
  box-sizing: border-box;
}
</style>