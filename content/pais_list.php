<?php
$orden = isset($_GET['orden']) ? $_GET['orden'] : 'nombre';
$permitidos = ['nombre']; // puedes agregar más si se desea ordenar por otros campos
if (!in_array($orden, $permitidos)) {
  $orden = 'nombre';
}

$consulta = "SELECT pais.id, pais.nombre as nombreP FROM pais order by $orden";
$result = bd_consulta($consulta);
?>
<script type="text/javascript">
  window.onload = function () {
    asociarEventos();

    document.querySelector("th:nth-child(2)").ondblclick = () => ordenarPor("nombre");
  };

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

  function ordenarPor(campo) {
    const url = new URL(window.location);
    url.searchParams.set('orden', campo);
    window.location = url;
  }
</script>
<table>
  <tr>
    <th>#</th>
    <th>Nombre</th>
    <th>
      <a class="botonAñadir" href="../base/index.php?op=61" title="Añadir nuevo">
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
      <td><?= $row['nombreP'] ?></td>
      <td>
        <a class="botonBorrar" href="../base/index.php?op=63&id=<?= $row['id'] ?>" title="Borrar">
          <i class="fas fa-trash-alt"></i>
        </a>
        <a class="botonModificar" href="../base/index.php?op=62&id=<?= $row['id'] ?>" title="Editar">
          <i class="fas fa-pen-to-square"></i>
        </a>
      </td>
    </tr>
  <?php } ?>
</table>