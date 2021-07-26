<br>
<a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" style="font-size: .8em">FILTRAR BUSQUEDA ˅˄</a>

<link rel="stylesheet" href="../css/jquery-ui.css">
<script src="../js/jquery-1.12.4.js"></script>
<script src="../js/jquery-ui.js"></script>
<script src="../js/funciones.js"></script>

<div class="collapse" id="collapseExample">
	<br>
	<div class="input-group-sm input-group form-group col-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0">
		<div class="input-group-prepend">
			<span class="input-group-text">NOMBRE</span>
		</div>
		<input type="text" class="form-control" aria-label="ver_nombre_autocomplete" required name="ver_nombre_autocomplete" aria-describedby="ver_nombre_autocomplete" id="ver_nombre_autocomplete" placeholder="(SOLO APARECEN ACTIVOS) ESCRIBA Y SELECCIONE" autocomplete="nope">
	</div>


	<div class="input-group-sm input-group form-group col-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0">
		<div class="input-group-prepend">
			<span class="input-group-text">EMAIL</span>
		</div>
		<input type="text" class="form-control" aria-label="ver_email_autocomplete" required name="ver_email_autocomplete" aria-describedby="ver_email_autocomplete" id="ver_email_autocomplete" placeholder="(SOLO APARECEN ACTIVOS) ESCRIBA Y SELECCIONE" autocomplete="nope">
	</div>


	<div class="input-group input-group-sm form-group col-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0">
		<div class="input-group-prepend">
			<label class="input-group-text" for="ver_tipo_usuario">
				TIPO USUARIO
			</label>
		</div>
		<select class="form-control" autocomplete="nope" name="ver_tipo_usuario">
			<option value="" disabled selected>SELECCIONE UNO</option>
			<option value="2">ASESOR</option>
			<option value="3">ALUMNO</option>
		</select>
	</div>

	<div class="input-group input-group-sm form-group col-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0">
		<div class="input-group-prepend">
			<label class="input-group-text" for="ver_carrera">
				CARRERA
			</label>
		</div>
		<select class="form-control" autocomplete="nope" name="ver_carrera">		
		</select>
	</div>


	<div class="input-group-sm input-group form-group col-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0">
		<div class="input-group-prepend">
			<label class="input-group-text" for="ver_asesor_asignado">
				ASESOR ASIGNADO
			</label>
		</div>
		<select class="form-control" autocomplete="nope" name="ver_asesor_asignado" required>
		</select>
	</div>


	<div class="input-group input-group-sm form-group col-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0">
		<div class="input-group-prepend">
			<label class="input-group-text" for="ver_status">
				ESTATUS
			</label>
		</div>
		<select class="form-control" autocomplete="nope" name="ver_status">
			<option value="" disabled selected>SELECCIONE UNO</option>
			<option value="0">INACTIVO</option>
			<option value="1">ACTIVO</option>
			<option value="2">FINALIZADO</option>
			<option value="3">CANCELADO</option>
		</select>
	</div>


	<div class="input-group input-group-sm form-group col-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0">
		<div class="input-group-prepend">
			<label class="input-group-text" for="fecha_ini">
				REGISTRO DESDE
			</label>
		</div>
		<input type="date" class="form-control" aria-label="fecha_ini" name="fecha_ini" aria-describedby="fecha_ini" autocomplete="nope">
	</div>

	<div class="input-group input-group-sm form-group col-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0">
		<div class="input-group-prepend">
			<label class="input-group-text" for="fecha_fin">
				HASTA
			</label>
		</div>
		<input type="date" class="form-control" aria-label="fecha_fin" name="fecha_fin" aria-describedby="fecha_fin" autocomplete="nope">
	</div>

	<div class="input-group input-group-sm form-group col-xl-6 offset-xl-3 col-lg-9 offset-lg-1 col-sm-12 offset-sm-0">
		<button class="btn-primary form-control w-100" onclick="vista_usuarios()">BUSCAR USUARIOS</button>
	</div>
</div>

<div>
	<br>

<style>
#mydatatable input{
    width: 100% !important;
}
</style>
	<table class="table table-sm ecords_list table table-striped table-bordered table-hover" style="text-align: center;font-size: .7em;">
		<thead class="thead-dark">
			<tr>
				<th scope="col">TIPO</th>
				<th scope="col">NOMBRE DE USUARIO</th>
				<th scope="col">CARRERA</th>
				<th scope="col">CORREO</th>
				<th scope="col">ASESOR ASIGNADO</th>
				<th scope="col">FECHA REGISTRO</th>
				<th scope="col">ESTATUS</th>
				<th scope="col" colspan="2"></th>
			</tr>
		</thead>
        </tfoot>
		<tbody id="tabla_usuarios">			
		</tbody>
	</table>
</div>