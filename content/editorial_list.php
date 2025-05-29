<?php
if (isset($_GET['error'])) {
    $mensajes = [
        'repetido' => 'El registro ya existe, intenta uno diferente',
        'asociado' => 'No se puede eliminar la editorial porque tiene libros asociados',
        'borrado' => 'Error al intentar borrar la editorial'
    ];

    if (isset($mensajes[$_GET['error']])) {
        echo '<script>alert("' . $mensajes[$_GET['error']] . '");</script>';
    }
}



$orden = isset($_GET['orden']) ? $_GET['orden'] : 'editorial.editorial';
$permitidos = ['editorial.editorial']; // nombre real de columna
if (!in_array($orden, $permitidos)) {
  $orden = 'editorial.editorial';
}
$direccion = isset($_GET['dir']) ? strtolower($_GET['dir']) : 'asc';
if (!in_array($direccion, ['asc', 'desc'])) {
  $direccion = 'asc';
}

$consulta = "SELECT editorial.id, editorial.editorial as nombreE 
FROM editorial order by $orden $direccion";
$result = bd_consulta($consulta);
?>
<script type="text/javascript">
  window.onload = function () {
    asociarEventos();

    // Agrega orden descendente/ascendente alternando con doble click
    document.querySelector("th:nth-child(2)").ondblclick = () => ordenarPor("nombreE");
  };
  function ordenarPor(campo) {
    const url = new URL(window.location);
    const currentOrden = url.searchParams.get('orden');
    const currentDir = url.searchParams.get('dir') || 'asc';

    if (currentOrden === campo) {
      // Alterna la dirección
      const nuevaDir = currentDir === 'asc' ? 'desc' : 'asc';
      url.searchParams.set('dir', nuevaDir);
    } else {
      url.searchParams.set('orden', campo);
      url.searchParams.set('dir', 'asc');  // Por defecto asc
    }

    window.location = url;
  }
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
</script>
<table>
  <tr>
    <th>#</th>
    <th>Nombre</th>
    <th>
      <a class="botonAñadir" href="../base/index.php?op=81" title="Añadir nuevo">
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
      <td><?= $row['nombreE'] ?></td>
      <td>
        <a class="botonBorrar" href="../base/index.php?op=83&id=<?= $row['id'] ?>" title="Borrar">
          <i class="fas fa-trash-alt"></i>
        </a>
        <a class="botonModificar" href="../base/index.php?op=82&id=<?= $row['id'] ?>" title="Editar">
          <i class="fas fa-pen-to-square"></i>
        </a>
      </td>
    </tr>
  <?php } ?>
</table>