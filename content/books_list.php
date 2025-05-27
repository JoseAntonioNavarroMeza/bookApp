<?php
$orden = isset($_GET['orden']) ? $_GET['orden'] : 'titulo';
$permitidos = ['isbn', 'titulo', 'autor', 'tipo', 'lenguaje', 'stock', 'precio'];
if (!in_array($orden, $permitidos)) {
  $orden = 'titulo';
}

$consulta = "
SELECT book.id, isbn, titulo, autor.nombre as autor, tipo.tipo as tipo, lenguaje.lenguaje as lenguaje, book.stock, book.precio
FROM book 
INNER JOIN tipo ON book.tipo = tipo.id
INNER JOIN lenguaje ON book.idioma = lenguaje.id
INNER JOIN autor ON autor.id = book.autor 
ORDER BY $orden;
";
$result = bd_consulta($consulta);
?>
<script type="text/javascript">
  function asociarEventos() {
    var botones = document.getElementsByClassName("botonBorrar");
    for (var f = 0; f < botones.length; f++) {
      var boton = botones[f];
      boton.addEventListener("click", validar);
    }
  }
  function validar(event) {
    if (!confirm("Estas seguro de eliminar este registro?"))
      event.preventDefault();
  }
  window.addEventListener("load", asociarEventos);
</script>
<table>
  <tr>
    <th>#</th>
    <th>ISBN</th>
    <th id="titulo">Título</th>
    <th>Autor</th>
    <th>Tipo</th>
    <th>Lenguaje</th>
    <th>Stock</th>
    <th>Precio</th>
    <th>
      <a class="botonAñadir" href="../base/index.php?op=11" title="Añadir nuevo">
        <i class="fas fa-plus"></i> <i class="fas fa-book"></i>
      </a>
    </th>
  </tr>
   <?php
  $i = 0;
  $totalStock = 0;
  $totalPrecio = 0;
  $contador = 0;

  mysqli_data_seek($result, 0);
  while ($row = mysqli_fetch_assoc($result)) {
    $i++;
    $totalStock += $row['stock'];
    $totalPrecio += $row['precio'];
    $contador++;
    ?>
    <tr>
      <td><?= $i ?></td>
      <td><?= $row['isbn'] ?></td>
      <td><?= $row['titulo'] ?></td>
      <td><?= $row['autor'] ?></td>
      <td><?= $row['tipo'] ?></td>
      <td><?= $row['lenguaje'] ?></td>
      <td><?= $row['stock'] ?></td>
      <td>$<?= number_format($row['precio'], 2) ?></td>
      <td>
        <a class="botonBorrar" href="../base/index.php?op=13&id=<?= $row['id'] ?>" title="Borrar">
          <i class="fas fa-trash-alt"></i>
        </a>
        <a class="botonModificar" href="../base/index.php?op=12&id=<?= $row['id'] ?>" title="Editar">
          <i class="fas fa-pen-to-square"></i>
        </a>
      </td>
    </tr>
  <?php } ?>
  <tr style="font-weight: bold; background-color: #f2f2f2;">
    <td colspan="2">Total de Libros: <?= $contador ?></td>
    <td colspan="2">Stock: <?= $totalStock ?></td>
    <td colspan="4">Promedio Precio: $<?= number_format($contador ? $totalPrecio / $contador : 0, 2) ?></td>
    <td></td>
  </tr>
</table>