function EditarOrdenCompraManager(){
	var self = this;
	self.orden_compra_item_id_a_borrar = 0;
	self.orden_compra_item_id_insertado = 0; // este al gas porque obtengo el valor directo desde ajax
	self.descripcion_item_insertado = '';
	self.cantidad_item_insertado = 0;

	this.init = function(){
		console.log('a ver la app');
		self.bind_handler();
	}

	this.bind_handler = function(){
		//$('.boton-borrar').on('click',self.mostrar_confirmar_borrar);
		$('.boton-borrar').on('click',self.mostrar_confirmar_borrar_modal);
		$('#boton-borrar-modal').on('click',self.borrar_modal);
		$('#mi-modal-confirmar').on('hidden.bs.modal', self.limpiar_modal);
		$('#form-agregar-item').on('submit',self.agregar_item);
	}

	this.mostrar_confirmar_borrar_modal = function(evento){
		$('#mi-modal-confirmar').modal('show');
		//obtengo el id a borrar
		var orden_compra_item_id = $(evento.target).attr('data-orden-compra-item-id');
		self.orden_compra_item_id_a_borrar = orden_compra_item_id;
		//obtengo la fila
		var fila_a_borrar = $('tr[data-orden-compra-item-id="'+ orden_compra_item_id + '"]');
		//obtengo la descripcion
		var descripcion = $(fila_a_borrar).find('td[data-columna="cosa-descripcion"]').text();
		//console.log(descripcion);
		//inserto la descripcion en el body del modal
		$('.modal-body').append('<p>¿Está seguro de que desea quitar <strong>'+descripcion+'</strong> de su orden de compra?</p>');
	}


	this.borrar_modal = function(){
		self.borrar_orden_compra_item(self.orden_compra_item_id_a_borrar);
		//cierro el modal acá???
		$('#mi-modal-confirmar').modal('hide');
	}

	this.limpiar_modal = function(){
		$('.modal-body').empty();
	}

	this.mostrar_confirmar_borrar = function(evento) {
		self.limpiar_validacion();
		var orden_compra_item_id = $(evento.target).attr('data-orden-compra-item-id');
	 	var respuesta = confirm("Está seguro de borrar?");
		if (respuesta) {
			self.orden_compra_item_id_a_borrar = orden_compra_item_id;
			self.borrar_orden_compra_item(orden_compra_item_id);
			console.log('lo borré');
			//y borrarlo
		} else {
			console.log('no lo quiero borrar');
		} 
	}

	this.borrar_orden_compra_item = function (orden_compra_item_id) {
		var datatosubmit = {
			orden_compra_item_id: orden_compra_item_id
		}

		var ws = {
			type : 'POST',
			dataType : 'json',
			data: datatosubmit,
			url: base_url + 'OrdenCompra/ajax_borrar_orden_compra_item',
			complete: self.borrar_orden_compra_item_complete
		}
		$.ajax(ws);
	}

	this.borrar_orden_compra_item_complete = function (data){
		var response = data['responseText'];
		try {
			response = $.parseJSON(response);
		} catch (e) {
			console.log('Error: Not JSON object on response');
			return false;
		}
		if (response.result != null && response.result != ''){
			$('tr[data-orden-compra-item-id="'+ self.orden_compra_item_id_a_borrar + '"]').remove();
			self.recalcular_importe_orden_compra();
		} else {
			console.log('Error: Check response');
		}
	}

	this.validar_agregar = function() {
		var valid = true;
		//chequeo cosa id.
		var cantidad = $('#cosa-cantidad').val();
		if (cantidad =='' || cantidad <1 || cantidad >5){
			valid = false;
			$('.error').append('<label>La cantidad de items debe ser entre 1 y 5</label>');
			$('.error').css("color","red");
		} else {
			$('.error').empty();
		}
		return valid;
	}

	this.limpiar_validacion = function(){
		$('.error').empty();
	}

	this.recalcular_importe_orden_compra = function() {
		//$('#tabla-items-body').children().each(function(){
		var total_orden_compra = 0;
		$('.fila-body').each(function(){
		//$('tr').each(function(){
			//alert($(this).text());
			total_orden_compra += $(this).find("td:nth-child(3)").text().substr(2) * $(this).find("td:nth-child(4)").text();
			//alert("hola");
		});
		//console.log(total_orden_compra);
		$('#orden-compra-importe-total').text('Importe Total: $ '+total_orden_compra);

	}

	this.agregar_item = function(evento){
		evento.preventDefault();
		var is_valid = self.validar_agregar();
		if (!is_valid){
			return false;
		}
		//var orden_compra_id = $(evento.target).attr('id');
		orden_compra_id = $(evento.target).find('.boton-agregar').attr('id');
		//console.log(orden_compra_item_id);
		var item_id = $('#cosa-id').val();
		//console.log(item_id);
		var cantidad = $('#cosa-cantidad').val();
		//$('tr[data-orden-compra-item-id="'+ self.orden_compra_item_id_a_borrar + '"]').remove();
		self.descripcion_item_insertado = $('#cosa-id option:selected').text();
		self.cantidad_item_insertado = cantidad;
		console.log(self.descripcion_item_insertado);
		self.agregar_orden_compra_item(orden_compra_id,item_id,cantidad);

	}

	this.agregar_orden_compra_item = function(orden_compra_id,item_id,cantidad){
		var datatosubmit = {
			orden_compra_id: orden_compra_id,
			item_id: item_id,
			cantidad: cantidad
		}

		var ws = {
			type : 'POST',
			dataType : 'json',
			data: datatosubmit,
			url: base_url + 'OrdenCompra/ajax_insertar_orden_compra_item',
			complete: self.insertar_orden_compra_item_complete
		}
		$.ajax(ws);
	}

	this.insertar_orden_compra_item_complete = function (data){
		
		var response = data['responseText'];
		console.log(response);

		try {
			response = $.parseJSON(response);
		} 
		catch (e){
			console.log('Error: Not JSON object on response');
			return false;
		}
		if (response.result !=null && response.result =='ok'){
			//acá es donde lo debería agregar en la tabla en el html
			console.log("y agrego la filita");	
			var html = '<tr class="fila-body" data-orden-compra-item-id="'+response.orden_compra_item.oci_id+'">'
							+'<td> ?</td>' 
							+'<td data-columna="cosa-descripcion">'+$('#cosa-id').children('[value="'+response.orden_compra_item.oci_co_id+'"]').text()+'</td>'
							+'<td data-columna="cosa-precio">$ '+response.orden_compra_item.oci_precio+'</td>'
							+'<td data-columna="cosa-cantidad">'+self.cantidad_item_insertado+'</td>'
							+'<td><a data-columna="cosa-borrar" class="btn btn-danger boton-borrar " href="#"  data-orden-compra-item-id="'+response.orden_compra_item.oci_id+'"> <i class="glyphicon glyphicon-trash"></i> Borrar </a></td>'
						+'</tr>';
			$('#tabla-items-body').append(html);
			//$('.boton-borrar').last().on('click',self.mostrar_confirmar_borrar);
			$('.boton-borrar').last().on('click',self.mostrar_confirmar_borrar_modal);
			
			self.recalcular_importe_orden_compra();
		}  else {
			console.log('Error: Check response');
		}
	}




}

var _EOCM_ = new EditarOrdenCompraManager();
$(document).ready(_EOCM_.init);