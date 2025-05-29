<?php
require_once('../base/bd.php');

$id = $_GET['id'] ?? '';
$lenguaje = '';
$valorIntentado = $_GET['lenguaje'] ?? '';

if ($id !== '') {
    $id = intval($id);
    $query = "SELECT * FROM lenguaje WHERE id = $id";
    $result = bd_consulta($query);
    if ($row = mysqli_fetch_assoc($result)) {
        $lenguaje = $row['lenguaje'];
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

<form action="../content/lenguaje_modify_commit.php" method="post" autocomplete="off">
    <h2 class="form-header">MODIFICAR LENGUAJE</h2>
    <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

    <div class="dato">
        <div class="etiqueta">
            <label for="lenguaje">Nombre:</label>
        </div>
        <div class="control">
            <input type="text" name="lenguaje" id="lenguaje" required value="<?= htmlspecialchars($valorIntentado ?: $lenguaje) ?>">
        </div>
    </div>

    <div class="dato">
        <div class="etiqueta"><label>&nbsp;</label></div>
        <div class="control" id="botones">
            <button type="button" onclick="window.location.href='../base/index.php?op=70'">Cancelar</button>
            <button type="submit">Guardar cambios</button>
        </div>
    </div>
</form>
