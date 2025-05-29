<?php
require_once('../base/bd.php');

$id = $_GET['id'] ?? '';
$nombre = '';
$valorIntentado = $_GET['nombre'] ?? '';
$puedeModificar = true; // Flag para controlar si se puede modificar

if ($id !== '') {
    $id = intval($id);
    
    // 1. Obtener datos del país
    $query = "SELECT * FROM pais WHERE id = $id";
    $result = bd_consulta($query);
    if ($row = mysqli_fetch_assoc($result)) {
        $nombre = $row['nombre'];
    }
    
    // 2. Verificar si tiene autores asociados
    $query_autores = "SELECT COUNT(*) as total FROM autor WHERE nacionalidad = $id";
    $result_autores = bd_consulta($query_autores);
    $fila_autores = mysqli_fetch_assoc($result_autores);
    
    $puedeModificar = ($fila_autores['total'] == 0);
}

if (isset($_GET['error'])) {
    $mensajes = [
        'repetido' => 'El registro ya existe, intenta uno diferente',
        'datos' => 'Faltan datos obligatorios',
        'asociado' => 'No se puede modificar un país con autores asociados'
    ];

    if (isset($mensajes[$_GET['error']])) {
        echo '<script>alert("' . $mensajes[$_GET['error']] . '");</script>';
    }
}
?>

<form action="../content/pais_modify_commit.php" method="post">
    <h2 class="form-header">MODIFICAR PAÍS</h2>
    <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

    <div class="dato">
        <div class="etiqueta">
            <label for="nombre">Nombre:</label>
        </div>
        <div class="control">
            <input type="text" name="nombre" id="nombre" required 
                   value="<?= htmlspecialchars($valorIntentado ?: $nombre) ?>"
                   <?= !$puedeModificar ? 'readonly' : '' ?>>
            <?php if (!$puedeModificar): ?>
                <p class="error-message">No se puede modificar: tiene autores asociados</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="dato">
        <div class="etiqueta"><label>&nbsp;</label></div>
        <div class="control" id="botones">
            <button type="button" onclick="window.location.href='../base/index.php?op=60'">Cancelar</button>
            <button type="submit" <?= !$puedeModificar ? 'disabled' : '' ?>>Guardar cambios</button>
        </div>
    </div>
</form>