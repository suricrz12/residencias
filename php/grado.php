<?php
	include('conexion.php');
	$ver_grados = $db->query("SELECT id, grado FROM grados");

	$grados = array();

	while ($gra = mysqli_fetch_array($ver_grados)) {
		array_push($grados, array('id' => $gra['id'] , 'nombre' => $gra['grado']));
	}

	echo json_encode($grados);

	mysqli_close($db);

?>