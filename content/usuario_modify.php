<?php
include('../base/bd.php');

// Verificar que el parámetro id existe y es válido
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: ../base/index.php?op=10&error=invalid_id');
    exit;
}

$id = (int)$_GET['id'];

// Obtener los datos del libro
$sql = "SELECT * FROM book WHERE id = $id";
$result = bd_consulta($sql);

if (mysqli_num_rows($result) != 1) {
    header('Location: ../base/index.php?op=10&error=book_not_found');
    exit;
}

$row = mysqli_fetch_assoc($result);
?>

<form class="" action="../content/book_modify_commit.php" method="post">
    <h2 class="form-header">EDITAR LIBRO</h2>
    
    <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">
    
    <div class="dato">
        <div class="etiqueta">
            <label for="titulo">Título:</label>
        </div>
        <div class="control">
            <input type="text" name="titulo" id="titulo" value="<?= htmlspecialchars($row['titulo']) ?>" required>
        </div>
    </div>
    
    <div class="dato">
        <div class="etiqueta">
            <label for="autor">Autor:</label>
        </div>
        <div class="control">
            <input type="text" name="autor" id="autor" value="<?= htmlspecialchars($row['autor']) ?>" required>
        </div>
    </div>
    
    <div class="dato">
        <div class="etiqueta">
            <label for="genero">Género:</label>
        </div>
        <div class="control">
            <input type="text" name="genero" id="genero" value="<?= htmlspecialchars($row['genero']) ?>">
        </div>
    </div>
    
    <div class="dato">
        <div class="etiqueta">
            <label for="anio">Año:</label>
        </div>
        <div class="control">
            <input type="number" name="anio" id="anio" value="<?= htmlspecialchars($row['anio']) ?>">
        </div>
    </div>
    
    <div class="dato">
        <div class="etiqueta">
            <label for="">&nbsp;</label>
        </div>
        <div class="control" id="botones">
            <a href="../base/index.php?op=02">
                <button type="button">Cancelar</button>
            </a>
            <button type="submit" name="button">Guardar</button>
        </div>
    </div>
</form>

<style>
.form-header {
    margin: 20px 0;
    padding: 10px;
    color: #2c3e50;
    border-bottom: 2px solid #3498db;
    text-align: center;
}
</style>