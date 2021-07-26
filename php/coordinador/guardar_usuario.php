<?php
	include('../conexion.php');
	$rango = $_REQUEST['tipo_usuario'];
	$id_carrera = $_REQUEST['asignar_carrera'];
	$email = $_REQUEST['email'];
	$password = $_REQUEST['password'];
	$asesor = $_REQUEST['asignar_asesor'];

	$probar_existencia = $db->query("SELECT COUNT(id) AS cnt FROM usuarios WHERE email='$email'");

	$num = mysqli_fetch_array($probar_existencia);

	if ($num[0] == 0) {
		if ( $db->query("INSERT INTO usuarios(rango, id_carrera, email, password,fecha_registro, asesor) VALUES ($rango,$id_carrera,'$email','$password',NOW(),$asesor)") ){
			echo '{"title":"OPERACIÓN EXITOSA","text":"USUARIO CREADO CORRECTAMENTE","icon":"success"}';
		}else{
			echo '{"title":"OPERACIÓN FALLIDA","text":"ERROR EN LA CREACIÓN DE USUARIO","icon":"error"}';
		}
	}else{
		echo '{"title":"ACCIÓN INNECESARÍA","text":"YA EXISTE EL USUARIO","icon":"info"}';
	}

	mysqli_close($db);

	
?>