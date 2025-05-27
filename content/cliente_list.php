<?php
$consulta = "SELECT cliente.nombre as nombreC, cliente.correo, cliente.telefono as id
FROM cliente order by nombreC";
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
    <th>Telefono</th>
    <th>Correo</th>
    <th>
      <a class="botonAñadir" href="../base/index.php?op=31" title="Añadir nuevo">
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
      <td><?= $row['nombreC'] ?></td>
      <td><?= $row['telefono'] ?></td>
      <td><?= $row['correo'] ?></td>
      <td>
        <a class="botonBorrar" href="../base/index.php?op=33&id=<?= $row['id'] ?>" title="Borrar">
          <i class="fas fa-trash-alt"></i>
        </a>
        <a class="botonModificar" href="../base/index.php?op=32&id=<?= $row['id'] ?>" title="Editar">
          <i class="fas fa-pen-to-square"></i>
        </a>
      </td>
    </tr>
  <?php } ?>
</table>