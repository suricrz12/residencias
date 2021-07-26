<br>
<a class="btn btn-primary" data-toggle="collapse" href="#collapseDiv" role="button" aria-expanded="false" aria-controls="collapseDiv" style="font-size: .8em">FILTRAR BUSQUEDA ˅˄</a>

<link rel="stylesheet" href="../css//jquery-ui.css">
<script src="../js/jquery-1.12.4.js"></script>
<script src="../js/jquery-ui.js"></script>

<div class="collapse" id="collapseDiv">
	<br>
	<div class="input-group-sm input-group form-group col-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0">
		<div class="input-group-prepend">
			<span class="input-group-text">NOMBRE</span>
		</div>
		<input type="text" class="form-control" aria-label="name_autocomplete" required name="name_autocomplete" aria-describedby="name_autocomplete" id="name_autocomplete" placeholder="(SOLO APARECEN ACTIVOS) ESCRIBA Y SELECCIONE" autocomplete="off">
	</div>


	<div class="input-group-sm input-group form-group col-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0">
		<div class="input-group-prepend">
			<span class="input-group-text" id="email">EMAIL</span>
		</div>
		<input type="text" class="form-control" aria-label="ver_email_autocomplete_alumno" required name="ver_email_autocomplete_alumno" aria-describedby="ver_email_autocomplete_alumno" id="ver_email_autocomplete_alumno" placeholder="(SOLO APARECEN ACTIVOS) ESCRIBA Y SELECCIONE" autocomplete="off">
	</div>

	<div class="input-group input-group-sm form-group col-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0">
		<div class="input-group-prepend">
			<label class="input-group-text" for="filtrar_carrera">
				CARRERA
			</label>
		</div>
		<select class="form-control" autocomplete="off" name="filtrar_carrera">		
		</select>
	</div>

	<div class="input-group input-group-sm form-group col-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0">
		<button class="btn-primary form-control w-100" onclick="vista_alumnos()">BUSCAR USUARIOS</button>
	</div>
</div>

<div>
	<br>
	<h5>ALUMNOS</h5>
	<table class="table table-sm ecords_list table table-striped table-bordered table-hover" style="text-align: center;font-size: .7em;">
		<thead class="thead-dark">
			<tr>
				<th scope="col">NOMBRE DE ALUMNO</th>
				<th scope="col">CARRERA</th>
				<th scope="col">CORREO</th>
				<th scope="col">ASESOR ASIGNADO</th>
				<th scope="col">FECHA REGISTRO</th>
				<th scope="col">ESTATUS</th>
				<th scope="col"></th>
			</tr>
		</thead>
		<tbody id="tabla_alumnos">			
		</tbody>
	</table>
</div>