<?php
	include('../conexion.php');
	$ver_tipo_usuario = $_REQUEST['ver_tipo_usuario'];
	$ver_carrera = $_REQUEST['ver_carrera'];
	$ver_status = $_REQUEST['ver_status'];
	$ver_asesor = $_REQUEST['ver_asesor_asignado'];
	$fecha_ini = $_REQUEST['fecha_ini'];
	$fecha_ini = ($fecha_ini != "") ? $fecha_ini.' 00:00:00' : '';
	$fecha_fin = $_REQUEST['fecha_fin'];
	$fecha_fin = ($fecha_fin != "") ? $fecha_fin.' 23:59:59' : '';

	if ($ver_tipo_usuario == "" && $ver_carrera == "" && $ver_asesor == "" && $ver_status == "" && $fecha_ini == "" && $fecha_fin == "" ) {
		$consulta = "SELECT id,(SELECT CONCAT(apellidos,' ',nombre) FROM usuarios_informacion WHERE usuarios_informacion.id_usuario = usuarios.id) AS nombre, CASE WHEN rango = 2 THEN 'ASESOR' WHEN rango = 3 THEN 'ALUMNO' ELSE 'ADMINISTRADOR' END AS rango , (SELECT nombre FROM carreras WHERE carreras.id =usuarios.id_carrera) AS carrera, email, password, (SELECT CONCAT(apellidos,' ',nombre) FROM usuarios_informacion WHERE usuarios_informacion.id_usuario=usuarios.asesor) AS asesor, fecha_registro, CASE WHEN status = 0 THEN 'INACTIVO' WHEN status = 1 THEN 'ACTIVO' WHEN status = 2 THEN 'FINALIZADO' ELSE 'CANCELADO' END AS status FROM usuarios WHERE rango != 1 AND fecha_registro BETWEEN (NOW() - INTERVAL 365 DAY) AND NOW()";
	}else{
		$where1 = ($ver_carrera == "") ? "" : "id_carrera = '$ver_carrera'";
		$where2 = ($ver_tipo_usuario == "") ? "" : "rango = '$ver_tipo_usuario'";		
		$where3 = ($ver_status == "") ? "" : "status = '$ver_status'";
		$where4 = ($ver_asesor == "") ? "" : "asesor = '$ver_asesor'";
		$where5 = ($fecha_ini == "" && $fecha_fin == "") ? "" : "fecha_registro BETWEEN '$fecha_ini' AND '$fecha_fin'";

		$where = "";
		$where = ($where1 != "" && ($where2 != "" || $where3 != "" || $where4 != "" || $where5 != "" )) ? $where1.' AND ' : $where1;
		$where = ($where2 != "" && ($where3 != "" || $where4 != "" || $where5 != "")) ? $where.$where2.' AND ' : $where.$where2;
		$where = ($where3 != "" && ($where4 != "" || $where5 != "")) ? $where.$where3.' AND ' : $where.$where3;
		$where = ($where4 != "" && ($where5 != "")) ? $where.$where4.' AND ' : $where.$where4;
		$where = ($where == "" ) ? "" : ' AND '.$where.$where5;

		$consulta = "SELECT id,(SELECT CONCAT(apellidos,' ',nombre) FROM usuarios_informacion WHERE usuarios_informacion.id_usuario = usuarios.id) AS nombre, CASE WHEN rango = 2 THEN 'ASESOR' WHEN rango = 3 THEN 'ALUMNO' ELSE 'ADMINISTRADOR' END AS rango , (SELECT nombre FROM carreras WHERE carreras.id =usuarios.id_carrera) AS carrera, email, password, (SELECT CONCAT(apellidos,' ',nombre) FROM usuarios_informacion WHERE usuarios_informacion.id_usuario=usuarios.asesor) AS asesor, fecha_registro, CASE WHEN status = 0 THEN 'INACTIVO' WHEN status = 1 THEN 'ACTIVO' WHEN status = 2 THEN 'FINALIZADO' ELSE 'CANCELADO' END AS status FROM usuarios WHERE rango != 1".$where;
	}

	$ver_usuarios = $db->query($consulta);

	$usuarios = array();

	while ($usu = mysqli_fetch_array($ver_usuarios)) {
		array_push($usuarios, array('id' => $usu['id'] , 'rango' =>  $usu['rango'] , 'nombre' =>  $usu['nombre'] , 'carrera' =>  $usu['carrera'] , 'email' => $usu['email'] , 'password' => $usu['password'] , 'asesor' => $usu['asesor'] , 'fecha_registro' => $usu['fecha_registro'], 'status' => $usu['status']));
	}

	echo json_encode($usuarios);

	mysqli_close($db);

?>