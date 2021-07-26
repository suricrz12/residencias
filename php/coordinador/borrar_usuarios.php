<?php
	include('../conexion.php');
	$id = $_REQUEST['id'];
	if ( $db->query("DELETE FROM usuarios WHERE id = $id") ){
		echo '{"title":"OPERACIÓN EXITOSA","text":"USUARIO ELIMINADO","icon":"success"}';
	}else{
		echo '{"title":"OPERACIÓN FALLIDA","text":"NO SE PUEDO ELIMINAR EL USUARIO","icon":"error"}';
	}
	mysqli_close($db);

?>