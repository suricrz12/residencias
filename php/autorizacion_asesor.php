<?php
	$status = $_REQUEST['status'];
	$comentarios = $_REQUEST['comentarios'];
	$name_archivo = $_REQUEST['name_archivo'];

	include('conexion.php');

	if($db->query("UPDATE documentos_entregados  SET status_asesor = $status, comentarios_asesor = '$comentarios', fecha_revision_asesor = NOW() WHERE folio = '$name_archivo'")) {

		echo '{"icon":"success","title":"REVISIÓN GUARDADA","text":"EL ESTATUS Y COMENTARIO FUERON REGISTRADOS"}';
	}else{
		echo '{"icon":"error","title":"ERROR","text":"NO SE PUDO GUARDAR SU REVISIÓN"}';
	}
	mysqli_close($db);
?>