	function vista_alumnos(){
		let filtrar_carrera = document.getElementsByName("filtrar_carrera")[0].value,
			id_asesor = $("#id_user").val();

			$.ajax({
				url: "../php/asesor/ver_alumnos.php",
				data:{filtrar_asesor_asignado:id_asesor,filtrar_carrera:filtrar_carrera},
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

		$('#collapseDiv').collapse('hide');
	}

	function default_vista_alumnos(){
		let id_asesor = $("#id_user").val();
		$.ajax({
			url: "../php/asesor/ver_alumnos_default.php",
			data:{id_asesor:id_asesor},
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


	$.ajax({
		url: "../php/asesor/carreras.php"
	}).done(function( data ) {
		let carrera = JSON.parse(data),
			html = '<option value="" selected disabled>SELECCIONE UNA CARRERA</option>';
		for (let i = 0; i < carrera.length; i++)
			html += '<option value="' + carrera[i].id + '">' + carrera[i].nombre + '</option>';
		document.getElementsByName('filtrar_carrera')[0].innerHTML = html;
	});


$( function() {
	let availableTags = [],
		my_id = $('#id_user').val();

	$.ajax({
		url: "../php/asesor/autocomplete_alumnos_activos.php",
		type:'POST',
		data:{my_id:my_id}
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
			url: "../php/asesor/ver_alumnos_por_id.php",
			data:{id:id},
			type:'POST',
		}).done(function( data ) {
			let res = JSON.parse(data),
				tabla = "";

			for (var i = 0; i < res.length; i++){
				let td_asesor = ( res[i].asesor == null ) ? '' : res[i].asesor,
					nombre = ( res[i].nombre == null ) ? '' : res[i].nombre;
				tabla += '<tr id="tr_usu'+res[i].id+'"><th scope="row">'+nombre+'</th><th scope="row">'+res[i].carrera+'</th><th scope="row">'+res[i].email+'</th><th scope="row">'+td_asesor+'</th><th scope="row">'+res[i].fecha_registro+'</th><th scope="row">'+res[i].status+'</th><th scope="row"><span class="icon-clipboard" onclick="abrir_ventana_edit('+res[i].id+')" style="cursor:pointer;color:#1DD0B4"></span></th></tr>';
			}
			document.querySelector("#tabla_alumnos").innerHTML = tabla;
		});
		$('#collapseDiv').collapse('hide')
	}
});



$( function() {
	let availableTags = [],
		my_id = $('#id_user').val();

	$.ajax({
		url: "../php/asesor/autocomplete_email_alumnos_activos.php",
		type:'POST',
		data:{my_id:my_id}
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
			url: "../php/asesor/ver_alumnos_por_id.php",
			data:{id:id},
			type:'POST',
		}).done(function( data ) {
			let res = JSON.parse(data),
				tabla = "";

			for (var i = 0; i < res.length; i++){
				let td_asesor = ( res[i].asesor == null ) ? '' : res[i].asesor,
					nombre = ( res[i].nombre == null ) ? '' : res[i].nombre;
				tabla += '<tr id="tr_usu'+res[i].id+'"><th scope="row">'+nombre+'</th><th scope="row">'+res[i].carrera+'</th><th scope="row">'+res[i].email+'</th><th scope="row">'+td_asesor+'</th><th scope="row">'+res[i].fecha_registro+'</th><th scope="row">'+res[i].status+'</th><th scope="row"><span class="icon-clipboard" onclick="abrir_ventana_edit('+res[i].id+')" style="cursor:pointer;color:#1DD0B4"></span></th></tr>';
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