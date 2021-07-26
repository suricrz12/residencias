<?php

	include('../conexion.php');
	$my_id = $_REQUEST['my_id'];

	$consulta = $db->query("SELECT id, email FROM usuarios WHERE rango = 3 AND status = 1 AND asesor = $my_id");

	$usuarios = array();

	while ($usu = mysqli_fetch_array($consulta)) {
		array_push($usuarios, array('email' =>  $usu['email'].', ID_USER:'.$usu['id']));
	}

	echo json_encode($usuarios);

	mysqli_close($db);
?>