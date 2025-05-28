<?php
require_once('../base/bd.php');

if (isset($_GET['error'])) {
    if ($_GET['error'] === 'asociado') {
        echo '<script>alert("No se puede eliminar, el cliente tiene ventas asociadas");</script>';
    } elseif ($_GET['error'] === 'repetido') {
        echo '<script>alert("El teléfono ya está registrado");</script>';
    }
}

$orden = isset($_GET['orden']) ? $_GET['orden'] : 'nombre';
$direccion = isset($_GET['dir']) ? $_GET['dir'] : 'asc';

$consulta = "SELECT username, nombre FROM usuario ORDER BY $orden";
$result = bd_consulta($consulta);
?>

<script type="text/javascript">
  window.onload = function() {
    asociarEventos();

    document.querySelector("th:nth-child(2)").ondblclick = function() {
      ordenarPor("username");
    };
    
    document.querySelector("th:nth-child(3)").ondblclick = function() {
      ordenarPor("nombre");
    };
  };

  function asociarEventos() {
    var botones = document.getElementsByClassName("botonBorrar");
    for (var f = 0; f < botones.length; f++) {
      botones[f].addEventListener("click", validar);
    }
  }

  function validar(event) {
    if (!confirm("¿Estás seguro de eliminar este usuario?")) {
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
    <th>Usuario</th>
    <th>Nombre</th>
    <th>
      <a class="botonAñadir" href="../base/index.php?op=03" title="Añadir nuevo">
        <i class="fas fa-plus"></i> <i class="fas fa-user"></i>
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
      <td><?= htmlspecialchars($row['username']) ?></td>
      <td><?= htmlspecialchars($row['nombre']) ?></td>
      <td>
        <a class="botonBorrar" href="../base/index.php?op=05&username=<?= $row['username'] ?>" title="Borrar">
          <i class="fas fa-trash-alt"></i>
        </a>
        <a class="botonModificar" href="../base/index.php?op=04&username=<?= $row['username'] ?>" title="Editar">
          <i class="fas fa-pen-to-square"></i>
        </a>
      </td>
    </tr>
  <?php } ?>
</table>