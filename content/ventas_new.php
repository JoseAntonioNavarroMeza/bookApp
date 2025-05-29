<?php
  $clientes = bd_consulta("SELECT telefono, nombre FROM cliente");
?>
<form action="../content/ventas_new_commit.php" method="post">

  <div class="dato">
    <div class="etiqueta">
      <label for="cliente">Cliente:</label>
    </div>
    <div class="control">
      <select name="cliente_id" required>
        <?php
        while ($row = mysqli_fetch_assoc($clientes)) {
          echo "<option value='{$row['telefono']}'>{$row['nombre']}</option>";
        }
        ?>
      </select>
    </div>
  </div>

  <div id="librosVenta">
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
              echo "<option value='{$row['id']}'>{$row['titulo']} (Stock: {$row['stock']})</option>";
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

        <div class="etiqueta">
          <label for="precio_unitario[]">Precio unitario:</label>
        </div>
        <div class="control">
          <input type="number" name="precio_unitario[]" min="0" value="0" required>
        </div>
      </div>
    </div>
  </div>

  <div class="dato">
    <div class="etiqueta">
      <label>&nbsp;</label>
    </div>
    <div class="control">
      <button type="button" onclick="agregarLibroVenta()">Agregar otro libro</button>
    </div>
  </div>

  <div class="dato">
    <div class="etiqueta">
      <label for="">&nbsp;</label>
    </div>
    <div class="control" id="botones">
      <button type="reset">Cancelar</button>
      <button type="submit">Registrar venta</button>
    </div>
  </div>
</form>

<script>
  function agregarLibroVenta() {
    const container = document.getElementById("librosVenta");
    const nuevoLibro = container.firstElementChild.cloneNode(true);

    // Limpiar inputs cantidad y precio_unitario
    nuevoLibro.querySelectorAll("input").forEach(input => {
      input.value = input.name.includes("cantidad") ? 1 : 0;
    });

    // Limpiar select para que quede en la primera opción
    nuevoLibro.querySelectorAll("select").forEach(select => {
      select.selectedIndex = 0;
    });

    container.appendChild(nuevoLibro);
  }
</script>

<style>
  .dato.libro {
    width: 100%;
    margin-bottom: 15px;
  }

  .bloque-libro {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    align-items: center;
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
