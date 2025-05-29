<?php
require_once('../base/bd.php');

$id = $_GET['id'] ?? '';
$editorial = '';
$valorIntentado = $_GET['editorial'] ?? '';

if ($id !== '') {
    $id = intval($id);
    $query = "SELECT * FROM editorial WHERE id = $id";
    $result = bd_consulta($query);
    if ($row = mysqli_fetch_assoc($result)) {
        $editorial = $row['editorial'];
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

<form action="../content/editorial_modify_commit.php" method="post" autocomplete="off">
    <h2 class="form-header">MODIFICAR EDITORIAL</h2>
    <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

    <div class="dato">
        <div class="etiqueta">
            <label for="editorial">Nombre:</label>
        </div>
        <div class="control">
            <input type="text" name="editorial" id="editorial" required value="<?= htmlspecialchars($valorIntentado ?: $editorial) ?>">
        </div>
    </div>

    <div class="dato">
        <div class="etiqueta"><label>&nbsp;</label></div>
        <div class="control" id="botones">
            <button type="button" onclick="window.location.href='../base/index.php?op=80'">Cancelar</button>
            <button type="submit">Guardar cambios</button>
        </div>
    </div>
</form>
