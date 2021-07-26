function subir_archivo(name_save,id_user){
	let doc = name_save.split('_')[0],
		abre = name_save.substr(0,3),
		file = document.getElementById("file"+doc).value,
		broke = file.lastIndexOf(".") + 1,
		ext = file.substr(broke, file.length).toLowerCase();
	if( ext == 'doc'|| ext == 'docx'|| ext == 'pdf'|| ext == 'jpg'|| ext == 'png' ){
		let formData = new FormData(),
			files = $('#file'+doc)[0].files[0];

			formData.append('archivo',files);
			formData.append('id_user',id_user);
			formData.append('name_archivo',name_save);
			formData.append('name_save',name_save+'.'+ext);
			formData.append('abre',abre);
		$.ajax({
			url: '../php/subidor.php',
			type: 'post',
			data: formData,
			contentType: false,
			processData: false
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
	}else{
		Swal.fire({
			icon: 'error',
			title: 'FORMATO IMCOMPATIBLE',
			text: 'SUBA OTRO ARCHIVO CON UNO DE LOS SIGUIENTES FORMATOS PERMITIDOS: DOC, DOCX, PDF, JPG, PNG'
		})
	}
}

function autorizar_coordinador(name_archivo,id_user){
	let abre = name_archivo.split('_')[0],
		status = $("input[name='c"+abre+"']:checked").val();

	if (status == undefined) {
		Swal.fire({
			icon: 'error',
			title: 'ERROR',
			text: 'SELECCIONE SI EL DOCUMENTO ES AUTORIZADO O RECHAZADO'
		})
	}else{
		$('#name_archivo_coordinador').val(name_archivo);
		$('#status_coordinador').val(status);
		$('#comentarios_coordinador').val('')
		$("#modalComentarioCoordinador").modal();
	}
}

function guardar_coordinador(){
	$("#modalComentarioCoordinador").modal('hide');
	let name_archivo = $('#name_archivo_coordinador').val(),
		status = $('#status_coordinador').val(),
		comentarios = $('#comentarios_coordinador').val().toUpperCase();
	$.ajax({
		url: '../php/autorizacion_coordinador.php',
		type: 'post',
		data: {name_archivo:name_archivo,status:status,comentarios:comentarios},
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


function autorizar_asesor(name_archivo,id_user){
	let abre = name_archivo.split('_')[0],
		status = $("input[name='a"+abre+"']:checked").val();

	if (status == undefined) {
		Swal.fire({
			icon: 'error',
			title: 'ERROR',
			text: 'SELECCIONE SI EL DOCUMENTO ES AUTORIZADO O RECHAZADO'
		})
	}else{
		$('#name_archivo_asesor').val(name_archivo);
		$('#status_asesor').val(status);
		$('#comentarios_asesor').val('')
		$("#modalComentarioAsesor").modal();
	}
}

function guardar_asesor(){
	$("#modalComentarioAsesor").modal('hide');
	let name_archivo = $('#name_archivo_asesor').val(),
		status = $('#status_asesor').val(),
		comentarios = $('#comentarios_asesor').val().toUpperCase();
	$.ajax({
		url: '../php/autorizacion_asesor.php',
		type: 'post',
		data: {name_archivo:name_archivo,status:status,comentarios:comentarios},
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


function ver_comentarios(asesor,coordinador){
	$('#ver_comentarios_asesor').val(asesor)
	$('#ver_comentarios_coordinador').val(coordinador)
	$("#modalVerComentarios").modal();
}

function finalizar(id_user){
	$.ajax({
		url: '../php/finalizar_proceso_usuario.php',
		type: 'post',
		data: {id_user:id_user},
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
		$.ajax({
			url: '../php/correo_finalizar_proceso_usuario.php',
			type: 'post',
			data: {email:res.email},
		})
	})
}

function reactivar(id_user){
	$.ajax({
		url: '../php/reactivar_proceso_usuario.php',
		type: 'post',
		data: {id_user:id_user},
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
		$.ajax({
			url: '../php/correo_reactivar_proceso_usuario.php',
			type: 'post',
			data: {email:res.email},
		})
	})
}