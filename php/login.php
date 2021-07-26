<?php
	$email = $_REQUEST['email'];
	$password = $_REQUEST['password'];
	include('conexion.php');
	if( $login = $db->query("SELECT id, rango FROM usuarios WHERE email = '$email' AND password = '$password'") ){
		$acceso = mysqli_fetch_array($login);
		session_start();
		$_SESSION['id'] = $acceso['id'];
		$_SESSION['token'] = base64_encode( $acceso['id'] );
		$rango_usuario = $acceso['rango'];
		$_SESSION['rango'] = $rango_usuario;
		if ($rango_usuario == 1) {
			header('Location: ../coordinador/index.php');
		}elseif ($rango_usuario == 2) {
			header('Location: ../asesor/index.php');
		}elseif ($rango_usuario == 3) {
			header('Location: ../alumno/index.php');
		}else{
			header('Location: http://localhost/residencias/index.php?error');
		}
	}
	mysqli_close($db);
?>