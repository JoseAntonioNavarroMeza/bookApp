<?php
require_once('../base/bd.php');

$id = $_GET['id'] ?? '';
$nombre = '';
$valorIntentado = $_GET['nombre'] ?? '';

if ($id !== '') {
    $id = intval($id);
    $query = "SELECT * FROM pais WHERE id = $id";
    $result = bd_consulta($query);
    if ($row = mysqli_fetch_assoc($result)) {
        $nombre = $row['nombre'];
    }
}

if (isset($_GET['error'])) {
    $mensajes = [
        'repetido' => 'El registro ya existe, intenta uno diferente',
        'datos' => 'Faltan datos obligatorios'
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
            <input type="text" name="nombre" id="nombre" required value="<?= htmlspecialchars($valorIntentado ?: $nombre) ?>">
        </div>
    </div>

    <div class="dato">
        <div class="etiqueta"><label>&nbsp;</label></div>
        <div class="control" id="botones">
            <button type="button" onclick="window.location.href='../base/index.php?op=60'">Cancelar</button>
            <button type="submit">Guardar cambios</button>
        </div>
    </div>
</form>
