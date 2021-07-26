	var tipo_busqueda = 0;

	$("#formulario_agregar").on('submit', function(evt){
		let tipo_usuario = document.getElementsByName("tipo_usuario")[0].value,
			asignar_carrera = document.getElementsByName("asignar_carrera")[0].value,
			email = document.getElementsByName("email")[0].value,
			password = document.getElementsByName("password")[0].value,
			asignar_asesor = document.getElementsByName("asignar_asesor")[0].value;
		$.ajax({
			url: "../php/coordinador/guardar_usuario.php",
			data:{tipo_usuario:tipo_usuario,asignar_carrera:asignar_carrera,email:email,password:password,asignar_asesor:asignar_asesor},
			type:'POST',
		}).done(function( data ) {
			let respuesta = JSON.parse(data);
			Swal.fire({
				icon: respuesta.icon,
				title: respuesta.title,
				text: respuesta.text
			})
			$.ajax({
				url: "../php/correo.php",
				data:{email:email,password:password},
				type:'POST',
			})
		});
		evt.preventDefault();
		document.querySelector("#formulario_agregar").reset();
	})


	function vista_usuarios(){
		tipo_busqueda = 1;
		let ver_tipo_usuario = document.getElementsByName("ver_tipo_usuario")[0].value,
			ver_carrera = document.getElementsByName("ver_carrera")[0].value,
			ver_status = document.getElementsByName("ver_status")[0].value,
			ver_asesor_asignado = document.getElementsByName("ver_asesor_asignado")[0].value,
			fecha_ini = document.getElementsByName("fecha_ini")[0].value,
			fecha_fin = document.getElementsByName("fecha_fin")[0].value;

		if ((fecha_ini == "" && fecha_fin == "") || ((fecha_ini != "" || fecha_fin == "") && (fecha_ini<=fecha_fin)))  {
			$.ajax({
				url: "../php/coordinador/ver_usuarios.php",
				data:{ver_tipo_usuario:ver_tipo_usuario,ver_asesor_asignado:ver_asesor_asignado,ver_carrera:ver_carrera,ver_status:ver_status, fecha_ini:fecha_ini,fecha_fin:fecha_fin},
				type:'POST',
			}).done(function( data ) {
				let res = JSON.parse(data),
					tabla = "";

				for (var i = 0; i < res.length; i++){
					let td_asesor = ( res[i].asesor == null ) ? '' : res[i].asesor,
						nombre = ( res[i].nombre == null ) ? '' : res[i].nombre;
					tabla += '<tr id="tr_usu'+res[i].id+'"><th scope="row">'+res[i].rango+'</th><th scope="row">'+nombre+'</th><th scope="row">'+res[i].carrera+'</th><th scope="row">'+res[i].email+'</th><th scope="row">'+td_asesor+'</th><th scope="row">'+res[i].fecha_registro+'</th><th scope="row">'+res[i].status+'</th><th scope="row"><span class="icon-pencil" onclick="modal_editar_usuario('+res[i].id+')" style="cursor:pointer;color:#066386"></span></th><th scope="row"><span class="icon-bin" onclick="borrar_usuario('+res[i].id+')" style="cursor:pointer;color:red"></span></th></tr>';
				}
				document.querySelector("#tabla_usuarios").innerHTML = tabla;
			});
		}else{
			let title = "";
			if (fecha_ini>fecha_fin && fecha_ini != "" && fecha_fin != "") {
				title = "Fechas especificadas al revés";
			}else{
				title = "Falta especificar una fecha";
			}
			Swal.fire({
				icon: 'error',
				title: title,
				text: 'En el filtrado por fechas revise que ambas se establecieran correctamente'
			})
		}
		$('#collapseExample').collapse('hide')
	}


	function vista_alumnos(){
		tipo_busqueda2 = 1;
		let filtrar_carrera = document.getElementsByName("filtrar_carrera")[0].value,
			filtrar_status = document.getElementsByName("filtrar_status")[0].value,
			filtrar_asesor_asignado = document.getElementsByName("filtrar_asesor_asignado")[0].value,
			filtrar_fecha_ini = document.getElementsByName("filtrar_fecha_ini")[0].value,
			filtrar_fecha_fin = document.getElementsByName("filtrar_fecha_fin")[0].value;

		if ((filtrar_fecha_ini == "" && filtrar_fecha_fin == "") || ((filtrar_fecha_ini != "" || filtrar_fecha_fin == "") && (filtrar_fecha_ini<=filtrar_fecha_fin)))  {
			$.ajax({
				url: "../php/coordinador/ver_alumnos.php",
				data:{filtrar_asesor_asignado:filtrar_asesor_asignado,filtrar_carrera:filtrar_carrera,filtrar_status:filtrar_status, filtrar_fecha_ini:filtrar_fecha_ini,filtrar_fecha_fin:filtrar_fecha_fin},
				type:'POST',
			}).done(function( data ) {
				let res = JSON.parse(data),
					tabla = "";

				for (var i = 0; i < res.length; i++){
					let td_asesor = ( res[i].asesor == null ) ? '' : res[i].asesor,
						nombre = ( res[i].nombre == null ) ? '' : res[i].nombre;
					tabla += '<tr id="tr_usu'+res[i].id+'"><th scope="row">'+nombre+'</th><th scope="row">'+res[i].carrera+'</th><th scope="row">'+res[i].email+'</th><th scope="row">'+td_asesor+'</th><th scope="row">'+res[i].fecha_registro+'</th><th scope="row">'+res[i].status+'</th><th scope="row"><span class="icon-clipboard" onclick="abrir_ventana_edit('+res[i].id+')" style="cursor:pointer;color:#066386"></span></th></tr>';
				}
				document.querySelector("#tabla_alumnos").innerHTML = tabla;
			});
		}else{
			let title = "";
			if (fecha_ini>fecha_fin && fecha_ini != "" && fecha_fin != "") {
				title = "Fechas especificadas al revés";
			}else{
				title = "Falta especificar una fecha";
			}
			Swal.fire({
				icon: 'error',
				title: title,
				text: 'En el filtrado por fechas revise que ambas se establecieran correctamente'
			})
		}
		$('#collapseDiv').collapse('hide');
	}


	function default_vista_usuarios(){
		tipo_busqueda = 0;
		$.ajax({
			url: "../php/coordinador/ver_usuarios_default.php",
			type:'POST',
		}).done(function( data ) {
			let res = JSON.parse(data),
				tabla = "";

			for (var i = 0; i < res.length; i++){
				let td_asesor = ( res[i].asesor == null ) ? '' : res[i].asesor,
					nombre = ( res[i].nombre == null ) ? '' : res[i].nombre;
				tabla += '<tr id="tr_usu'+res[i].id+'"><th scope="row">'+res[i].rango+'</th><th scope="row">'+nombre+'</th><th scope="row">'+res[i].carrera+'</th><th scope="row">'+res[i].email+'</th><th scope="row">'+td_asesor+'</th><th scope="row">'+res[i].fecha_registro+'</th><th scope="row">'+res[i].status+'</th><th scope="row"><span class="icon-pencil" onclick="modal_editar_usuario('+res[i].id+')" style="cursor:pointer;color:#066386"></span></th><th scope="row"><span class="icon-bin" onclick="borrar_usuario('+res[i].id+')" style="cursor:pointer;color:red"></span></th></tr>';
			}
			document.querySelector("#tabla_usuarios").innerHTML = tabla;
		});
	}


	function default_vista_alumnos(){
		tipo_busqueda2 = 0;
		$.ajax({
			url: "../php/coordinador/ver_alumnos_default.php",
			type:'POST',
		}).done(function( data ) {
			let res = JSON.parse(data),
				tabla = "";

			for (var i = 0; i < res.length; i++){
				let td_asesor = ( res[i].asesor == null ) ? '' : res[i].asesor,
					nombre = ( res[i].nombre == null ) ? '' : res[i].nombre;
				tabla += '<tr id="tr_usu'+res[i].id+'"><th scope="row">'+nombre+'</th><th scope="row">'+res[i].carrera+'</th><th scope="row">'+res[i].email+'</th><th scope="row">'+td_asesor+'</th><th scope="row">'+res[i].fecha_registro+'</th><th scope="row">'+res[i].status+'</th><th scope="row"><span class="icon-clipboard" onclick="abrir_ventana_edit('+res[i].id+')" style="cursor:pointer;color:#066386"></span></th></tr>';
			}
			document.querySelector("#tabla_alumnos").innerHTML = tabla;
		});
	}

	function modal_editar_usuario(id){
		$('#id_edit_user').val(id);

		$.ajax({
			url: "../php/coordinador/carga_datos_usuario.php",
			data:{id:id},
			type:'POST',
		}).done(function( data ) {
			let data_usuario = JSON.parse(data);
			document.getElementsByName("editar_tipo_usuario")[0].value = data_usuario.rango; 
			document.getElementsByName("editar_asignar_carrera")[0].value = data_usuario.id_carrera; 
			document.getElementsByName("editar_email")[0].value = data_usuario.email; 
			document.getElementsByName("editar_password")[0].value = data_usuario.password;
			document.getElementsByName("editar_asignar_asesor")[0].value = data_usuario.asesor;

			if (data_usuario.rango == 2) {
				document.getElementsByName("editar_tipo_usuario")[0].disabled = true;
			}else{
				document.getElementsByName("editar_tipo_usuario")[0].disabled = false;
			}

			$('#email_edit_user').val(data_usuario.email);
			$('#password_edit_user').val(data_usuario.password);

			if (data_usuario.rango==2){
				document.getElementsByName("editar_asignar_asesor")[0].disabled = true;
			}else{
				document.getElementsByName("editar_asignar_asesor")[0].disabled = false;
			}
		});
		$("#exampleModal").modal();
	}

	function editar_usuario(id){
		let tipo_usuario = document.getElementsByName("editar_tipo_usuario")[0].value,
			id_carrera = document.getElementsByName("editar_asignar_carrera")[0].value,
			email = document.getElementsByName("editar_email")[0].value,
			password = document.getElementsByName("editar_password")[0].value,
			asignar_asesor = document.getElementsByName("editar_asignar_asesor")[0].value;

		if(tipo_usuario==3 && (asignar_asesor==0 ||asignar_asesor=="")){
			Swal.fire({
				icon: 'error',
				title: 'Falta el asesor del alumno',
				text: 'Debe asignar un asesor'
			})

		}else{
			$.ajax({
				url: "../php/coordinador/editar_usuario.php",
				data:{id:id,tipo_usuario:tipo_usuario,id_carrera:id_carrera,email:email,password:password,asignar_asesor:asignar_asesor},
				type:'POST',
			}).done(function( data ) {
				let not = JSON.parse(data);

				if (not.icon == "success"){

					let old_email = $('#email_edit_user').val(),
						old_pass = $('#password_edit_user').val();

					if (old_email != email || old_pass != password) {
						$.ajax({
							url: "../php/correo.php",
							data:{email:email,password:password},
							type:'POST',
						})
					}
					if (tipo_busqueda == 0){
						default_vista_usuarios();
					}else{
						vista_usuarios();
					}
				}
				Swal.fire({
					icon: not.icon,
					title: not.title,
					text: not.text
				})
				$("#exampleModal").modal('hide');
			});
		}
	}
	
	$.ajax({
		url: "../php/coordinador/carreras.php"
	}).done(function( data ) {
		let carrera = JSON.parse(data),
			html = '<option value="" selected disabled>SELECCIONE UNA CARRERA</option>';
		for (let i = 0; i < carrera.length; i++)
			html += '<option value="' + carrera[i].id + '">' + carrera[i].nombre + '</option>';
		document.getElementsByName('asignar_carrera')[0].innerHTML = html;
		document.getElementsByName('editar_asignar_carrera')[0].innerHTML = html;
		document.getElementsByName('ver_carrera')[0].innerHTML = html;
		document.getElementsByName('filtrar_carrera')[0].innerHTML = html;
	});

	$.ajax({
		url: "../php/coordinador/docentes.php"
	}).done(function( data ) {
		let asesor = JSON.parse(data),
			html = '<option value="" selected disabled>SELECCIONE UN DOCENTE</option>',
			html2 = html;

		html += '<option value="0">NO ASIGNAR, ES UN DOCENTE</option>';
		for (let i = 0; i < asesor.length; i++){
			html += '<option value="' + asesor[i].id + '">' + asesor[i].nombre + '</option>';
			html2 += '<option value="' + asesor[i].id + '">' + asesor[i].nombre + '</option>';
		}

		document.getElementsByName('asignar_asesor')[0].innerHTML = html;
		document.getElementsByName('ver_asesor_asignado')[0].innerHTML = html2;
		document.getElementsByName('editar_asignar_asesor')[0].innerHTML = html;
		document.getElementsByName('filtrar_asesor_asignado')[0].innerHTML = html2;
	});


	function borrar_usuario(id){
		Swal.fire({
			title: '',
			text: "¿Está seguro(@) de borrar este usuario, este cambio no se puede revertir?",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si',
			cancelButtonText: 'Cancelar'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: "../php/coordinador/borrar_usuarios.php",
					data:{id:id},
					type:'POST',
				}).done(function( data ) {
					let asesor = JSON.parse(data);
					Swal.fire({
						icon: asesor.icon,
						title: asesor.title,
						text: asesor.text,
					})
					if(asesor.icon=="success"){
						$("tr").remove("#tr_usu"+id);

						if (tipo_busqueda == 0){
							default_vista_usuarios();
						}else{
							vista_usuarios();
						}
					}
				});
			}
		})
	}

