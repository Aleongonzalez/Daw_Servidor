<!DOCTYPE html>
<html lang="es-es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Articulos</title>
	<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body class="mainForm">

	<?php 

		include "funciones.php";

	?>

	<h1>Lista de artículos</h1>

	<?php 

		if (getPermisos()==1) {
			echo "<a href='formArticulos.php?Anadir'>Añadir producto</a>";
		}

	 ?>


	 <?php 	


		if (($_COOKIE['tipoUsuario'] == null) or ($_COOKIE['tipoUsuario']) != 'autorizado')	{
			//echo $_COOKIE['tipoUsuario'];
			echo "No deberías estar aquí";
		} else {
			if(!isset($_GET['orden'])){
				$orden = "ProductID";
			}else {
				$orden = $_GET['orden'];
			}

			pintaProductos($orden);
		}

	  ?>

	  <a href="index.php">Inicio</a>
	
</body>
</html>