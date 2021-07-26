<?php
	include('../conexion.php');

	$id = $_REQUEST['id'];
	$id_carrera = $_REQUEST['id_carrera'];
	$email = $_REQUEST['email'];
	$password = $_REQUEST['password'];
	$asesor = $_REQUEST['asignar_asesor'];
	$rango = $_REQUEST['tipo_usuario'];


	if ( $db->query("UPDATE usuarios SET rango=$rango, id_carrera=$id_carrera,email='$email',password='$password',asesor=$asesor WHERE id = $id") ){
		echo '{"title":"OPERACIÓN EXITOSA","text":"DATOS DE USUARIO ACTUALIZADOS","icon":"success"}';
	}else{
		echo '{"title":"OPERACIÓN FALLIDA","text":"HUBO UN ERROR AL ACTUALIZAR LOS DATOS","icon":"error"}';
	}
	mysqli_close($db);

?>