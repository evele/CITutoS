
<div class="row text-center well">
	<div class="col-md-4 border-L">
		<div class="row bg-info">
			<p>Orden de compra Nro</p>
		</div>
			<p><?php echo $ordenCompra['oc_id']; ?></p>
		<div class="row">
		</div>
	</div>
	<div class="col-md-4">
		<div class="row bg-info">
			<p>Cliente</p>
		</div>
		<div class="row">
			<p><?php echo $ordenCompra['c_apellido'].", ".$ordenCompra['c_nombre']; ?></p>
		</div>
	</div>
	<div class="col-md-4 border-R">
		<div class="row bg-info">
			<p id="orden-compra-importe-total">Importe Total</p> 
		</div>
		<div class="row">
			<p id="orden-compra-importe-total"><?php echo "$ ".$ordenCompra['importe']; ?></p> 
	
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
<?php 
if (count($items)>0){
?>
	<table id="tabla-items" class="table table-bordered table-striped">
		<thead id="tabla-items-head">
			<tr>
				<th></th>
				<th>Cosa</th>
				<th>Importe unitario</th>
				<th>Cantidad</th>
				<th>Acción</th>
			</tr>
		</thead>
		<tbody id="tabla-items-body">
			<?php
			$i = 1;
			//var_dump($items);
			foreach ($items as $item) {
			//var_dump($items);
			?>
				<tr class="fila-body" data-orden-compra-item-id="<?php echo $item['oci_id']; ?>">
					<td><?php echo $i; ?></td>
					<td data-columna="cosa-descripcion"><?php echo $item['co_descripcion']; ?></td>
					<td data-columna="cosa-precio"><?php echo '$ '.$item['oci_precio']; ?></td>
					<td data-columna="cosa-cantidad"><?php echo $item['oci_cantidad']; ?></td>
					<td>
						<a data-columna="cosa-borrar" class="btn btn-danger boton-borrar" href="#"  data-orden-compra-item-id="<?php echo $item['oci_id']; ?>">
							<i class="glyphicon glyphicon-trash"></i>
							&nbsp;Borrar</a></td>
				</tr>
			<?php	
				$i++;
			}
			?>
		</tbody>
	</table>
	<br><br><br>
<?php 
} else {
?>
	<table id="tabla-items" class="table table-bordered table-striped">
		<thead id="tabla-items-head">
			<tr>
				<th></th>
				<th>Cosa</th>
				<th>Importe unitario</th>
				<th>Cantidad</th>
				<th>Borrar</th>
			</tr>
		</thead>
		<tbody id="tabla-items-body">
		</tbody>
	</table>
	<br><br><br>
<?php	
}
?>
<!--
<form method="POST" action="<?php echo site_url('ordencompra/agregar_item_orden_compra/'.$ordenCompra['oc_id']); ?>">
-->
<form id="form-agregar-item" class="form-inline">
	<label>Cosa: </label>
	<select class="form-control" id="cosa-id" name="cosaId">
		<?php 
		foreach ($cosas as $cosa) {
		?>
			<option value="<?php echo $cosa['co_id']; ?>" >
				<?php echo $cosa['co_descripcion']; ?>
			</option>		
		<?php 
		}
		?>
	</select>
	<label>Cantidad: </label>
	<input class="form-control" id="cosa-cantidad" type="number" step="1" name="cosaCantidad" min="1" max="30">
	<input class="btn btn-success boton-agregar" type="submit" value="agregar" id="<?php echo $ordenCompra['oc_id']; ?>" >
</form>
<!--
</form>
-->
<p class="error">
</p>
<div id="mi-modal-confirmar" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Confirmar borrado</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button id="boton-borrar-modal" type="button" class="btn btn-success">Borrar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	</div>
</div>
<script type="text/javascript" src="<?php echo site_url();?>assets/js/editar_orden_compra_manager.js"></script>