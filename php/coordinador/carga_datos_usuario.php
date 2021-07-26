<?php
	include('../conexion.php');
	$id = $_REQUEST['id'];


	$datos_usuario = $db->query("SELECT id, rango, id_carrera, email, password, fecha_registro, asesor, status FROM usuarios WHERE id = $id");

	while (	$usu = mysqli_fetch_array($datos_usuario) ){

		$id = $usu['id'];
		$rango = $usu['rango'];
		$id_carrera = $usu['id_carrera'];
		$email = $usu['email'];
		$password = $usu['password'];
		$fecha_registro = $usu['fecha_registro'];
		$asesor = $usu['asesor'];
		$status = $usu['status'];
	}

	echo '{"id" : "'.$id.'", "rango" : "'.$rango.'", "id_carrera" : "'.$id_carrera.'", "email" : "'.$email.'", "password" : "'.$password.'", "fecha_registro" : "'.$fecha_registro.'", "asesor" : "'.$asesor.'", "status" : "'.$status.'"}';

	mysqli_close($db);

?>