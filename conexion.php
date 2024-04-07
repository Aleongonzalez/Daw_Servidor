<?php 

	function crearConexion() {
		// Cambiar en el caso en que se monte la base de datos en otro lugar
		$host = "localhost";
		$user = "root";
		$pass = "";
		$baseDatos = "pac3_daw";

		//Creamos la conexion
		$conexion = mysqli_connect($host, $user, $pass, $baseDatos);

		//Comprobamos si se no hemos tenido error en la conexion
		if(!$conexion) {
			die("<br>Error en la conexión" . mysqli_connect_error());
		}

		//Usamos el mismo charset que en la pagina principal
		mysqli_set_charset($conexion, "utf8");

		//Devolvemos la conexion
		return $conexion;

	}


	function cerrarConexion($conexion) {
		//Cerramos la conexion
		mysqli_close($conexion);
	}


?>