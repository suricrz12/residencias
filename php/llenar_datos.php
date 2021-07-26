<div class="W-100">
	<br>
	<label class="ol-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0" for="labelConcepto">DATOS DE USUARIO ASIGNADOS</label>

	<?php

		$datos_user = $db->query("SELECT email, (SELECT carreras.nombre FROM carreras WHERE id=usuarios.id_carrera) AS carrera FROM usuarios WHERE id=$id");
		
		$datos_user = mysqli_fetch_array($datos_user);

		$email = $datos_user['email'];
		$carrera = $datos_user['carrera'];
	 ?>

	<div class="input-group-sm input-group form-group col-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0">
		<div class="input-group-prepend">
			<span class="input-group-text">EMAIL</span>
		</div>
		<input type="text" style="text-transform: uppercase;" class="form-control" value="<?php echo $email;?>" disabled>
	</div>

<?php
	if ($rango != 1) {
?>

	<div class="input-group-sm input-group form-group col-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0">
		<div class="input-group-prepend">
			<span class="input-group-text">CARRERA</span>
		</div>
		<input type="text" style="text-transform: uppercase;" class="form-control" value="<?php echo $carrera;?>" disabled>
	</div>
<?php
	}
?>


	<form action="../php/guardar_informacion_personal_usuario.php" id="datos_personales">
	<label class="ol-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0" for="labelConcepto">DATOS PERSONALES</label>

	<div class="mb-3 col-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0">
		<div class="input-group-prepend">
			<label class="form-label" id="nombre"> NOMBRE</label>
		</div>
		<input type="text" style="text-transform: uppercase;" class="form-control" aria-label="guardar_nombre" required name="guardar_nombre" aria-describedby="guardar_nombre" placeholder="ESCRIBA SU(S) NOMBRE(S)" autocomplete="nope">
	</div>


	<div class="mb-3 col-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0">
		<div class="input-group-prepend">
			<label class="form-label" id="apellidos">APELLIDOS </label>
		</div>
		<input type="text" style="text-transform: uppercase;" class="form-control" aria-label="guardar_apellidos" required name="guardar_apellidos" aria-describedby="guardar_apellidos" placeholder="ESCRIBA SUS APELLIDOS" autocomplete="nope">
	</div>
		

	<div  class="mb-3 col-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0">
		<div class="input-group-prepend">
			<label class="form-label">TELEFONO</label>
		</div>
		<input type="text" style="text-transform: uppercase;" class="form-control" aria-label="guardar_telefono" required name="guardar_telefono" aria-describedby="guardar_telefono" placeholder="INGRESE LOS 10 DIGITOS DE SU TELEFONO" autocomplete="nope" minlength="10" maxlength="10" onkeypress="if(isNaN(event.key)==true || event.which==32)return false">
	</div>

<?php
	if ($rango == 3) {
?>
	<div  class="mb-3 col-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0">
		<div class="input-group-prepend">
			<label class="form-label">CURP</label>
		</div>
		<input type="text" style="text-transform: uppercase;" class="form-control" aria-label="guardar_curp" name="guardar_curp" aria-describedby="guardar_curp" placeholder="ESCRIBA SU CURP" pattern="^[A-Z][A,E,I,O,U,X][A-Z]{2}[0-9]{2}[0-1][0-9][0-3][0-9][M,H][A-Z]{2}[B,C,D,F,G,H,J,K,L,M,N,Ñ,P,Q,R,S,T,V,W,X,Y,Z]{3}[0-9,A-Z][0-9]$" autocomplete="nope" required minlength="8" maxlength="18">
	</div>


	<div  class="mb-3 col-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0">
		<div class="input-group-prepend">
			<label class="form-label">SEMESTRE</label>
		</div>
		<input type="number" class="form-control" aria-label="guardar_semestre" name="guardar_semestre" aria-describedby="guardar_semestre" placeholder="INGRESE SU SEMESTRE" autocomplete="nope"  onkeydown="if(this.value[0]==1 && event.key>2)return false"  onkeypress="if(isNaN(event.key)==true || event.which==32 || this.value.length>1 || this.value[0]>=2)return false" min="1" max="12" required>
	</div>

<div  class="mb-3 col-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0">
		<div class="input-group-prepend">
			<label class="form-label">PROMEDIO ANTERIOR</label>
		</div>
		<input type="number" step="any" class="form-control" aria-label="guardar_promedio_anterior" name="guardar_promedio_anterior" aria-describedby="guardar_promedio_anterior" placeholder="INGRESE SU PROMEDIO ANTERIOR" autocomplete="nope" min="1" max="100" required>
	</div>

	<div class="mb-3 col-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0">
		<div class="input-group-prepend">
			<label class="form-label">PROMEDIO GENERAL</label>
		</div>
		<input type="number" step="any" class="form-control" aria-label="guardar_promedio_general" name="guardar_promedio_general" aria-describedby="guardar_promedio_general" placeholder="INGRESE SU PROMEDIO GENERAL" autocomplete="nope" min="1.00" max="100.00" required>
	</div>

<?php
	}
?>

<?php
	if ($rango != 3) {
?>
	<div class="mb-3 col-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0">
		<div class="input-group-prepend">
			<label class="form-label" for="guardar_grado">
				GRADO
			</label>
		</div>
		<select class="form-control" autocomplete="nope" name="guardar_grado" required>
		</select>
	</div>

	<div class="mb-3 col-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0">
		<div class="input-group-prepend">
			<label class="form-label">TITULO</label>
		</div>
		<input type="text" style="text-transform: uppercase;" class="form-control" aria-label="guardar_titulo" required name="guardar_titulo" aria-describedby="guardar_titulo" placeholder="ESCRIBA EL NOMBRE DE SU TITULO" autocomplete="nope">
	</div>
<?php
	}
?>
	<div class="mb-3 col-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0">
		<button type="submit" class="btn btn-primary form-control w-100">GUARDAR DATOS</button>
	</div>
	</form>
</div>
<script src="../js/datos_personales.js"></script>
<script>carga_datos_personales($('#id_user').val())</script>