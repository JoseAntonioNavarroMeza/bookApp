<?php
require_once('../base/bd.php');

if (isset($_GET['error'])) {
    $mensajes = [
        'asociado' => 'No se puede eliminar, el cliente tiene ventas asociadas',
        'telefono_repetido' => 'El teléfono ya está registrado',
        'correo_repetido' => 'El correo electrónico ya está registrado',
        'telefono_invalido' => 'El teléfono debe tener 10 dígitos numéricos',
        'correo_invalido' => 'El correo electrónico no tiene un formato válido',
        'datos' => 'Faltan datos obligatorios'
    ];
    
    if (isset($mensajes[$_GET['error']])) {
        echo '<script>alert("'.$mensajes[$_GET['error']].'");</script>';
    }
}

// Resto del código permanece igual...
$orden = isset($_GET['orden']) ? $_GET['orden'] : 'nombre';
$permitidos = ['nombre', 'telefono', 'correo'];
if (!in_array($orden, $permitidos)) {
    $orden = 'nombre'; // Valor por defecto
}
$direccion = isset($_GET['dir']) ? $_GET['dir'] : 'asc';
if (!in_array($direccion, ['asc', 'desc'])) {
  $direccion = 'asc';
}

$consulta = "SELECT telefono, nombre, correo
FROM cliente ORDER BY $orden $direccion";
$result = bd_consulta($consulta);
?>

<script type="text/javascript">
  window.onload = function() {
    asociarEventos();

    document.querySelector("th:nth-child(2)").ondblclick = function() {
      ordenarPor("nombre");
    };
    document.querySelector("th:nth-child(3)").ondblclick = function() {
      ordenarPor("telefono");
    };
    document.querySelector("th:nth-child(3)").ondblclick = function() {
      ordenarPor("correo");
    };
  };

  function asociarEventos() {
    var botones = document.getElementsByClassName("botonBorrar");
    for (var f = 0; f < botones.length; f++) {
      botones[f].addEventListener("click", validar);
    }
  }

  function validar(event) {
    if (!confirm("¿Estás seguro de eliminar este cliente?")) {
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
    <th>Teléfono</th>
    <th>Correo</th>
    <th>
      <a class="botonAñadir" href="../base/index.php?op=21" title="Añadir nuevo">
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
      <td><?= htmlspecialchars($row['nombre']) ?></td>
      <td><?= htmlspecialchars($row['telefono']) ?></td>
      <td><?= htmlspecialchars($row['correo']) ?></td>
      <td>
        <a class="botonBorrar" href="../base/index.php?op=23&telefono=<?= $row['telefono'] ?>" title="Borrar">
          <i class="fas fa-trash-alt"></i>
        </a>
        <a class="botonModificar" href="../base/index.php?op=22&telefono=<?= $row['telefono'] ?>" title="Editar">
          <i class="fas fa-pen-to-square"></i>
        </a>
      </td>
    </tr>
  <?php } ?>
</table>