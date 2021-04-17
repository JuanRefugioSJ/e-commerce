<?php
require_once('app/init.php');

$mensaje="";

if (isset($_POST['btnAccion'])) {
	switch ($_POST['btnAccion']) {
		case 'Agregar':
		
			if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
			$ID=openssl_decrypt($_POST['id'], COD, KEY);
			//	$mensaje.="ok ID correcto".$ID."<br/>";

			}else{
			//	$mensaje.="Uppss ID incorrecto".$ID."<br/>";
			}

			if (is_string(openssl_decrypt($_POST['nombre'], COD, KEY))) {
			$NOMBRE=openssl_decrypt($_POST['nombre'], COD, KEY);
			//$mensaje.="ok NOMBRE correcto".$NOMBRE."<br/>";
			}else{
			//$mensaje.="Uppss NOMBRE incorrecto"."<br/>";
			 break;}

		
			if (is_numeric(openssl_decrypt($_POST['cantidad'], COD, KEY))) {
			$CANTIDAD=openssl_decrypt($_POST['cantidad'], COD, KEY);
			//$mensaje.="ok CANTIDAD correcta".$CANTIDAD."<br/>";
			}else{
			//$mensaje.="Uppss CANTIDAD incorrecta"."<br/>"; 
				break;}

			if (is_numeric(openssl_decrypt($_POST['precio'], COD, KEY))) {
			$PRECIO=openssl_decrypt($_POST['precio'], COD, KEY);
			//$mensaje.="ok PRECIO correcto".$PRECIO."<br/>";
			}else{
			//$mensaje.="Uppss PRECIO incorrecto"."<br/>"; 
				break;}

			if (is_string(openssl_decrypt($_POST['marca'], COD, KEY))) {
			$MARCA=openssl_decrypt($_POST['marca'], COD, KEY);
			//$mensaje.="ok MARCA correctA".$MARCA."<br/>";
			}else{
			//$mensaje.="Uppss MARCA incorrecta"."<br/>";
			 break;}


			if (!isset($_SESSION['CARRITO'])) {
				$producto=array(
					'ID'=>$ID,
					'NOMBRE'=>$NOMBRE,
					'CANTIDAD'=>$CANTIDAD,
					'PRECIO'=>$PRECIO,
					'MARCA' =>$MARCA);
				$_SESSION['CARRITO'][0]=$producto;
				$mensaje="Producto agregado al carrito";
			}else{

				$idProductos=array_column($_SESSION['CARRITO'],"ID");
				if(in_array($ID, $idProductos)){
					echo "<script>alert('El productoya ha sido seleccionado..')</script>";
				}else{

				$NumeroProductos=count($_SESSION['CARRITO']);
				$producto=array(
					'ID'=>$ID,
					'NOMBRE'=>$NOMBRE,
					'CANTIDAD'=>$CANTIDAD,
					'PRECIO'=>$PRECIO,
					'MARCA' =>$MARCA);
				$_SESSION['CARRITO'][$NumeroProductos]=$producto;
				$mensaje="Producto agregado al carrito";
				}
			}
				
		break;
		case 'Eliminar':
				if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
			$ID=openssl_decrypt($_POST['id'], COD, KEY);
			
			foreach ($_SESSION['CARRITO'] as $indice=> $producto) {
				if($producto['ID']==$ID){
					unset($_SESSION['CARRITO'][$indice]);
					echo "<script>alert('Producto eliminado...')</script>";
				}
			}

			}else{
			$mensaje.="Uppss no se pudo eliminar el producto".$ID."<br/>";
				}
		break;
		}
		
	}

?>