<?php
$consulta = "SELECT * from book";
$result = bd_consulta($consulta);
/*
$consulta="SELECT id, tipo from tipo";
$result=bd_consulta($consulta);
$consulta2="SELECT id, nombre FROM autor";
$result2=bd_consulta($consulta2);
$consulta3="SELECT id, editorial FROM editorial";
$result3=bd_consulta($consulta3);
$consulta4="SELECT id, lenguaje FROM lenguaje";
$result4=bd_consulta($consulta4);
$consulta5="SELECT id, nombre FROM pais";
$result5=bd_consulta($consulta5);
*/

?>

<!DOCTYPE html>
<html dir="ltr" lang="es">

<head>
  <meta charset="utf-8">
  <title>Captura</title>
  <link rel="stylesheet" href="estilo_libro.css">
</head>

<body>
  <header>
    <h1>Formulario de Captura</h1>
    <h2>Libros</h2>
  </header>
  <form class="" action="index.html" method="post">

    <div class="dato">
      <div class="etiqueta">
        <label for="titulo">Titulo del libro:</label>
      </div>

      <div class="control">
        <input type="text" name="titulo" value="">
      </div>
    </div>


    <div class="dato">
      <div class="etiqueta">
        <label for="tipo">Tipo de libro de acuerdo al contenido:</label>
      </div>
      <div class="control">
        <select class="" name="tipo">
          <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <option value="<?= $row['id'] ?>"><?= $row['tipo'] ?></option>
          <?php } ?>
        </select>
      </div>
    </div>

    <div class="dato">
      <div class="etiqueta">
        <label for="numpagina">Número de página:</label>
      </div>
      <div class="control">
        <input id="numpagina" type="number" name="numpagina" min="10" value="10">
      </div>
    </div>
    <div class="dato">
      <div class="etiqueta">
        <label for="titulo">Autor:</label>
      </div>
      <select class="" name="Autor">
        <?php while ($row = mysqli_fetch_assoc($result2)) { ?>
          <option value="<?= $row['id'] ?>"><?= $row['nombre'] ?></option>
        <?php } ?>
      </select>
    </div>
    <div class="dato">
      <div class="etiqueta">
        <label for="editorial">Editorial:</label>
      </div>
      <select class="" name="editorial">
        <?php while ($row = mysqli_fetch_assoc($result3)) { ?>
          <option value="<?= $row['id'] ?>"><?= $row['editorial'] ?></option>
        <?php } ?>
      </select>
    </div>
    <div class="dato">
      <div class="etiqueta">
        <label for="titulo">ISBN:</label>
      </div>
      <div class="control">
        <input type="text" name="titulo" value="">
      </div>
    </div>
    <div class="dato">
      <div class="etiqueta">
        <label for="pais">País de origen:</label>
      </div>
      <div class="control">
        <select class="" name="pais">
          <?php while ($row = mysqli_fetch_assoc($result5)) { ?>
            <option value="<?= $row['id'] ?>"><?= $row['nombre'] ?></option>
          <?php } ?>
        </select>
      </div>
    </div>

    <div class="dato">
      <div class="etiqueta">
        <label for="dimension">Dimensiónes del libro (cm):</label>
      </div>
      <div class="control">
        <select class="" name="dimension">
          <option value="1">A4 21 x 29.7</option>
          <option value="2" selected>17 x 24</option>
          <option value="3">15.24 x 22.86</option>
          <option value="4">13.97 x 21.59</option>
          <option value="5">14.8 x 21</option>
          <option value="6">13.97 x 21.59</option>
          <option value="7">11 x 17</option>
          <option value="99">Otro</option>
        </select>
      </div>
    </div>
    <div class="dato">
      <div class="etiqueta">
        <label for="lenguaje">Idioma:</label>
      </div>
      <div class="control">
        <select class="" name="idioma">
          <?php while ($row = mysqli_fetch_assoc($result4)) { ?>
            <option value="<?= $row['id'] ?>"><?= $row['lenguaje'] ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="dato">
      <div class="etiqueta">
        <label for="portada">Imagen de la portada:</label>
      </div>
      <div class="control">
        <!-- <button type="button" name="button">Elige Archivo</button> -->
        <input type="file" id="filebutton" name="portada" value="" accept="image/x-png, image/jpeg">
      </div>
    </div>
    <div class="dato">
      <div class="etiqueta">
        <label for="contraportada">Imagen de la contraportada:</label>
      </div>
      <div class="control">
        <input type="file" name="contraportada" value="" accept="image/x-png, image/jpeg">
      </div>
    </div>

    <div class="dato">
      <div class="etiqueta">
        <label for="sobrecubierta">El libro tiene sobrecubierta:</label>
      </div>
      <div class="control" id="sobrecubierta">
        <input type="checkbox" name="sobrecubierta" checked>
      </div>
    </div>



    <div class="dato">
      <div class="etiqueta">
        <label for="tipo_pasta">Pasta suave:</label>
      </div>
      <div class="control" id="tipo_pasta">
        <input type="radio" name="tipo_pasta" value="1" checked>
      </div>
    </div>
    <div class="dato">
      <div class="etiqueta">
        <label for="tipo_pasta">Pasta dura:</label>
      </div>
      <div class="control" id="tipo_pasta">
        <input type="radio" name="tipo_pasta" value="2">
      </div>
    </div>

    <div class="dato">
      <div class="etiqueta">
        <label for="resumen">Resumen del libro:</label>
      </div>
      <div class="control">
        <textarea name="resumen" rows="4" cols="30"></textarea>
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
</body>

</html>