$( function() {
	let availableTags = [];

	$.ajax({
		url: "../php/coordinador/autocomplete_nombre_usuarios_activos.php",
		type:'POST',
	}).done(function( data ) {
		let res = JSON.parse(data);
		for (var i = 0; i < res.length; i++) {
			availableTags[i] = res[i].nombre;
		}

		$( "#ver_nombre_autocomplete" ).autocomplete({
			source: availableTags
		});
	})
});


$( "#ver_nombre_autocomplete" ).autocomplete({
	select: function( event, ui ) {
		let item = ui.item.label,
			id = item.split(', ID_USER:')[1];

		$.ajax({
			url: "../php/coordinador/ver_usuario_por_id.php",
			data:{id:id},
			type:'POST',
		}).done(function( data ) {
			let res = JSON.parse(data),
				tabla = "";

			for (var i = 0; i < res.length; i++){
				let td_asesor = ( res[i].asesor == null ) ? '' : res[i].asesor,
					nombre = ( res[i].nombre == null ) ? '' : res[i].nombre;
				tabla += '<tr id="tr_usu'+res[i].id+'"><th scope="row">'+res[i].rango+'</th><th scope="row">'+nombre+'</th><th scope="row">'+res[i].carrera+'</th><th scope="row">'+res[i].email+'</th><th scope="row">'+td_asesor+'</th><th scope="row">'+res[i].fecha_registro+'</th><th scope="row">'+res[i].status+'</th><th scope="row"><span class="icon-pencil" onclick="modal_editar_usuario('+res[i].id+')" style="cursor:pointer;color:#066386"></span></th><th scope="row"><span class="icon-bin" onclick="borrar_usuario('+res[i].id+')" style="cursor:pointer;color:red"></span></th></tr>';
			}
			document.querySelector("#tabla_usuarios").innerHTML = tabla;
		});
		$('#collapseExample').collapse('hide')
	}
});



