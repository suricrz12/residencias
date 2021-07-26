<?php
	include('conexion.php');
	$id_usuario = $_REQUEST['id_usuario'];
	$nombre = strtoupper($_REQUEST['nombre']);
	$apellidos = strtoupper($_REQUEST['apellidos']);
	$telefono = $_REQUEST['telefono'];
	$curp = strtoupper($_REQUEST['curp']);
	$id_grado = $_REQUEST['id_grado'];
	$titulo = strtoupper($_REQUEST['titulo']);
	$promedio_anterior = strtoupper($_REQUEST['promedio_anterior']);
	$promedio_general = strtoupper($_REQUEST['promedio_general']);
	$semestre = strtoupper($_REQUEST['semestre']);


	$probar_existencia = $db->query("SELECT COUNT(id) AS cnt FROM usuarios_informacion WHERE id_usuario = $id_usuario");

	$num = mysqli_fetch_array($probar_existencia);

	if ($num['cnt'] == 0) {

		if( $db->query("INSERT INTO usuarios_informacion(id_usuario, nombre, apellidos, telefono, curp, semestre, promedio_anterior, promedio_general, id_grado, titulo) VALUES ($id_usuario, '$nombre', '$apellidos', '$telefono', '$curp', $semestre, $promedio_anterior, $promedio_general, $id_grado, '$titulo')") ){


			$estatus = $db->query("SELECT status FROM usuarios WHERE id=$id_usuario");
			$estatus = mysqli_fetch_array($estatus);

			if($estatus['status'] == 0){
				$db->query("UPDATE usuarios SET status = 1 WHERE id=$id_usuario");
			}

			echo '{"title":"OPERACIÓN EXITOSA","text":"LOS DATOS PERSONALES FUERON GUARDADOS CORRECTAMENTE","icon":"success"}';

		}else{
			echo '{"title":"OPERACIÓN FALLIDA","text":"SUCEDIO UN ERROR AL GUARDAR LOS DATOS","icon":"error"}';
		}

	}else{
		if($db->query("UPDATE usuarios_informacion SET nombre = '$nombre', apellidos = '$apellidos', telefono = '$telefono', curp = '$curp', semestre = $semestre, promedio_anterior = $promedio_anterior, promedio_general = $promedio_general, id_grado = $id_grado, titulo = '$titulo' WHERE id_usuario = $id_usuario")){
			echo '{"title":"OPERACIÓN EXITOSA","text":"LOS DATOS PERSONALES FUERON ACTUALIZADOS CORRECTAMENTE","icon":"success"}';
		}else{
			echo '{"title":"OPERACIÓN FALLIDA","text":"SUCEDIO UN ERROR AL ACTUALIZAR LOS DATOS","icon":"error"}';
		}
	}

	mysqli_close($db);

?>