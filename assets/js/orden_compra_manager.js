function OrdenCompraManager(){
	
	var self = this;
	self.orden_compra_id_a_borrar = 0;


	self.init = function(){
		console.log('acá sale andando la app');
		self.bind_handler();
	}

	self.bind_handler = function(){
		$('.boton-borrar').on('click',self.mostrar_confirmar_borrar);
	}

	self.mostrar_confirmar_borrar =function(evento){ 
		var ordenCompraId = $(evento.target).attr('data-orden-compra-id');
		var respuesta = confirm("Seguro que querí borrar?");
		if (respuesta){
			self.orden_compra_id_a_borrar = ordenCompraId;
			self.borrar_orden_compra(ordenCompraId);
			console.log("borraaado");
			//$('tr[data-orden-compra-id="'+self.orden_compra_id_a_borrar+'"]').remove();
		} else {
			console.log("el chango se arrepintió");
		}
	}

	self.borrar_orden_compra = function (orden_compra_id){
		var datatosubmit = {
			orden_compra_id: orden_compra_id
		}

		var ws = {
			type:'POST',
			dataType:'json',
			data: datatosubmit,
			url: base_url + 'OrdenCompra/ajax_borrar_orden_compra',
			complete: self.borrar_orden_compra_complete
		}
		$.ajax(ws);
	}

	self.borrar_orden_compra_complete = function(data){
		var response = data['responseText'];
		console.log(response);
		try {
			response = $.parseJSON(response);
		} catch(e){
			console.log('Error: Not JSON object on response');
			return false;
		}
		if (response.result != null && response.result =='ok'){
			$('tr[data-orden-compra-id="'+self.orden_compra_id_a_borrar+'"]').remove();
		} else {
			console.log('Error: Check response');
		}
	}
}

var _OCM_ = new OrdenCompraManager();
$(document).ready(_OCM_.init);
