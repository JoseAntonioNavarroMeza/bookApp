<form class="" action="../content/editorial_new_commit.php" method="post">
      <h2 class="form-header">NUEVA EDITORIAL</h2>
  <div class="dato">
    <div class="etiqueta">
      <label for="editorial">Nombre de la editorial:</label>
    </div>

    <div class="control">
      <input type="text" name="editorial" id="editorial" required>
    </div>
  </div>

  <div class="dato">
    <div class="etiqueta">
      <label for="">&nbsp;</label>
    </div>
    <div class="control" id="botones">
      <a href="../base/index.php?op=80">
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

