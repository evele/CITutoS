<div class="row">
	<div class="col-md-12">
		<?php
		if (count($clientes)>0){
		?>
		<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Apellido</th>
						<th>Mail</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($clientes as $cliente) {
					?>
						<tr data-cliente-id="<?php echo $cliente['c_id']; ?>">
							<td data-columna ="nombre"><?php echo $cliente['c_nombre']; ?></td>
							<td data-columna ="apellido"><?php echo $cliente['c_apellido']; ?></td>
							<td data-columna ="mail"><?php echo $cliente['c_mail']; ?></td>
							<td>
								<a data-columna ="editar" class="btn btn-warning" href="#">
									<i class="glyphicon glyphicon-pencil"></i>
									&nbsp;Editar
								</a>
								<a data-columna ="guardar" class="btn btn-success hidden" href="#" data-accion="<?php echo site_url('clientes/crear_editar_cliente/'.$cliente['c_id']); ?>">
									<i class="glyphicon glyphicon-ok"></i>
									&nbsp;Guardar
								</a>
								<a data-columna="borrar" data-cliente-id="<?php echo $cliente['c_id']; ?>" href="#" class="btn btn-danger boton-borrar" >
									<i class="glyphicon glyphicon-trash"></i>
									&nbsp;Borrar
								</a>
							</td>
						</tr>
					<?php	
					}
					?>
				</tbody>
			</table>
		</div>
	</div> 
</div>
<?php 
}
?>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"
			  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
			  crossorigin="anonymous"></script>
<script type="text/javascript" src="<?php echo site_url();?>assets/js/clientes_manager.js"></script>