<?php
if (isset($_GET['error'])) {
    if ($_GET['error'] === 'repetido') {
        echo '<script>alert("El registro ya existe, intenta uno diferente");</script>';
    }
}

$orden = isset($_GET['orden']) ? $_GET['orden'] : 'lenguaje.lenguaje';
$permitidos = ['lenguaje.lenguaje']; // nombre real de columna
if (!in_array($orden, $permitidos)) {
  $orden = 'lenguaje.lenguaje';
}
$consulta = "SELECT lenguaje.id, lenguaje.lenguaje as nombreL FROM lenguaje order by lenguaje";
$result = bd_consulta($consulta);
?>
<script type="text/javascript">
  function asociarEventos() {
    var botones = document.getElementsByClassName("botonBorrar");
    for (var f = 0; f < botones.length; f++) {
      var boton = botones[f];
      boton.addEventListener("click", validar);
    }
  }
  function validar(event) {
    if (!confirm("Estas seguro de eliminar este registro?"))
      event.preventDefault();
  }
  window.addEventListener("load", asociarEventos);
</script>
<table>
  <tr>
    <th>#</th>
    <th>Nombre</th>
    <th>
      <a class="botonAñadir" href="../base/index.php?op=71" title="Añadir nuevo">
        <i class="fas fa-plus"></i> <i class="fas fa-book"></i>
      </a>
    </th>
  </tr>
  <?php
  $i = 0;
  while ($row = mysqli_fetch_assoc($result)) {
    $i++;
    ?>
    <tr>
      <td><?= $i ?></td>
      <td><?= $row['nombreL'] ?></td>
      <td>
        <a class="botonBorrar" href="../base/index.php?op=73&id=<?= $row['id'] ?>" title="Borrar">
          <i class="fas fa-trash-alt"></i>
        </a>
        <a class="botonModificar" href="../base/index.php?op=72&id=<?= $row['id'] ?>" title="Editar">
          <i class="fas fa-pen-to-square"></i>
        </a>
      </td>
    </tr>
  <?php } ?>
</table>