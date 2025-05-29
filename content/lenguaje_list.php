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
$direccion = isset($_GET['dir']) ? strtolower($_GET['dir']) : 'asc';
if (!in_array($direccion, ['asc', 'desc'])) {
  $direccion = 'asc';
}

$consulta = "SELECT lenguaje.id, lenguaje.lenguaje as nombreL 
FROM lenguaje order by $orden $direccion";
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