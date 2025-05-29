<form class="" action="../content/usuario_new_commit.php" method="post">
    <h2 class="form-header">NUEVO USUARIO</h2>
    
    <div class="dato">
        <div class="etiqueta">
            <label for="username">Usuario:</label>
        </div>
        <div class="control">
            <input type="text" name="username" id="username" required>
        </div>
    </div>
    
    <div class="dato">
        <div class="etiqueta">
            <label for="password">Contraseña:</label>
        </div>
        <div class="control">
            <input type="password" name="password" id="password" required>
        </div>
    </div>
    
    <div class="dato">
        <div class="etiqueta">
            <label for="nombre">Nombre:</label>
        </div>
        <div class="control">
            <input type="text" name="nombre" id="nombre" required>
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
            <button type="submit" name="button">Enviar</button>
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