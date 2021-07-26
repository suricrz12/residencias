<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/bootstrap.min.css">

	<style>
		html,body{min-height: 100% !important;height: 100% !important;max-height: 100% !important;}

		div#banner{min-height: 15%;height: 15%;max-height: 15%;background-color: #07D0C1;display: flex;justify-content: space-around;align-items: center;color: #fff;}

		.fancybox-slide--iframe .fancybox-content {
			height : 85%;
			max-width  : 85%;
			max-height : 85%;
		}
	</style>
	
	<script src="../js/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<link rel="stylesheet" href="../font/style.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<title>ASESOR</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
<?php
	include('../php/conexion.php');

	session_start();

	$id = (isset($_SESSION['id'])) ? $_SESSION['id'] : "not";
	$token = (isset($_SESSION['token'])) ? base64_decode($_SESSION['token']) : "work";
	$rango = (isset($_SESSION['rango'])) ? $_SESSION['rango'] : "this";

	if ($id == $token && $rango == 2) {
?>

<input id="id_user" type="text" value="<?php echo $id;?>" hidden>

	<div class="cover d-flex justify-content-center align-items-center flex-column">
			<h1>BIENVENIDO ASESOR</h1>
			<a href="../php/cerrar_sesion.php">
				<button type="button" class="btn btn-danger">CERRAR SESIÓN</button>
			</a>
		</div>

	<div class="container">
		<nav>
			<div class="nav nav-tabs" id="nav-tab" role="tablist">
				<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">MIS DATOS</a>

				<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false" onclick="default_vista_alumnos()">VER PROCESOS DE RESIDENCIAS</a>
			</div>
		</nav>
		<div class="tab-content" id="nav-tabContent">

			<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
				<?php include("../php/llenar_datos.php");?>

			</div>

			<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
				<?php include("php/ver_proceso_alumnos.php");?>
			</div>

			<script src="js/funciones.js"></script>
			<link rel="stylesheet" href="../css/jquery.fancybox.min.css">
			<script src="../js/jquery.fancybox.min.js"></script>

		</div>

	</div>
<?php
	}else{
		header('Location: http://localhost/residencias/index.php');
	}
?>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</body>
</html>