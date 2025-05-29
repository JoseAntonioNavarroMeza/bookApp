<?php
require_once('../base/bd.php');

if (isset($_GET['error'])) {
    $mensajes = [
        'asociado' => 'No se puede eliminar, el proveedor tiene productos asociados',
        'rfc_repetido' => 'El RFC ya está registrado',
        'telefono_repetido' => 'El teléfono ya está registrado',
        'correo_repetido' => 'El correo electrónico ya está registrado',
        'datos' => 'Faltan datos obligatorios'
    ];
    
    if (isset($mensajes[$_GET['error']])) {
        echo '<script>alert("'.$mensajes[$_GET['error']].'");</script>';
    }
}

$orden = isset($_GET['orden']) ? $_GET['orden'] : 'rfc';
$permitidos = ['rfc','nombre', 'telefono', 'correo'];
if (!in_array($orden, $permitidos)) {
    $orden = 'rfc'; // Valor por defecto
}
$direccion = isset($_GET['dir']) ? $_GET['dir'] : 'asc';
if (!in_array($direccion, ['asc', 'desc'])) {
  $direccion = 'asc';
}
$consulta = "SELECT proveedor.rfc as id, proveedor.correo, proveedor.telefono, proveedor.nombre as nombreP 
             FROM proveedor ORDER BY $orden $direccion";
$result = bd_consulta($consulta);
?>

<script type="text/javascript">
  function asociarEventos() {
    var botones = document.getElementsByClassName("botonBorrar");
    for (var f = 0; f < botones.length; f++) {
      botones[f].addEventListener("click", validar);
    }
  }
  
  function validar(event) {
    if (!confirm("¿Estás seguro de eliminar este proveedor?")) {
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
  
  window.addEventListener("load", function() {
    asociarEventos();
    
    document.querySelector("th:nth-child(2)").ondblclick = function() {
      ordenarPor("rfc");
    };
    document.querySelector("th:nth-child(3)").ondblclick = function() {
      ordenarPor("nombreP");
    };
    document.querySelector("th:nth-child(4)").ondblclick = function() {
      ordenarPor("telefono");
    };
    document.querySelector("th:nth-child(5)").ondblclick = function() {
      ordenarPor("correo");
    };
  });
</script>

<table>
  <tr>
    <th>#</th>
    <th>RFC</th>
    <th>Nombre</th>
    <th>Teléfono</th>
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
      <td><?= htmlspecialchars($row['id']) ?></td>
      <td><?= htmlspecialchars($row['nombreP']) ?></td>
      <td><?= htmlspecialchars($row['telefono']) ?></td>
      <td><?= htmlspecialchars($row['correo']) ?></td>
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
