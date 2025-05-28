<form class="" action="../content/lenguaje_new_commit.php" method="post">
    <h2 class="form-header">NUEVO LENGUAJE</h2>
  <div class="dato">
    <div class="etiqueta">
      <label for="lenguaje">Lenguaje:</label>
    </div>

    <div class="control">
      <input type="text" name="lenguaje" id="lenguaje" required>
    </div>
  </div>

  <div class="dato">
    <div class="etiqueta">
      <label for="">&nbsp;</label>
    </div>
    <div class="control" id="botones">
      <a href="../base/index.php?op=70">
        <button type="button">Cancelar</button>
      </a>
      <button type="submit" name="button">Enviar</button>
    </div>
  </div>
</form>
<style>
.form-header {
  margin: 20px 0;
  padding: 10px;
  color: #2c3e50;
  border-bottom: 2px solid #3498db;
  text-align: center;
}
</style>

