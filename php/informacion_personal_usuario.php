<?php
	include('conexion.php');

	$id = $_REQUEST['id'];
	$ver_usu_informacion = $db->query("SELECT  id, id_usuario, nombre, apellidos, telefono, curp, semestre, promedio_anterior, promedio_general, id_grado, titulo FROM usuarios_informacion WHERE id_usuario = $id");

	$usu_informacion = array();

	while ($info = mysqli_fetch_array($ver_usu_informacion)) {
		array_push($usu_informacion, array('id' => $info['id'] , 'id_usuario' => $info['id_usuario'],  'nombre' => $info['nombre'] , 'apellidos' => $info['apellidos'] , 'telefono' => $info['telefono'] , 'curp' => $info['curp'] , 'semestre' => $info['semestre'] , 'promedio_anterior' => $info['promedio_anterior'], 'promedio_general' => $info['promedio_general'] , 'id_grado' => $info['id_grado'] , 'titulo' => $info['titulo'] ));
	}

	echo json_encode($usu_informacion);

	mysqli_close($db);

?>