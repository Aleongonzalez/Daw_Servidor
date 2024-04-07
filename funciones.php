<?php 

	include "consultas.php";


	function pintaCategorias($defecto) {
		$categorias = getCategorias();
		while ($fila = mysqli_fetch_assoc($categorias)) {
			if ($fila['CategoryID'] == $defecto) {
				echo "<option value ='".$fila["CategoryID"] . "'selected>" . $fila["Name"] . "</option>";
			} else {
				echo "<option value ='".$fila["CategoryID"] . "'>" . $fila["Name"] . "</option>";
			}
		}
	}

	

	function pintaTablaUsuarios(){
		$listaUsuarios = getListaUsuarios();

		echo "<table><tr><th>Nombre</th><th>Email</th><th>Autorizado</th></tr>";

		while ($fila = mysqli_fetch_assoc($listaUsuarios)) {
			echo "<tr><td>" . $fila['FullName'] . "</td><td>" . $fila['Email'] . "</td>";

			if($fila['Enabled']==1){
				echo "<td class='rojo'>" . $fila['Enabled'] . "</td>";
			} else {
				echo "<td>" . $fila['Enabled'] . "</td>";
			}
		}
	}

		
	function pintaProductos($orden) {
		$productos = getProductos($orden);

		echo "<table>\n
				<tr>\n
				<th><a href='articulos.php?orden=ProductID'>ID</a></th>\n
				<th><a href='articulos.php?orden=Name'>Nombre</a></th>\n
				<th><a href='articulos.php?orden=Cost'>Coste</a></th>\n
				<th><a href='articulos.php?orden=Price'>Precio</a></th>\n
				<th><a href='articulos.php?orden=categoria'>Categoría</a></th>\n
				<th>Acciones</th></tr>";

		while ($fila = mysqli_fetch_assoc($productos)) {
			echo "<tr>\n
				<td>" . $fila['ProductID'] . "</td>\n
				<td>" . $fila['Name'] . "</td>\n
				<td>" . $fila['Cost'] . "</td>\n
				<td>" . $fila['Price'] . "</td>\n
				<td>" . $fila['Categoria'] . "</td>\n";


			if (getPermisos()==1) {
				echo "<td><a href='formArticulos.php?Editar=" . $fila["ProductID"] . "'>Editar</a> - <a href='formArticulos.php?Borrar=" . $fila["ProductID"] . "'>Borrar</a></tr>";
			}


		}
		echo "</table>";
	}

?>