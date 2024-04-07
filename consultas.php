                                            
<?php 

	include "conexion.php";

	function tipoUsuario($nombre, $correo){
		//Establecemos la conexion con la base de datos
		$conexion = crearConexion();
		//usamos la funcion que hemos creado para comprobar si es superadmin
		if (esSuperadmin($nombre, $correo)) {
			return "superadmin";
		}else {
			
			//Realizamos la consulta y cerramos la conexion
			$sql = "SELECT FullName, Email, Enabled FROM user WHERE FullName = '$nombre' and Email = '$correo'";
			$consulta = mysqli_query($conexion,$sql);
			cerrarConexion($conexion);

			//Dependiendo del dato en la columna Enabled de la tabla user vemos si es registrado o autorizado
			if ($datos = mysqli_fetch_array($consulta)) {
				if($datos["Enabled"]==1){
					return "autorizado";
				}elseif ($datos["Enabled"]==0) {
					return "registrado";
				}
			}else {
				return "no registrado";
				//Borramos la cookie y liberamos la variable
				setcookie('tipoUsuario', "", time()-10);
				unset($_COOKIE['tipoUsuario']);
			}

			}
		}


	


	function esSuperadmin2($nombre, $correo){
		
		//Establecemos la conexion
		$conexion = crearConexion();
		//Comprobamos si el ID de la tabla user de los datos que introducimos en index.php coincide con el valor guardado en 
		//SuperAdmin de la tabla setup
		$sql = "SELECT user.UserID FROM user INNER JOIN setup ON user.UserID = setup.SuperAdmin WHERE user.FullName = '$nombre' and user.Email = '$correo'";
		//Generamos la consulta
		$consulta = mysqli_query($conexion,$sql);
		//cerramos la conexion
		cerrarConexion($conexion);
		//Comprueba si la consulta existe
		if($datos = mysqli_fetch_array($consulta)){
			return true;
		}else {
			return false;
		}

	}

	function esSuperadmin($nombre, $correo) {
		$conexion = crearConexion();

		$sql1 = "SELECT SuperAdmin FROM setup";
		$consulta1 = mysqli_query($conexion, $sql1);
		$valorSuper = mysqli_fetch_array($consulta1);
		

		$sql2 = "SELECT UserID FROM user WHERE FullName = '$nombre' and Email = '$correo'";
		$consulta2 = mysqli_query($conexion, $sql2);
		$valorID = mysqli_fetch_array($consulta2);
		
		cerrarConexion($conexion);
		//echo $valorSuper[0];
		//echo $valorID[0];
		if (mysqli_num_rows($consulta2) > 0) {
			if($valorSuper['SuperAdmin']==$valorID['UserID']) {
				return true;
			} else {
				return false;
			} 
		} else {
			return false;
		}

	}


	function getPermisos() {

		//Crea la conexion con la base de datos
		$conexion = crearConexion();
		//realizamos la consulta
		$sql = "SELECT Autenticación FROM setup";
		//La guardamos en un array
		$consulta = mysqli_fetch_assoc(mysqli_query($conexion, $sql));
		//cerramos la conexion
		cerrarConexion($conexion);
		//Solo devolvemos el valor que se encuentre en la posicion Autenticacion del array consulta
		return $consulta['Autenticación'];
	}




	function cambiarPermisos() {
		//Vemos el estado en el que se encuentran los permisos en este momento
		$permisos = getPermisos();
		//Creamos la conexion
		$conexion = crearConexion();
		//Dependiendo del valor que tenga permisos lo cambia al contrario
		if ($permisos==1) {
			$sql = "UPDATE setup SET Autenticación = 0";
		}elseif ($permisos == 0) {
			$sql = "UPDATE setup SET Autenticación = 1";
		}
		//lanzamos la consulta SQL
		$consulta = mysqli_query($conexion, $sql);
		//Cerramos la conexion
		cerrarConexion($conexion);

	}



//A partir de aqui el esquema es el mismo. Crear la conexion, realizar la consulta, cerrar la conexion y devolver la consulta

	function getCategorias() {
		$conexion = crearConexion();

		$sql = "SELECT CategoryID, Name FROM category";

		$consulta = mysqli_query($conexion, $sql);

		cerrarConexion($conexion);

		if($consulta) {
			return $consulta;	
		} else {
			echo "ERROR DE CONSULTA";
		}

	}


	function getListaUsuarios() {
		$conexion = crearConexion();

		$sql = "SELECT FullName, Email, Enabled FROM user";

		$consulta = mysqli_query($conexion, $sql);

		cerrarConexion($conexion);
		if($consulta) {
			return $consulta;	
		} else {
			echo "ERROR DE CONSULTA";
		}
		
	}


	function getProducto($ID) {
		$conexion = crearConexion();

		$sql = "SELECT * FROM product WHERE ProductID =$ID";

		$consulta = mysqli_query($conexion, $sql);

		cerrarConexion($conexion);

		if($consulta) {
			return $consulta;	
		} else {
			echo "ERROR DE CONSULTA";
		}
	}


	function getProductos($orden) {
		$conexion = crearConexion();

		$sql = "SELECT product.ProductID, product.Name, product.Cost, product.Price, category.Name as Categoria FROM product INNER JOIN category WHERE product.CategoryID = category.CategoryID ORDER BY $orden";

		$consulta = mysqli_query($conexion, $sql);

		cerrarConexion($conexion);

		if($consulta) {
			return $consulta;	
		} else {
			echo "ERROR DE CONSULTA";
		}
	}


	function anadirProducto($nombre, $coste, $precio, $categoria) {
		$conexion = crearConexion();

		$sql = "INSERT INTO product	(Name, Cost, Price, CategoryID) VALUES ('$nombre', $coste, $precio, $categoria)";

		$consulta = mysqli_query($conexion, $sql);

		cerrarConexion($conexion);

		if($consulta) {
			return $consulta;	
		} else {
			echo "ERROR DE CONSULTA";
		}
	}


	function borrarProducto($id) {
		$conexion = crearConexion();

		$sql = "DELETE FROM product	WHERE ProductID = $id";

		$consulta = mysqli_query($conexion, $sql);

		cerrarConexion($conexion);

		if($consulta) {
			return $consulta;	
		} else {
			echo "ERROR DE CONSULTA";
		}
	}


	function editarProducto($id, $nombre, $coste, $precio, $categoria) {
		$conexion = crearConexion();

		$sql = "UPDATE product SET Name = '$nombre', Cost = $coste, Price = $precio, CategoryID = $categoria WHERE ProductID = $id";

		$consulta = mysqli_query($conexion, $sql);

		cerrarConexion($conexion);

		if($consulta) {
			return $consulta;	
		} else {
			echo "ERROR DE CONSULTA";
		}
	}



		

	

?>