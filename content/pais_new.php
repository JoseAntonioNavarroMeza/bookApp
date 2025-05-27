<style media="screen">
  #imgPortada,
  #imgContraPortada {
    display: inline-block;
    width: 100px;
  }

  #numpagina,
  #tipo_pasta,
  #sobrecubierta {
    width: 15%;
  }

  .archivos {
    width: 50%
  }
</style>
<form class="" action="../content/pais_new_commit.php" method="post">
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
      <button type="reset" name="button">Cancelar</button>
      <button type="submit" name="button">Enviar</button>
    </div>
  </div>
</form>
