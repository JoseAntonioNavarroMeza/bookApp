<?php
require_once('../base/bd.php');

if (isset($_GET['error'])) {
    if ($_GET['error'] === 'asociado') {
        echo '<script>alert("No se puede eliminar, el autor tiene libros asociados");</script>';
    } elseif ($_GET['error'] === 'repetido') {
        echo '<script>alert("El autor ya existe, intenta uno diferente");</script>';
    }
}

// Sorting parameters
$orden = isset($_GET['orden']) ? $_GET['orden'] : 'autor.nombre';
$permitidos = ['autor.nombre', 'pais.nombre']; // Allowed columns
if (!in_array($orden, $permitidos)) {
    $orden = 'autor.nombre';
}

$direccion = isset($_GET['dir']) ? strtolower($_GET['dir']) : 'asc';
if (!in_array($direccion, ['asc', 'desc'])) {
    $direccion = 'asc';
}

$consulta = "SELECT autor.id, autor.nombre AS nombreA, pais.nombre AS nombre_pais 
             FROM autor INNER JOIN pais ON autor.nacionalidad = pais.id 
             ORDER BY $orden $direccion";
$result = bd_consulta($consulta);
?>

<script type="text/javascript">
  window.onload = function() {
    asociarEventos();

    // Set up sorting for columns
    document.querySelector("th:nth-child(2)").ondblclick = function() {
      ordenarPor("autor.nombre");
    };
    
    document.querySelector("th:nth-child(3)").ondblclick = function() {
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
    <th>Nacionalidad</th>
    <th>
      <a class="botonAñadir" href="../base/index.php?op=91" title="Añadir nuevo">
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
      <td><?= htmlspecialchars($row['nombreA']) ?></td>
      <td><?= htmlspecialchars($row['nombre_pais']) ?></td>
      <td>
        <a class="botonBorrar" href="../base/index.php?op=93&id=<?= $row['id'] ?>" title="Borrar">
          <i class="fas fa-trash-alt"></i>
        </a>
        <a class="botonModificar" href="../base/index.php?op=92&id=<?= $row['id'] ?>" title="Editar">
          <i class="fas fa-pen-to-square"></i>
        </a>
      </td>
    </tr>
  <?php } ?>
</table>