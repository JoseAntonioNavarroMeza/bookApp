<style>
.form-header {
  margin: 20px 0;
  padding: 10px;
  color: #2c3e50;
  border-bottom: 2px solid #3498db;
  text-align: center;
}
</style>
<form class="" action="../content/pais_new_commit.php" method="post">
  <h2 class="form-header">NUEVO PAÍS</h2>
  
  <div class="dato">
    <div class="etiqueta">
      <label for="nombre">Nombre del país:</label>
    </div>
    <div class="control">
      <input type="text" name="nombre" id="nombre" required>
    </div>
  </div>
  
  <div class="dato">
    <div class="etiqueta">
      <label for="">&nbsp;</label>
    </div>
    <div class="control" id="botones">
      <button type="button" onclick="window.location.href='../base/index.php?op=60'">Cancelar</button>
      <button type="submit">Enviar</button>
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