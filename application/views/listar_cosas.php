<?php 
if (count($cosas)>0){
?>
	<table id="tabla-cosas" class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>Descripcion</th>
				<th>Precio</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody id="tabla-cosas-body">
			<?php
			/*
			foreach ($cosas as $cosa) {
			?>
				<tr data-cosa-id="<?php echo $cosa['co_id'];?>">
					<td data-columna="cosa-descripcion"><?php echo $cosa['co_descripcion']; ?></td>
					<td data-columna="cosa-precio"><?php echo $cosa['co_precio']; ?></td>
					<td>
						<a data-columna="cosa-editar" class="btn btn-warning" href="#"><i class="glyphicon glyphicon-pencil"></i> Editar</a>
						<a data-columna="cosa-guardar" class="btn btn-success hidden" href="#"><i class="glyphicon glyphicon-ok"></i> Guardar</a>
						<a data-columna="cosa-borrar" data-cosa-id="<?php echo $cosa['co_id'];?>" class="btn btn-danger boton-borrar" href="#"><i class="glyphicon glyphicon-trash"></i> Borrar</a>
					</td>
					<!--
					<td><a href="<?php echo site_url('Cosas/crear_editar_Cosa/'.$cosa['co_id']); ?>">Editar</a></td>
					<td><a href="<?php echo site_url('Cosas/confirmar_borrar_Cosa/'.$cosa['co_id']); ?>">Borrar</a></td>
					-->
				</tr>
			<?php	
			}
			*/
			?>
		</tbody>
	</table>
<?php 
}
?>
	<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mi-modal-agregar-cosa">
  + Crear una nueva cosa
</button>

<!-- Modal -->
<div class="modal fade" id="mi-modal-agregar-cosa" tabindex="-1" role="dialog" aria-labelledby="mi-modal-agregar-cosaLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Crear una nueva cosa</h4>
      </div>
      <div class="modal-body">
        <form class="form-inline" method="POST" action="<?php echo site_url('cosas/guardar_cosa'); ?>">
			<div class="form-group">
				<label>Descripcion:</label>
				<input id="nueva-cosa-descripcion" class="form-control" type="text" name="cosaDescripcion">
			</div>
			<div class="form-group">
				<label>Precio $:</label>
				<input id="nueva-cosa-precio" class="form-control" type="number" step="0.01" name="cosaPrecio">
			</div>
	</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button id="nueva-cosa-guardar" type="button" class="btn btn-success">Guardar</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="<?php echo site_url();?>assets/js/cosas_manager.js"></script>