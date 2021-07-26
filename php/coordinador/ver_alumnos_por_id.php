<?php
	include('../conexion.php');

	$id = $_REQUEST['id'];

	$ver_usuarios = $db->query("SELECT id,(SELECT CONCAT(apellidos,' ',nombre) FROM usuarios_informacion WHERE usuarios_informacion.id_usuario = usuarios.id) AS nombre, CASE WHEN rango = 2 THEN 'ASESOR' WHEN rango = 3 THEN 'ALUMNO' ELSE 'ADMINISTRADOR' END AS rango , (SELECT nombre FROM carreras WHERE carreras.id =usuarios.id_carrera) AS carrera, email, password, (SELECT CONCAT(apellidos,' ',nombre) FROM usuarios_informacion WHERE usuarios_informacion.id_usuario=usuarios.asesor) AS asesor, fecha_registro, CASE WHEN status = 0 THEN 'INACTIVO' WHEN status = 1 THEN 'ACTIVO' WHEN status = 2 THEN 'FINALIZADO' ELSE 'CANCELADO' END AS status FROM usuarios WHERE id = $id");

	$usuarios = array();

	while ($usu = mysqli_fetch_array($ver_usuarios)) {
		array_push($usuarios, array('id' => $usu['id'] , 'rango' =>  $usu['rango'] , 'nombre' =>  $usu['nombre'] , 'carrera' =>  $usu['carrera'] , 'email' => $usu['email'] , 'password' => $usu['password'] , 'asesor' => $usu['asesor'] , 'fecha_registro' => $usu['fecha_registro'], 'status' => $usu['status']));
	}

	echo json_encode($usuarios);

	mysqli_close($db);

?>