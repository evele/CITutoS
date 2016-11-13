function ClientesManager(){
	var self = this;
	self.cliente_id_a_borrar = 0;

	this.init = function() {
		console.log('Empezó a andar la app N');
		self.bind_handler();
	}

	this.bind_handler = function() {
		$('.boton-borrar').on('click', self.mostrar_confirmar_borrar);
	
		$('[data-columna="editar"]').on('click', self.mostrar_edicion_cliente);
		$('[data-columna="guardar"]').on('click', self.guardar_edicion_cliente);
	
	}

	this.mostrar_confirmar_borrar = function(evento) {
		var cliente_id = $(evento.target).attr('data-cliente-id');
		var respuesta = confirm("¿Esta seguro de borrar?");
		if (respuesta){
			//ejecuto mi función ajax
			self.cliente_id_a_borrar = cliente_id;
			self.borrar_cliente(cliente_id);
			console.log('Lo borre');
			//$('tr[data-cliente-id="'+ cliente_id +'"]').remove();
		}else{
			console.log("No lo borre");
		}
	}

	this.borrar_cliente = function(cliente_id) {
		//datatosubmit serian los datos que le mando como parametro al POST
		var datatosubmit = {
			cliente_id: cliente_id
		}
		//Armo el Webservice que quiero ejecutar
		var ws = {
	  		type:'POST',
	  		dataType:'json',
	  		data: datatosubmit,
	  		url: base_url + "Clientes/ajax_borrar_cliente",
	  		complete: self.borrar_cliente_complete
  		}
  	//aca lo llamo
  	$.ajax(ws);

	}

	this.borrar_cliente_complete = function (data){
		var response = data['responseText'];
	    try{
	    	//console.log(response);
	    	response = $.parseJSON( response );
	    }catch(e){
	    	console.log('Error: Not JSON object on response');
	    	return false;
	    }
			if (response.result != null && response.result == 'ok'){
 				//Ejecuto lo que necesito dependiendo de la info que volvio
 				console.log(response);
				$('tr[data-cliente-id="'+ self.cliente_id_a_borrar +'"]').remove();
			}else{
				console.log('Error: Check Response');
			}
	}

	this.mostrar_edicion_cliente = function (evento) {
		var fila_editar = $(evento.target).closest("tr");

		console.log($(fila_editar).find('td[data-columna="nombre"]').text());
		
		//obtengo los datos a editar
		var nombre = $(fila_editar).find('td[data-columna="nombre"]').text();
		var apellido = $(fila_editar).find('td[data-columna="apellido"]').text();
		var mail = $(fila_editar).find('td[data-columna="mail"]').text()
		
		//creo sus inputs
		var input_nombre = '<input data-columna="input-nombre" class="form-control" type="text" value="'+nombre+'">';
		var input_apellido = '<input data-columna="input-apellido" class="form-control" type="text" value="'+apellido+'">';
		var input_mail = '<input data-columna="input-mail" class="form-control" type="text" value="'+mail+'">';
		
		//limpio las columnas
		$(fila_editar).find('td[data-columna="nombre"]').html("");
		$(fila_editar).find('td[data-columna="apellido"]').html("");
		$(fila_editar).find('td[data-columna="mail"]').html("");		
		
		//agrego los imputs
		$(fila_editar).find('td[data-columna="nombre"]').append(input_nombre);
		$(fila_editar).find('td[data-columna="apellido"]').append(input_apellido);
		$(fila_editar).find('td[data-columna="mail"]').append(input_mail);


		//muestro botón y oculto botón
		$(fila_editar).find('a[data-columna="editar"]').addClass("hidden");
		$(fila_editar).find('a[data-columna="borrar"]').addClass("hidden");
		$(fila_editar).find('a[data-columna="guardar"]').removeClass("hidden");
		
	}


	this.guardar_edicion_cliente = function (evento) {
		//var fila_editar = $(evento.target).parent().parent();
		var fila_editar = $(evento.target).closest("tr");

		//agarro los datos
		var datatosubmit = {
			cliente_id: $(fila_editar).attr('data-cliente-id'),
			cliente_nombre: $(fila_editar).find('input[data-columna="input-nombre"]').val(),
			cliente_apellido: $(fila_editar).find('input[data-columna="input-apellido"]').val(),
			cliente_mail: $(fila_editar).find('input[data-columna="input-mail"]').val()
		}

		//console.log(datatosubmit);
		//Armo el Webservice que quiero ejecutar
		var ws = {
	  		type:'POST',
	  		dataType:'json',
	  		data: datatosubmit,
	  		url: base_url + "Clientes/ajax_editar_cliente",
	  		complete: self.editar_cliente_complete
  		}
  	//aca lo llamo
  		$.ajax(ws);

		//console.log($(fila_editar).find('td[data-columna="nombre"]').text());
		//$(this).find("td:nth-child(3)").text().substr(2) 
		//$('tr[data-orden-compra-id="'+self.orden_compra_id_a_borrar+'"]').remove();
		//console.log(fila_editar.html());
	}

	this.editar_cliente_complete = function (data){
		var response = data['responseText'];

		try {
			response = $.parseJSON(response);
		} catch(e) {
			console.log('Error: Not JSON object on response');
			return false;
		}
		if (response.result != null && response.result == "ok" ){
			//obtengo la fila editada
			var fila_editada = $('tr[data-cliente-id="'+response.cliente.c_id+'"]');
			
			//quito los inputs y edito a la vez, que loco :P
			$(fila_editada).find('td[data-columna="nombre"]').html(response.cliente.c_nombre);
			$(fila_editada).find('td[data-columna="apellido"]').html(response.cliente.c_apellido);
			$(fila_editada).find('td[data-columna="mail"]').html(response.cliente.c_mail);

			//oculto botón y muestro botón
			$(fila_editada).find('a[data-columna="editar"]').removeClass("hidden");
			$(fila_editada).find('a[data-columna="borrar"]').removeClass("hidden");
			$(fila_editada).find('a[data-columna="guardar"]').addClass("hidden");
			// $(fila_editada).addClass("success"); dejarlo un poquin y luego quitarlo ;)
		} else {
			console.log('Error:'+response.message);
		}
		
	
	}


}

var _CM_ = new ClientesManager();
$(document).ready(_CM_.init);


