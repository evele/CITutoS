<form class="form-inline" method="POST" action="<?php echo site_url('ordencompra/guardar_orden_compra'); ?>">
	<label>Seleccione el <center></center>liente:</label>
	<select class="form-control" name="clienteId">
		<?php 
		foreach ($clientes as $cliente) {
		?>
			<option value=<?php echo $cliente['c_id']; ?>>
				<?php echo $cliente['c_apellido'].", ".$cliente['c_nombre']; ?>
			</option>		
		<?php 
		}
		?>
	</select>
	<input class="btn btn-success" type="submit" name="" value="Guardar">
</form>	