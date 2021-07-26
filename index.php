<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<title>LOGÍN SEGUIMIENTO RESIDENCIAS</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<script src="js/jquery-3.5.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
	<header>
	
	<div class="cover d-flex justify-content-center align-items-center flex-colum">
 		 <h1 >CONTROL DE RESIDENCIAS</h1>
		</div>		
	</header>
		<br>
	
	<div class="text-center">
  <img src="img\loginyo.png" height="250" width="250" class="rounded" alt="...">
</div>
		<br>
	<!-- -->
	<div id="login">
		<div class="container">
			<form action="php/login.php" method="post" id="formulario" class="col align-self-center">
				
				<div class="mb-3 col-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0">
						<label for="email" id="email">CORREO ELECTRÓNICO</label>
					<input type="email" class="form-control" placeholder="INGRESE SU USUARIO" name="email" aria-label="email" aria-describedby="email" required>
					
				</div>
				
				<div class="mb-3 col-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0">
						<label class="form-label" id="password">CONTRASEÑA</label>
					<input type="password" class="form-control" placeholder="INGRESE SU CONTRASEÑA" aria-label="password" name="password" aria-describedby="password" required>
				</div>

				<?php
				if(isset($_REQUEST['error'])){
				?>



				<div class="input-group form-group col-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0">
					<label style="color:#F66626">ERROR: USUARIO O CONTRASEÑA INCORRECTOS</label>
				</div>
				<?php } ?>

				<div class="form-group col-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0">
					<button type="submit" class="btn btn-primary form-control w-80">ACCEDER</button>
				</div>				
			</form>
		</div>
	</div>

	<script src="js/jquery-3.5.1.slim.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>