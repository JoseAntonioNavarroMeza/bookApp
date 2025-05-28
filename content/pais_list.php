<?php
if (isset($_GET['error'])) {
    if ($_GET['error'] === 'repetido') {
        echo '<script>alert("El registro ya existe, intenta uno diferente");</script>';
    }
}

$orden = isset($_GET['orden']) ? $_GET['orden'] : 'pais.nombre';
$permitidos = ['pais.nombre']; // nombre real de columna
if (!in_array($orden, $permitidos)) {
  $orden = 'pais.nombre';
}

$consulta = "SELECT pais.id, pais.nombre AS nombreP FROM pais ORDER BY $orden";
$result = bd_consulta($consulta);
?>

<?php
$orden = isset($_GET['orden']) ? $_GET['orden'] : 'pais.nombre';
$permitidos = ['pais.nombre'];
if (!in_array($orden, $permitidos)) {
  $orden = 'pais.nombre';
}

$direccion = isset($_GET['dir']) ? strtolower($_GET['dir']) : 'asc';
if (!in_array($direccion, ['asc', 'desc'])) {
  $direccion = 'asc';
}

$consulta = "SELECT pais.id, pais.nombre AS nombreP FROM pais ORDER BY $orden $direccion";
$result = bd_consulta($consulta);
?>
<script type="text/javascript">
  window.onload = function () {
    asociarEventos();

    document.querySelector("th:nth-child(2)").ondblclick = function () {
      ordenarPor("pais.nombre");
    };
  };

  function asociarEventos() {
    var botones = document.getElementsByClassName("botonBorrar");
    for (var f = 0; f < botones.length; f++) {
      botones[f].addEventListener("click", validar);
    }
  }

  function validar(event) {
    if (!confirm("¿Estás seguro de eliminar este registro?")) {
      event.preventDefault();
    }
  }

  function ordenarPor(campo) {
    const url = new URL(window.location);
    const currentOrden = url.searchParams.get('orden');
    const currentDir = url.searchParams.get('dir') || 'asc';

    if (currentOrden === campo) {
      const nuevaDir = currentDir === 'asc' ? 'desc' : 'asc';
      url.searchParams.set('dir', nuevaDir);
    } else {
      url.searchParams.set('orden', campo);
      url.searchParams.set('dir', 'asc');
    }

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
