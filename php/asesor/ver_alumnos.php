<?php
	include('../conexion.php');
	$filtrar_carrera = $_REQUEST['filtrar_carrera'];
	$filtrar_asesor = $_REQUEST['filtrar_asesor_asignado'];

	if ($filtrar_carrera == "" && $filtrar_asesor == "" && $filtrar_status == "" && $filtrar_fecha_ini == "" && $filtrar_fecha_fin == "" ) {
		$consulta = "SELECT id,(SELECT CONCAT(apellidos,' ',nombre) FROM usuarios_informacion WHERE usuarios_informacion.id_usuario = usuarios.id) AS nombre, CASE WHEN rango = 2 THEN 'ASESOR' WHEN rango = 3 THEN 'ALUMNO' ELSE 'ADMINISTRADOR' END AS rango , (SELECT nombre FROM carreras WHERE carreras.id =usuarios.id_carrera) AS carrera, email, password, (SELECT CONCAT(apellidos,' ',nombre) FROM usuarios_informacion WHERE usuarios_informacion.id_usuario=usuarios.asesor) AS asesor, fecha_registro, CASE WHEN status = 0 THEN 'INACTIVO' WHEN status = 1 THEN 'ACTIVO' WHEN status = 2 THEN 'FINALIZADO' ELSE 'CANCELADO' END AS status FROM usuarios WHERE rango = 3 AND fecha_registro BETWEEN (NOW() - INTERVAL 7 DAY) AND NOW()";
	}else{
		$where1 = ($filtrar_carrera == "") ? "" : "id_carrera = '$filtrar_carrera'";
		$where2 = ($filtrar_asesor == "") ? "" : "asesor = '$filtrar_asesor'";

		$where = "";
		$where = ($where1 != "" && ($where2 != "")) ? $where.$where1.' AND ' : $where.$where1;
		$where = ($where == "" ) ? "" : ' AND '.$where.$where2;

		$consulta = "SELECT id,(SELECT CONCAT(apellidos,' ',nombre) FROM usuarios_informacion WHERE usuarios_informacion.id_usuario = usuarios.id) AS nombre, CASE WHEN rango = 2 THEN 'ASESOR' WHEN rango = 3 THEN 'ALUMNO' ELSE 'ADMINISTRADOR' END AS rango , (SELECT nombre FROM carreras WHERE carreras.id =usuarios.id_carrera) AS carrera, email, password, (SELECT CONCAT(apellidos,' ',nombre) FROM usuarios_informacion WHERE usuarios_informacion.id_usuario=usuarios.asesor) AS asesor, fecha_registro, CASE WHEN status = 0 THEN 'INACTIVO' WHEN status = 1 THEN 'ACTIVO' WHEN status = 2 THEN 'FINALIZADO' ELSE 'CANCELADO' END AS status FROM usuarios WHERE rango = 3 AND status = 1".$where;
	}

	$filtrar_alumnos = $db->query($consulta);

	$alumnos = array();

	while ($usu = mysqli_fetch_array($filtrar_alumnos)) {
		array_push($alumnos, array('id' => $usu['id'] , 'rango' =>  $usu['rango'] , 'nombre' =>  $usu['nombre'] , 'carrera' =>  $usu['carrera'] , 'email' => $usu['email'] , 'password' => $usu['password'] , 'asesor' => $usu['asesor'] , 'fecha_registro' => $usu['fecha_registro'], 'status' => $usu['status']));
	}

	echo json_encode($alumnos);

	mysqli_close($db);

?>