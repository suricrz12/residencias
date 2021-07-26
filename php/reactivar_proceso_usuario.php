<?php

	$id_user = $_REQUEST['id_user'];

	include('conexion.php');

	if($db->query("UPDATE usuarios SET status = 1 WHERE id = $id_user")) {

		$email = $db->query("SELECT email FROM usuarios WHERE id = $id_user");
		$email = mysqli_fetch_array($email);
		$email = $email['email'];

		echo '{"icon":"success","title":"PROCESO REACTIVADO","text":"SE REACTIVO EL PROCESO DE RESIDENCIAS PARA EL ALUMNO","email":"'.$email.'"}';
	}else{
		echo '{"icon":"error","title":"ERROR","text":"INTENTE DE NUEVO POR FAVOR"}';
	}
	mysqli_close($db);
?>