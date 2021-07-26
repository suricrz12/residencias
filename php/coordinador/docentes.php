<?php

	include('../conexion.php');
	
	$consulta = $db->query('SELECT id FROM usuarios WHERE rango = 2 AND status = 1');

	$id_asesores = '';

	while ($doc = mysqli_fetch_array($consulta)) {
		 $id_asesores .= $doc['id'].',';
	}

	if ( substr($id_asesores, -1) == ','){
		$id_asesores = substr($id_asesores, 0, -1);
	}

	$query = "SELECT id_usuario, CONCAT(apellidos,' ',nombre) AS nombre FROM usuarios_informacion WHERE id_usuario IN (".$id_asesores.") ORDER BY apellidos,nombre ASC";

	$consulta = $db->query($query);

	$asesores = array();

	while ($ase = mysqli_fetch_array($consulta)) {
		array_push($asesores, array('id' => $ase['id_usuario'] , 'nombre' =>  $ase['nombre']));
	}

	echo json_encode($asesores);

	mysqli_close($db);