<?php
require_once('../base/bd.php');

$id = $_GET['id'] ?? '';
$nombre = '';
$nacionalidad = '';
$valorNombre = $_GET['nombre'] ?? '';
$valorNacionalidad = $_GET['nacionalidad'] ?? '';

// Obtener lista de países para el select
$paises = [];
$resultPaises = bd_consulta("SELECT id, nombre FROM pais ORDER BY nombre");
while ($rowPais = mysqli_fetch_assoc($resultPaises)) {
    $paises[] = $rowPais;
}

if ($id !== '') {
    $id = intval($id);
    $query = "SELECT * FROM autor WHERE id = $id";
    $result = bd_consulta($query);
    if ($row = mysqli_fetch_assoc($result)) {
        $nombre = $row['nombre'];
        $nacionalidad = $row['nacionalidad'];
    }
}

if (isset($_GET['error'])) {
    $mensajes = [
        'repetido' => 'El autor ya existe, intenta uno diferente',
        'datos' => 'Faltan datos obligatorios'
    ];

    if (isset($mensajes[$_GET['error']])) {
        echo '<script>alert("' . $mensajes[$_GET['error']] . '");</script>';
    }
}
?>

<form action="../content/autores_modify_commit.php" method="post" autocomplete="off">
    <h2 class="form-header">MODIFICAR AUTOR</h2>
    <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

    <div class="dato">
        <div class="etiqueta"><label for="nombre">Nombre:</label></div>
        <div class="control">
            <input type="text" name="nombre" id="nombre" required value="<?= htmlspecialchars($valorNombre ?: $nombre) ?>">
        </div>
    </div>

    <div class="dato">
        <div class="etiqueta"><label for="nacionalidad">Nacionalidad:</label></div>
        <div class="control">
            <select name="nacionalidad" id="nacionalidad" required>
                <option value="">-- Selecciona un país --</option>
                <?php foreach ($paises as $pais): ?>
                    <option value="<?= $pais['id'] ?>"
                        <?= (($valorNacionalidad !== '') ? ($valorNacionalidad == $pais['id']) : ($nacionalidad == $pais['id'])) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($pais['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="dato">
        <div class="etiqueta"><label>&nbsp;</label></div>
        <div class="control" id="botones">
            <button type="button" onclick="window.location.href='../base/index.php?op=90'">Cancelar</button>
            <button type="submit">Guardar cambios</button>
        </div>
    </div>
</form>
