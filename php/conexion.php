<?php

	$db = mysqli_connect('localhost', 'root', '','residencias_db');

	if (!$db) {
	    echo 'Error: No se pudo conectar a MySQL.' . PHP_EOL;
	    echo 'errno de depuración: ' . mysqli_connect_errno() . PHP_EOL;
	    echo 'error de depuración: ' . mysqli_connect_error() . PHP_EOL;
	    exit;
	}

	$db->query("SET NAMES 'utf8'");
?>