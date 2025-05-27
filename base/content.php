<?php
$option = $_GET['op'] ?? '10';
if($user){
	switch ($option) {
		//Libros
		case '00':
			include('salir.php');
			break;
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
		//Clientes
		case '20':
			include('../content/cliente_list.php');
			break;
		//Proveedores
		case '30':
			include('../content/proveedores_list.php');
			break;
			case '33'
			include('../content/proveedores_new.php');
			break;
		//Compras
		case '40':
			include('../content/.php');
			break;
		//Ventas
		case '50':
			include('../content/.php');
			break;
		//Pais
		case '60':
			include('../content/pais_list.php');
			break;
			case '63':
				include('../content/pais_delete.php');
				break;
		//Lenguaje
		case '70':
			include('../content/lenguaje_list.php');
			break;
			case '73':
				include('../content/lenguaje_delete.php');
				break;
		//Editorial
		case '80':
			include('../content/editorial_list.php');
			break;
			case '83':
				include('../content/editorial_delete.php');
				break;
		//Autores
		case '90':
			include('../content/autores_list.php');
			break;
			case '93':
				include('../content/autores_delete.php');
				break;
	}	
}

?>