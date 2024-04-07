<!DOCTYPE html>
<html lang="es-es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Index.php</title>
	<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>

	<?php
	
		include "consultas.php";

	?>

	<div class="mainForm">
		<form class="formulario" action="index.php" method="POST" >
			<fieldset>
				<legend>Acceso</legend>
				
				<label for="user">Nombre Usuario:</label><br>
				<input type="text" name="user"><br>
				<label for="correo">Dirección email:</label><br>
				<input type="email" name="correo"><br>
				<input class="boton" type="submit" name="login" value="Entrar">
				
			</fieldset>
		</form>
	
	<!--Cuando le damos al boton enviamos por POST los name de los 3 inputs.-->
	<?php 	
		//comprobamos si se han recibido los datos del formulario
		if(isset($_POST['login'])){ //Comprobamos si hemos pulsado el boton Entrar
			//Guardamos los datos que hemos pasado del formulario
			$nombre = $_POST['user'];
			$correo = $_POST['correo'];
		//Tenemos que comprobar que tipo de usuario es por lo que usamos la funcion para ello
			$tipoUsuario = tipoUsuario($nombre,$correo);
			//Almacenamos en una cookie el tipo de usuario
			setcookie('tipoUsuario', $tipoUsuario, time()+500);
			
			//Segun el tipo de usuario que nos devuelva tipoUsuario se elegirá el case
			//echo $tipoUsuario;
			
			//Comprobamos si existe la variable $_COOKIE y depende del valor que contenga nos elige el tipo de usuario que es
			if(isset($_COOKIE['tipoUsuario'])) {
				if ($tipoUsuario == 'superadmin'){
					echo "Hola de nuevo $nombre. Para acceder a la página de usuarios pulsa <a href='usuarios.php'>AQUI</a>";
				} elseif ($tipoUsuario == 'autorizado') {
					echo "Hola de nuevo $nombre. Para acceder a la página de artículos pulsa <a href='articulos.php'>AQUI</a>";
				} elseif ($tipoUsuario == 'registrado') {
					echo "Hola de nuevo $nombre. No tienes permisos para acceder a más funciones";
				} else {
					echo "No está registrado.";
					//Borramos la cookie y liberamos la variable
					setcookie('tipoUsuario', "", time()-10);
					unset($_COOKIE['tipoUsuario']);
				}
			}
		}

	?>
	</div>
	
	
</body>
</html>