function carga_datos_personales(id){
	$.ajax({
			url: "../php/grado.php"
	}).done(function( data ) {
		let grado = JSON.parse(data),
			html = '<option value="" selected disabled>SELECCIONE SU GRADO</option>';
		for (let i = 0; i < grado.length; i++){
			html += '<option value="' + grado[i].id + '">' + grado[i].nombre + '</option>';
		}
		try{
			document.getElementsByName('guardar_grado')[0].innerHTML = html;
		}catch (error) {}
		$.ajax({
			url: "../php/informacion_personal_usuario.php",
			type: "POST",
			data:{id:id}
		}).done(function( data ) {
			let datos = JSON.parse(data);
			datos = datos[0];

			document.getElementsByName('guardar_nombre')[0].value = datos.nombre;
			document.getElementsByName('guardar_apellidos')[0].value = datos.apellidos;
			document.getElementsByName('guardar_telefono')[0].value = datos.telefono;
			
			if(document.getElementsByName('guardar_curp')[0]){
				document.getElementsByName('guardar_curp')[0].value = datos.curp;
			}
			if(document.getElementsByName('guardar_titulo')[0]){
				document.getElementsByName('guardar_titulo')[0].value = datos.titulo;
			}
			if (document.getElementsByName('guardar_grado')[0]){
				document.getElementsByName('guardar_grado')[0].value = datos.id_grado;
			}

			if(document.getElementsByName('guardar_semestre')[0]){
				document.getElementsByName('guardar_semestre')[0].value = datos.semestre;
			}

			if(document.getElementsByName('guardar_promedio_anterior')[0]){
				document.getElementsByName('guardar_promedio_anterior')[0].value = datos.promedio_anterior;
			}

			if(document.getElementsByName('guardar_promedio_general')[0]){
				document.getElementsByName('guardar_promedio_general')[0].value = datos.promedio_general;
			}
		});
	});
}


// function guardar_datos_personales(id_usuario){

$("#datos_personales").on('submit', function(evt){
	let id_usuario = $("#id_user").val();
	Swal.fire({
		title: '',
		text: "¿Está seguro(@) de cambiar su información?",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'GUARDAR',
		cancelButtonText: 'CANCELAR'
	}).then((result) => {
		if (result.value) {
			var nombre = document.getElementsByName('guardar_nombre')[0].value,
				apellidos =	document.getElementsByName('guardar_apellidos')[0].value,
				telefono = document.getElementsByName('guardar_telefono')[0].value,
				curp = titulo = "",
				semestre = promedio_anterior = promedio_general = id_grado = 0;
			try{
				curp = document.getElementsByName('guardar_curp')[0].value;
				semestre = document.getElementsByName('guardar_semestre')[0].value;
				promedio_anterior = document.getElementsByName('guardar_promedio_anterior')[0].value;
				promedio_general = document.getElementsByName('guardar_promedio_general')[0].value;
			}catch (error) {}

			try{
				id_grado =	document.getElementsByName('guardar_grado')[0].value;
				titulo = document.getElementsByName('guardar_titulo')[0].value;
			}catch (error) {}

			$.ajax({
				url: "../php/guardar_informacion_personal_usuario.php",
				type: "POST",
				data:{id_usuario:id_usuario,nombre:nombre,apellidos:apellidos,telefono:telefono,id_grado:id_grado,titulo:titulo,curp:curp,semestre:semestre,promedio_anterior:promedio_anterior,promedio_general:promedio_general}
			}).done(function( data ) {
				let res = JSON.parse(data);
				Swal.fire({
					icon: res.icon,
					title: res.title,
					text: res.text
				}).then((result) => {
					if (result.value) {
						location.reload();
					}
				})
			})
		}
	})
	evt.preventDefault();
})