$( function() {
	let availableTags = [];

	$.ajax({
		url: "../php/coordinador/autocomplete_email_usuarios_activos.php",
		type:'POST',
	}).done(function( data ) {
		let res = JSON.parse(data);
		for (var i = 0; i < res.length; i++) {
			availableTags[i] = res[i].email;
		}

		$( "#ver_email_autocomplete" ).autocomplete({
			source: availableTags
		});
	})
});


$( "#ver_email_autocomplete" ).autocomplete({
	select: function( event, ui ) {
		let item = ui.item.label,
			id = item.split(', ID_USER:')[1];

		$.ajax({
			url: "../php/coordinador/ver_usuario_por_id.php",
			data:{id:id},
			type:'POST',
		}).done(function( data ) {
			let res = JSON.parse(data),
				tabla = "";

			for (var i = 0; i < res.length; i++){
				let td_asesor = ( res[i].asesor == null ) ? '' : res[i].asesor,
					nombre = ( res[i].nombre == null ) ? '' : res[i].nombre;
				tabla += '<tr id="tr_usu'+res[i].id+'"><th scope="row">'+res[i].rango+'</th><th scope="row">'+nombre+'</th><th scope="row">'+res[i].carrera+'</th><th scope="row">'+res[i].email+'</th><th scope="row">'+td_asesor+'</th><th scope="row">'+res[i].fecha_registro+'</th><th scope="row">'+res[i].status+'</th><th scope="row"><span class="icon-pencil" onclick="modal_editar_usuario('+res[i].id+')" style="cursor:pointer;color:#066386"></span></th><th scope="row"><span class="icon-bin" onclick="borrar_usuario('+res[i].id+')" style="cursor:pointer;color:red"></span></th></tr>';
			}
			document.querySelector("#tabla_usuarios").innerHTML = tabla;
		});
		$('#collapseExample').collapse('hide')
	}
});

