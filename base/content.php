<?php
$option = $_GET['op'] ?? '10';
if ($user) {
	switch ($option) {
		
		case '00':
			include('salir.php');
			break;
		//Libros
		case '10':
			include('../content/books_list.php');
			break;
		case '11':
			include('../content/book_new.php');
			break;
		case '12':
			include('../content/book_modify.php');
			break;
		case '13':
			include('../content/book_delete.php');
			break;
		//Usuarios
		case '02':
			include('../content/usuario_list.php');
			break;
		case '03':
			include('../content/usuario_new.php');
			break;
		case '04':
			include('../content/book_modify.php');
			break;
		case '05':
			include('../content/usuario_delete.php');
			break;
		//Clientes
		case '20':
			include('../content/cliente_list.php');
			break;
		case '21':
			include('../content/cliente_new.php');
			break;
		case '22':
			include('../content/cliente_modify.php');
			break;
		case '23':
			include('../content/cliente_delete.php');
		//Proveedores
		case '30':
			include('../content/proveedores_list.php');
			break;
		case '31':
			include('../content/proveedores_new.php');
			break;
		case '32':
			include('../content/proveedores_modify.php');
			break;
		case '33':
			include('../content/proveedores_delete.php');
		//Compras
		case '40':
			include('../content/compras_list.php');
			break;
		case '41':
			include('../content/compras_new.php');
			break;
		case '42':
			include('../content/_modify.php');
			break;
		case '43':
			include('../content/_delete.php');
		//Ventas
		case '50':
			include('../content/ventas_list.php');
			break;
		case '51':
			include('../content/ventas_new.php');
			break;
		case '52':
			include('../content/_modify.php');
			break;
		case '53':
			include('../content/_delete.php');
		//Pais
		case '60':
			include('../content/pais_list.php');
			break;
		case '61':
			include('../content/pais_new.php');
			break;
		case '62':
			include('../content/pais_modify.php');
			break;
		case '63':
			include('../content/pais_delete.php');
			break;
		//Lenguaje
		case '70':
			include('../content/lenguaje_list.php');
			break;
		case '71':
			include('../content/lenguaje_new.php');
			break;
		case '72':
			include('../content/lenguaje_modify.php');
			break;
		case '73':
			include('../content/lenguaje_delete.php');
		//Editorial
		case '80':
			include('../content/editorial_list.php');
			break;
		case '81':
			include('../content/editorial_new.php');
			break;
		case '82':
			include('../content/editorial_modify.php');
			break;
		case '83':
			include('../content/editorial_delete.php');
		//Autores
		case '90':
			include('../content/autores_list.php');
			break;
		case '91':
			include('../content/autores_new.php');
			break;
		case '92':
			include('../content/autores_modify.php');
			break;
		case '93':
			include('../content/autores_delete.php');
	}
}

?>