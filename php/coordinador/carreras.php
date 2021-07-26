<?php

	include('../conexion.php');
	
	$query = "SELECT id,nombre FROM carreras";

	$consulta = $db->query($query);

	$carreras = array();

	while ($ase = mysqli_fetch_array($consulta)) {
		array_push($carreras, array('id' => $ase['id'] , 'nombre' =>  $ase['nombre']));
	}

	echo json_encode($carreras);

	mysqli_close($db);