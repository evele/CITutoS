function CosasManager(){
	var self = this;
	self.cosa_id_a_borrar = 0;

	this.init = function() {
		console.log('Empezó a andar la app');
		setTimeout(function(){
			self.load_cosas();
		},3000); 
		
		//self.bind_handler();
	}

	this.load_cosas = function(cosa_id){
		var ws = {
			type: 'POST',
			dataType: 'json',
			url: base_url + "Cosas/ajax_load_cosas",
			complete: self.load_cosas_complete
		}

		$.ajax(ws);
	}

	this.load_cosas_complete = function (data) {
		var response = data['responseText'];
		try {
			response = $.parseJSON(response);
		} catch(e){
			console.log('Error: Not JSON object on response');
			return false;
		}
		if (response.result != null && response.result == 'ok') {
			var lista_cosas = response.lista_cosas;
			for (var i in lista_cosas){
				var una_cosa = lista_cosas[i];
				self.insertar_cosa_en_tabla_html(una_cosa);
			}
		} else {
			console.log('Error: Check Response');
		}
	}

	this.bind_handler = function() {
		//$('.boton-borrar').on('click', self.mostrar_confirmar_borrar);
		$(document).on('click','.boton-borrar', self.mostrar_confirmar_borrar);
		//$('a[data-columna="cosa-editar"]').on('click', self.mostrar_edicion);
		$(document).on('click','a[data-columna="cosa-editar"]', self.mostrar_edicion);
		$('#nueva-cosa-guardar').on('click', self.guardar_cosa);
	}

	this.mostrar_confirmar_borrar = function(evento) {
		var cosa_id = $(evento.target).attr('data-cosa-id');
		var respuesta = confirm("¿Esta seguro de borrar?");
		if (respuesta){
			self.cosa_id_a_borrar = cosa_id;
			self.borrar_cosa(cosa_id);
			console.log('Lo borre');
		}else{
			console.log("No lo borre");
		}
	}

	this.borrar_cosa = function(cosa_id){
		var datatosubmit = {
			cosa_id: cosa_id
		}

		var ws = {
			type: 'POST',
			dataType: 'json',
			data: datatosubmit,
			url: base_url + "Cosas/ajax_borrar_cosa",
			complete: self.borrar_cosa_complete
		}

		$.ajax(ws);
	}

	this.borrar_cosa_complete = function (data) {
		var response = data['responseText'];
		try {
			response = $.parseJSON(response);
		} catch(e){
			console.log_('Error: Not JSON object on response');
			return false;
		}
		if (response.result != null && response.result == 'ok') {
			$('tr[data-cosa-id="'+ self.cosa_id_a_borrar +'"]').remove();
		} else {
			console.log('Error: Check Response');
		}
	}

	this.guardar_cosa = function(evento){
		//$('#mi-modal-agregar-cosa').modal('hide');
		var datatosubmit = {
			cosa_descripcion: $('#nueva-cosa-descripcion').val(),
			cosa_precio: $('#nueva-cosa-precio').val()
		}
		console.log(datatosubmit);

		var ws = {
			type : 'POST',
			dataType : 'json',
			data: datatosubmit,
			url: base_url + 'Cosas/ajax_guardar_cosa',
			complete: self.insertar_cosa_complete
		}
		$.ajax(ws);
	}

	this.insertar_cosa_complete = function(data) {
		response = data['responseText'];
		try {
			response = $.parseJSON(response);
		} 
		catch (e){
			console.log("Error, la respuesta no fue en formato JSON");
			return(false);
		} 
		if (response.result != null && response.result =='ok'){
			//cierro el modal
			$('#mi-modal-agregar-cosa').modal('hide');
			self.insertar_cosa_en_tabla_html(response.cosa);
		} else {
			console.log('Error: Check response');
		}
	};

	this.mostrar_edicion =function(evento){
		// eric seguir acá
	}

	this.insertar_cosa_en_tabla_html = function(cosa) {
		// y me falta agregar la cosa a la lista :P
		var cosa_id = cosa.co_id;
		var cosa_descripcion = cosa.co_descripcion;
		var cosa_precio = cosa.co_precio;
		var fila_a_insertar = 	'<tr data-cosa-id="'+cosa_id+'">'
									+'<td data-columna="cosa-descripcion">'+cosa_descripcion+'</td>'
									+'<td data-columna="cosa-precio">'+cosa_precio+'</td>'
									+'<td>'
										+'<a data-columna="cosa-editar" class="btn btn-warning" href="#"><i class="glyphicon glyphicon-pencil"></i> Editar</a> '
										+'<a data-columna="cosa-guardar" class="btn btn-success hidden" href="#"><i class="glyphicon glyphicon-ok"></i> Guardar</a> '
										+'<a data-columna="cosa-borrar" data-cosa-id="'+cosa_id+'" class="btn btn-danger boton-borrar" href="#"><i class="glyphicon glyphicon-trash"></i> Borrar</a>'
									+'</td>'
								+'<tr>';
		$('#tabla-cosas-body').append(fila_a_insertar);
		//$('a[data-cosa-id="'+cosa_id+'"]').on('click', self.mostrar_confirmar_borrar);
	};

}

var _CM_ = new CosasManager();
$(document).ready(_CM_.init);


