<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<link rel="stylesheet" href="../css/jquery.fancybox.min.css">
	<script src="../js/jquery.fancybox.min.js"></script>
	<link rel="stylesheet" href="../font/style.css">
	<title>COORDINADOR</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
	<style>
		div.documento{display: flex; flex-direction: column; justify-content: space-around; border: 1px solid #000; padding: .5em; margin: .5em;}
		div.documento>div{margin: .5em 0; display: flex; flex-direction: column;}
		div.documento>div.div1>label{width: 300px; text-align: center;}
		div.documento>div.div1>div{width: 300px; height: 50px; display: flex; justify-content: space-around;}
		div.documento>div.div2{flex-direction: row;flex-wrap:wrap;}
		div.documento>div.div2 label{font-size: .8em;}
		@media(min-width: 999px) {div.documento{flex-direction: row;justify-content: space-around;}}
	</style>

	<?php
		if(isset($_REQUEST['id_user'])){
			session_start();
		}

		$id_user = isset($_REQUEST['id_user']) ? $_REQUEST['id_user'] : $_SESSION['id'];
		$ruta = '../Alumno/img/Alumno'.$id_user.'/';

		$KAR = $ruta.'KAR_'.$id_user; // 0 KARDEX
		$ASN = $ruta.'ASN_'.$id_user; // 1 CARTA DE ASIGNACIÓN
		$CDA = $ruta.'CDA_'.$id_user; // 2 CARTA DE ACEPTACIÓN
		$ANT = $ruta.'ANT_'.$id_user; // 3 ANTEPROYECTO
		$RMR = $ruta.'RMR'; // REPORTE MENSUAL DE RESIDENCIA PROFESIONAL
		$RMR1=$RMR.'1_'.$id_user;	 // 4
		$RMR2=$RMR.'2_'.$id_user;	 // 5
		$RMR3=$RMR.'3_'.$id_user;	 // 6
		$RMR4=$RMR.'4_'.$id_user;	 // 7
		$RMR5=$RMR.'5_'.$id_user;	 // 8
		$RMR6=$RMR.'6_'.$id_user;	 // 9
		$EAI = $ruta.'EAI_'.$id_user; // 10 EVALUACIÓN DEL RESIDENTE POR EL ASESOR INTERNO
		$EAE = $ruta.'EAE_'.$id_user; // 11 EVALUACIÓN DEL RESIDENTE POR EL ASESOR EXTERNO
		$AIF = $ruta.'AIF_'.$id_user; // 12 AUTORIZACIÓN DE INFORME FINAL DE RESIDENCIA
		$RFR = $ruta.'RFR_'.$id_user; // 13 REPORTE FINAL
		

		$nombres_documentos = array('KARDEX','CARTA DE ASIGNACIÓN','CARTA DE ACEPTACIÓN','ANTEPROYECTO','1ER REPORTE MENSUAL DE RESIDENCIA PROFESIONAL','2DO REPORTE MENSUAL DE RESIDENCIA PROFESIONAL','3ER REPORTE MENSUAL DE RESIDENCIA PROFESIONAL','4TO REPORTE MENSUAL DE RESIDENCIA PROFESIONAL','5TO REPORTE MENSUAL DE RESIDENCIA PROFESIONAL','6TO REPORTE MENSUAL DE RESIDENCIA PROFESIONAL','EVALUACIÓN DEL RESIDENTE POR EL ASESOR INTERNO','EVALUACIÓN DEL RESIDENTE POR EL ASESOR EXTERNO','AUTORIZACIÓN DE INFORME FINAL DE RESIDENCIA','REPORTE FINAL'); 

		$nombres_ficheros = array($KAR, $ASN, $CDA, $ANT, $RMR1, $RMR2, $RMR3, $RMR4, $RMR5, $RMR6, $EAI, $EAE, $AIF, $RFR);

		$show = array('SI','SI','SI','SI','SI','SI','SI','SI','SI','SI','SI','SI','SI','SI');

		$abre = array('KAR', 'ASN', 'CDA', 'ANT', 'RMR1', 'RMR2', 'RMR3', 'RMR4', 'RMR5', 'RMR6', 'EAI', 'EAE', 'AIF', 'RFR');

		$folio = array('KAR_'.$id_user, 'ASN_'.$id_user, 'CDA_'.$id_user, 'ANT_'.$id_user, 'RMR1_'.$id_user, 'RMR2_'.$id_user, 'RMR3_'.$id_user, 'RMR4_'.$id_user, 'RMR5_'.$id_user, 'RMR6_'.$id_user, 'EAI_'.$id_user, 'EAE_'.$id_user, 'AIF_'.$id_user, 'RFR_'.$id_user);

		$locking = array('unlock','unlock','unlock','unlock','unlock','unlock','unlock','unlock','unlock','unlock','unlock','unlock','unlock','unlock');

		$autorizaciones = array();

		$comentarios = array();

		$liberar = false;

		$checar = array();


		include('conexion.php');


		for ($i=0; $i < sizeof($folio) ; $i++) {

			$status = $db->query("SELECT status_coordinador, comentarios_coordinador, status_asesor, comentarios_asesor, (CASE WHEN status_coordinador = 2 OR status_asesor = 2 THEN 'unlock' ELSE 'lock' END) AS locking FROM documentos_entregados WHERE folio = '$folio[$i]'");

			$status = mysqli_fetch_array($status);
					//ERROR LINEA 80
			$locking[$i] = ($status['locking'] != '' ? $status['locking'] : $locking[$i]);
			$status_coordinador = ($status['status_coordinador'] != '' ? $status['status_coordinador'] :0);
			$status_asesor = ($status['status_asesor'] != '' ? $status['status_asesor'] :0);
			array_push($autorizaciones, array('coordinador' => $status_coordinador , 'asesor' => $status_asesor ));

			if ($status_asesor == 1 && $status_coordinador == 1) {
				array_push($checar,1);
			}else{
				array_push($checar,0);
			}

			$comentarios_coordinador = ($status['comentarios_coordinador'] == '' ? '' : $status['comentarios_coordinador']);
			$comentarios_asesor = ($status['comentarios_asesor'] == '' ? '' : $status['comentarios_asesor']);

			array_push($comentarios, array('coordinador' => $comentarios_coordinador , 'asesor' => $comentarios_asesor));
		}

		for ($i=0; $i < sizeof($nombres_ficheros) ; $i++) {
			if (file_exists($nombres_ficheros[$i].'.doc')) {
				$nombres_ficheros[$i] = $nombres_ficheros[$i].'.doc';
			}elseif(file_exists($nombres_ficheros[$i].'.docx')) {
				$nombres_ficheros[$i] = $nombres_ficheros[$i].'.docx';
			}elseif(file_exists($nombres_ficheros[$i].'.pdf')) {
				$nombres_ficheros[$i] = $nombres_ficheros[$i].'.pdf';
			}elseif(file_exists($nombres_ficheros[$i].'.jpg')) {
				$nombres_ficheros[$i] = $nombres_ficheros[$i].'.jpg';
			}elseif(file_exists($nombres_ficheros[$i].'.png')) {
				$nombres_ficheros[$i] = $nombres_ficheros[$i].'.png';
			}else{
				$nombres_ficheros[$i] = "";
				$show[$i] = 'NO';
			}
		}

		$rango = $_SESSION['rango'];

		if ($rango == 3) {
			$metodo = "subir_archivo";
			$texto = "SUBIR ARCHIVO";
		}elseif ($_SESSION['rango'] == 2) {
			$metodo = "autorizar_asesor";
			$texto = "GUARDAR ESTA REVISIÓN";
		}else{
			$metodo = "autorizar_coordinador";
			$texto = "GUARDAR ESTA REVISIÓN";
		}

		$datos_user = $db->query("SELECT status, CONCAT('EMAIL: ',email,' , ID_USER: ',id) AS usuario, (SELECT carreras.nombre FROM carreras WHERE id=usuarios.id_carrera) AS carrera FROM usuarios WHERE id=$id_user");
		
		$datos_user = mysqli_fetch_array($datos_user);

		$usuario = $datos_user['usuario'];
		$carrera = $datos_user['carrera'];
		$status = $datos_user['status'];

		if ($checar[0] == 1 && $checar[2] == 1 && $checar[3] == 1 && $checar[4] == 1 && $checar[5] == 1 && $checar[6] == 1 && $checar[7] == 1 && $checar[10] == 1 && $checar[11] == 1 && $checar[12] == 1 && $checar[13] == 1) {
			$liberar = true;
		}

	?>

	<div class="container">
		<?php
			include('modal_ver_comentarios.php');
			include('modal_comentario_coordinador.php');
			include('modal_comentario_asesor.php');
		?>
		<br>
		<h2 class="W-100 text-center">DOCUMENTOS SUBIDOS</h2>

		<?php
			if($status == 0) {
				echo '<h5 class="ol-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0" style="color:#DCBF37">INACTIVO, FAVOR DE LLENAR SUS DATOS PERSONALES</h5>';
			}elseif($status == 1) {
				echo '<h5 class="ol-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0" style="color:#1FD323">PROCESO ACTIVO</h5>';
			}elseif($status == 2) {
				echo '<h5 class="ol-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0" style="color:#0FCDE3">PROCESO FINALIZADO</h5>';
			}

		?>



		<label class="ol-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0" for="labelConcepto">DATOS DE USUARIO ASIGNADOS</label>

		<div class="input-group-sm input-group form-group col-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0">
			<div class="input-group-prepend">
				<span class="input-group-text">USUARIO</span>
			</div>
			<input type="text" class="form-control" value="<?php echo $usuario;?>" disabled>
		</div>

		<div class="input-group-sm input-group form-group col-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0">
			<div class="input-group-prepend">
				<span class="input-group-text">CARRERA</span>
			</div>
			<input type="text" class="form-control" value="<?php echo $carrera;?>" disabled>
		</div>

		<?php 
			if($rango == 1 && $status == 1){
		?>
		<div class="form-group col-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0">
			<button type="button" class="btn btn-success form-control" onclick="finalizar(<?php echo $id_user;?>)"<?php if($liberar){echo '';}else{echo 'disabled';} ?>>FINALIZAR PROCESO DE RESIDENCIA</button>
		</div>
		<?php
			} 
			if($rango == 1 && $status == 2){
		?>
		<div class="form-group col-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0">
			<button type="button" class="btn btn-warning form-control" onclick="reactivar(<?php echo $id_user;?>)">REACTIVAR PROCESO DE RESIDENCIA</button>
		</div>
		<?php
			}
		
		for ($i=0; $i < sizeof($abre) ; $i++) {
			echo '<div class="documento">  <!-- documento -->';
				echo '<div class="div1">';
					echo '<h5 style="width: 300px;font-weight:bolder;">'.$nombres_documentos[$i].'</h5>';
					echo '<div>';
						echo '<a target="_blank" href="'.$nombres_ficheros[$i].'" style="height: 100%;">';
							echo '<img src="../img/'.$show[$i].'.png" style="height: 100%;">';
						echo '</a>';
					echo '</div>';
					echo '<label>DOCUMENTO SUBIDO A SERVIDOR: '.$show[$i].'</label>';
					if ($rango == 3) {
						echo '<input type="file"'.(($locking[$i]=='lock' && $rango == 3) ? ' disabled ' : " ").'id="file'.$abre[$i].'">';
					}
				echo '</div>';
				echo '<div class="div2">';
					echo '<div>';
						echo '<h6 style="width: 250px;font-weight: bolder;">AUTORIZACIÓN ASESOR</h6>'.(($autorizaciones[$i]['asesor']==0 && $show[$i]=='SI') ? '<span style="color:orange;margin:0;">ESPERANDO REVISIÓN</span>' : " ");
						echo '<div style="width: 250px;">';
							echo '<input type="radio" id="si_ a'.$abre[$i].'" name="a'.$abre[$i].'"'.(($autorizaciones[$i]['asesor']==1) ? ' checked ' : " ").'value="1"'.(($rango==1||$rango==3) ? ' disabled' : "").'>';
							echo '<label for="si_a'.$abre[$i].'">AUTORIZADO</label><br>';
							echo '<input type="radio" id="no_a'.$abre[$i].'" name="a'.$abre[$i].'"'.(($autorizaciones[$i]['asesor']==2) ? ' checked ' : " ").'value="2"'.(($rango==1||$rango==3) ? ' disabled' : "").'>';
							echo '<label for="no_a'.$abre[$i].'">RECHAZADO</label><br>';
						echo '</div>';
					echo '</div>';
					echo '<div>';
						echo '<h6 style="width: 250px;font-weight: bolder;">AUTORIZACIÓN COORDINADOR</h6>'.(($autorizaciones[$i]['coordinador'] == 0 && $show[$i] == 'SI') ? '<span style="color:orange;margin:0;">ESPERANDO REVISIÓN</span>' : " ");
						echo '<div style="width: 250px;">';
							echo '<input type="radio" id="si_c'.$abre[$i].'" name="c'.$abre[$i].'"'.(($autorizaciones[$i]['coordinador']==1) ? ' checked ' : " ").'value="1"'.(($rango==2||$rango==3) ? ' disabled' : "").'>';
							echo '<label for="si_c'.$abre[$i].'">AUTORIZADO</label><br>';
							echo '<input type="radio" id="no_c'.$abre[$i].'" name="c'.$abre[$i].'"'.(($autorizaciones[$i]['coordinador']==2) ? ' checked ' : " ").'value="2"'.(($rango==2||$rango==3) ? ' disabled' : "").'>';
							echo '<label for="no_c'.$abre[$i].'">RECHAZADO</label><br>';
						echo '</div>';
					echo '</div>';
					echo '<div style="width:100%;display:flex;justify-content:space-around;">';
						echo '<button class="btn btn-primary"'.(($locking[$i]=='lock' && $rango == 3)||($show[$i] == 'NO' && ($rango == 1 || $rango == 2))? ' disabled ' : " ").'onclick="'.$metodo.'('."'".$abre[$i].'_'.$id_user."',".$id_user.')">'.$texto.'</button>';
						echo '<button class="btn btn-primary" onclick="ver_comentarios(&#39;'.$comentarios[$i]['asesor'].'&#39;,&#39;'.$comentarios[$i]['coordinador'].'&#39;)">VER COMENTARIOS DE REVISIÓN</button>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		}
		?>
	</div>
	<script src="../js/documentos.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>