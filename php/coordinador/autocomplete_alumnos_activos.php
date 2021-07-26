<?php

	include('../conexion.php');
	
	$consulta = $db->query('SELECT id FROM usuarios WHERE rango = 3 AND status = 1');

	$id_usuarios = '';

	while ($doc = mysqli_fetch_array($consulta)) {
		 $id_usuarios .= $doc['id'].',';
	}

	if ( substr($id_usuarios, -1) == ','){
		$id_usuarios = substr($id_usuarios, 0, -1);
	}

	$query = "SELECT id_usuario, CONCAT(apellidos,' ',nombre) AS nombre FROM usuarios_informacion WHERE id_usuario IN (".$id_usuarios.") ORDER BY apellidos,nombre ASC";

	$consulta = $db->query($query);

	$asesores = array();

	while ($ase = mysqli_fetch_array($consulta)) {
		array_push($asesores, array('nombre' =>  $ase['nombre'].', ID_USER:'.$ase['id_usuario']));
	}

	echo json_encode($asesores);

	mysqli_close($db);