////////////////////////




$( function() {
	let availableTags = [];

	$.ajax({
		url: "../php/coordinador/autocomplete_alumnos_activos.php",
		type:'POST',
	}).done(function( data ) {
		let res = JSON.parse(data);
		for (var i = 0; i < res.length; i++) {
			availableTags[i] = res[i].nombre;
		}

		$( "#name_autocomplete" ).autocomplete({
			source: availableTags
		});
	})
});


$( "#name_autocomplete" ).autocomplete({
	select: function( event, ui ) {
		let item = ui.item.label,
			id = item.split(', ID_USER:')[1];

		$.ajax({
			url: "../php/coordinador/ver_alumnos_por_id.php",
			data:{id:id},
			type:'POST',
		}).done(function( data ) {
			let res = JSON.parse(data),
				tabla = "";

			for (var i = 0; i < res.length; i++){
				let td_asesor = ( res[i].asesor == null ) ? '' : res[i].asesor,
					nombre = ( res[i].nombre == null ) ? '' : res[i].nombre;
				tabla += '<tr id="tr_usu'+res[i].id+'"><th scope="row">'+nombre+'</th><th scope="row">'+res[i].carrera+'</th><th scope="row">'+res[i].email+'</th><th scope="row">'+td_asesor+'</th><th scope="row">'+res[i].fecha_registro+'</th><th scope="row">'+res[i].status+'</th><th scope="row"><span class="icon-clipboard" onclick="abrir_ventana_edit('+res[i].id+')" style="cursor:pointer;color:#066386"></span></th></tr>';
			}
			document.querySelector("#tabla_alumnos").innerHTML = tabla;
		});
		$('#collapseDiv').collapse('hide')
	}
});



