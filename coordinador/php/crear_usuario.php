<form action="../php/coordinador/guardar_usuario.php" id="formulario_agregar">
	<br>

	<div class="input-group-sm input-group form-group col-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0">
		<div class="input-group-prepend">
			<span class="input-group-text" id="email">CORREO INSTITUCIONAL</span>
		</div>
		<input type="email" class="form-control" aria-label="email" name="email" aria-describedby="email" placeholder="INGRESE SU CORREO INSTITUCIONAL" autocomplete="off" required>
	</div>

	<div class="input-group-sm input-group form-group col-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0">
		<div class="input-group-prepend">
			<span class="input-group-text" id="password">CONTRASEÑA</span>
		</div>
		<input type="text" class="form-control" aria-label="password" name="password" aria-describedby="password" placeholder="ESCRIBA LA CONTRASEÑA" autocomplete="off" minlength="8" maxlength="8" required>
	</div>
					
	<div class="input-group-sm input-group form-group col-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0">
		<div class="input-group-prepend">
			<label class="input-group-text" for="tipo_usuario">
				TIPO USUARIO
			</label>
		</div>
		<select class="form-control" autocomplete="nope" name="tipo_usuario" onchange="if(this.value==2){document.getElementsByName('asignar_asesor')[0].disabled = true;document.getElementsByName('asignar_asesor')[0].value =0}else{document.getElementsByName('asignar_asesor')[0].disabled = false;document.getElementsByName('asignar_asesor')[0][1].disabled=true,document.getElementsByName('asignar_asesor')[0].value =''}" required>
			<option value="" disabled selected>SELECCIONE UNO</option>
			<option value="2" >ASESOR</option>
			<option value="3" >ALUMNO</option>
		</select>
	</div>

	<div class="input-group-sm input-group form-group col-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0">
		<div class="input-group-prepend">
			<label class="input-group-text" for="asignar_asesor">
				ASIGNAR ASESOR
			</label>
		</div>
		<select class="form-control" autocomplete="nope" name="asignar_asesor" required>
		</select>
	</div>

	<div class="input-group-sm input-group form-group col-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0">
		<div class="input-group-prepend">
			<label class="input-group-text" for="asignar_carrera">
				ASIGNAR CARRERA
			</label>
		</div>
		<select class="form-control" autocomplete="nope" name="asignar_carrera" required>
		</select>
	</div>

	<div class="form-group col-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0">
		<button type="submit" class="btn btn-primary form-control w-100">CREAR USUARIO</button>
	</div>	

</form>