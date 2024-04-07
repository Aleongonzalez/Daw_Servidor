<!DOCTYPE html>
<html lang="es-es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="estilo.css">
	<title>Usuarios</title>
</head>
<body class="mainForm">

	<?php 

		include "funciones.php";
		//Comprobamos si el usuario es superadmin y comprueba si se ha pulsado el boton de Cambiar permisos
		if (($_COOKIE['tipoUsuario'] ==null) or ($_COOKIE['tipoUsuario']) != 'superadmin')	{
			echo "No deberías estar aquí";
		} else {
			if(isset($_GET['Cambiar'])){
				cambiarPermisos();
			}
		}

	?>

	<!--Muestra los permisos acutales tras llamar a getPermisos. Si pulsamos el boton enviamos a la misma pagina que lo gestione-->
	<p>Los permisos actuales estan a <span><?php echo getPermisos(); ?></span></p>
	<form action="usuarios.php" method="GET">
		<p><input type="submit" name="Cambiar" value="Cambiar permisos"></p>
	</form>
	<?php 

		pintaTablaUsuarios();

	 ?>

	 <a href="index.php">Inicio</a>
	

</body>
</html>