$( function() {
	let availableTags = [];

	$.ajax({
		url: "../php/coordinador/autocomplete_email_alumnos_activos.php",
		type:'POST',
	}).done(function( data ) {
		let res = JSON.parse(data);
		for (var i = 0; i < res.length; i++) {
			availableTags[i] = res[i].email;
		}

		$( "#ver_email_autocomplete_alumno" ).autocomplete({
			source: availableTags
		});
	})
});


$( "#ver_email_autocomplete_alumno" ).autocomplete({
	select: function( event, ui ) {
		let item = ui.item.label,
			id = item.split(', ID_USER:')[1];

		$.ajax({
			url: "../php/coordinador/ver_alumnos_por_id.php",
			data:{id:id},
			type:'POST',
		}).done(function( data ) {
			let res = JSON.parse(data),
				tabla = "";

			for (var i = 0; i < res.length; i++){
				let td_asesor = ( res[i].asesor == null ) ? '' : res[i].asesor,
					nombre = ( res[i].nombre == null ) ? '' : res[i].nombre;
				tabla += '<tr id="tr_usu'+res[i].id+'"><th scope="row">'+nombre+'</th><th scope="row">'+res[i].carrera+'</th><th scope="row">'+res[i].email+'</th><th scope="row">'+td_asesor+'</th><th scope="row">'+res[i].fecha_registro+'</th><th scope="row">'+res[i].status+'</th><th scope="row"><span class="icon-clipboard" onclick="abrir_ventana_edit('+res[i].id+')" style="cursor:pointer;color:#066386"></span></th></tr>';
			}
			document.querySelector("#tabla_alumnos").innerHTML = tabla;
		});
		$('#collapseDiv').collapse('hide')
	}
});

function abrir_ventana_edit(id){
	$.fancybox.open({
		src  : 'http://localhost/residencias/php/documentos.php?id_user='+id,
		type : 'iframe'
	});
}