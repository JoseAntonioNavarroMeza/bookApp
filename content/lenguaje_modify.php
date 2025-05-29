<?php
require_once('../base/bd.php');

$id = $_GET['id'] ?? '';
$lenguaje = '';
$valorIntentado = $_GET['lenguaje'] ?? '';
$puedeModificar = true; // Variable para controlar si se puede modificar

if ($id !== '') {
    $id = intval($id);
    
    // Obtener datos del lenguaje
    $query = "SELECT * FROM lenguaje WHERE id = $id";
    $result = bd_consulta($query);
    if ($row = mysqli_fetch_assoc($result)) {
        $lenguaje = $row['lenguaje'];
    }
    
    // Verificar si tiene libros asociados
    $query_libros = "SELECT COUNT(*) as total FROM book WHERE idioma = $id";
    $result_libros = bd_consulta($query_libros);
    $fila_libros = mysqli_fetch_assoc($result_libros);
    
    $puedeModificar = ($fila_libros['total'] == 0);
}

if (isset($_GET['error'])) {
    $mensajes = [
        'repetido' => 'El registro ya existe, intenta uno diferente',
        'datos' => 'Faltan datos obligatorios',
        'asociado' => 'No se puede modificar un lenguaje con libros asociados'
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
            <input type="text" name="lenguaje" id="lenguaje" required 
                   value="<?= htmlspecialchars($valorIntentado ?: $lenguaje) ?>"
                   <?= !$puedeModificar ? 'readonly' : '' ?>>
            <?php if (!$puedeModificar): ?>
                <p class="error-message">No se puede modificar: tiene libros asociados</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="dato">
        <div class="etiqueta"><label>&nbsp;</label></div>
        <div class="control" id="botones">
            <button type="button" onclick="window.location.href='../base/index.php?op=70'">Cancelar</button>
            <button type="submit" <?= !$puedeModificar ? 'disabled' : '' ?>>Guardar cambios</button>
        </div>
    </div>
</form>
