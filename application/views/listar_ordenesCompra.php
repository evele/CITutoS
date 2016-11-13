<?php 
if (count($ordenesCompra)>0){
?>
	<table id="tabla-ordenes-compra" class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>Fecha</th>
				<th>Ciente</th>
				<th>Importe</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody id="tabla-ordenes-compra-body">
			<?php
			foreach ($ordenesCompra as $ordenCompra) {
			?>
				<tr data-orden-compra-id="<?php echo $ordenCompra['oc_id']; ?>">
					<td><?php echo $ordenCompra['oc_fecha']; ?></td>
					<td><?php echo $ordenCompra['c_apellido']." ".$ordenCompra['c_nombre']; ?></td>
					<td><?php echo '$ '.$ordenCompra['importe']; ?></td>
					<td>
						<a class="btn btn-warning" href="<?php echo site_url('ordenCompra/editar_orden_compra/'.$ordenCompra['oc_id']); ?>">
							<i class="glyphicon glyphicon-pencil"></i>
							&nbsp;Editar
						</a>
						<a class="btn btn-danger boton-borrar " href="#" data-orden-compra-id="<?php echo $ordenCompra['oc_id']; ?>" >
							<i class="glyphicon glyphicon-trash"></i>
							&nbsp;Borrar</a>
					</td>
				</tr>
			<?php	
			}
			?>
		</tbody>
	</table>
<?php 
}
?>
<p>
	<a class="btn btn-primary" href="<?php echo site_url('ordenCompra/crear_orden_compra/'); ?>">+ Crear una nueva Órden de Compra</a><br>
</p>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"
			  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
			  crossorigin="anonymous"></script>
<script type="text/javascript" src="<?php echo site_url();?>assets/js/orden_compra_manager.js"></script>