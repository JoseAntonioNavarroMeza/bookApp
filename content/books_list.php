<?php
//   $consulta="SELECT book.id, isbn, titulo, autor.nombre as autor, tipo.tipo, lenguaje.lenguaje, book.stock, book.precio
// from book left join autor_libro on book.id=autor_libro.id_libro, autor,tipo,lenguaje
// where autor.id=autor_libro.id_autor and book.tipo=tipo.id and book.idioma=lenguaje.id";
// $consulta="SELECT book.id, isbn, titulo, autor.nombre as autor, tipo.tipo, lenguaje.lenguaje, book.stock, book.precio
// from book inner join tipo on book.tipo=tipo.id
// inner join lenguaje on book.idioma=lenguaje.id
// left join autor_libro on book.id=autor_libro.id_libro
// left join autor on autor.id=autor_libro.id_autor";
$consulta = "SELECT book.id, isbn, titulo, autor.nombre as autor, tipo.tipo, lenguaje.lenguaje, book.stock, book.precio
from book inner join tipo on book.tipo=tipo.id
inner join lenguaje on book.idioma=lenguaje.id
inner join autor on autor.id=book.autor order by titulo";
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
  while ($row = mysqli_fetch_assoc($result)) {
    $i++;
    ?>
    <tr>
      <td><?= $i ?></td>
      <td><?= $row['isbn'] ?></td>
      <td><?= $row['titulo'] ?></td>
      <td><?= $row['autor'] ?></td>
      <td><?= $row['tipo'] ?></td>
      <td><?= $row['lenguaje'] ?></td>
      <td><?= $row['stock'] ?></td>
      <td><?= $row['precio'] ?></td>
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
  <tr id="resumen">
    <td></td>
    <td></td>
    <td id="totalL">Total de Libros:</td>
    <td></td>
    <td></td>
    <td></td>
    <td id="totalS">Stock:</td>
    <td id="promedioPrecio">Promedio:</td>
  </tr>
</table>