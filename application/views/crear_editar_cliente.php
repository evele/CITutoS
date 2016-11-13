<?php
if ($crear){
?>	
	<h2>Crear Cliente</h2>
	<form class="form-inline" method="POST" action="<?php echo site_url('clientes/guardar_cliente'); ?>">
		<label>Nombre:</label>
		<input class="form-control" type="text" name="clienteNombre">
		<label>Apellido:</label>
		<input class="form-control" type="text" name="clienteApellido">
		<label>Mail:</label>
		<input class="form-control" type="email" name="clienteMail">
		<input class="btn btn-success" type="submit" name="" value="Guardar">
	</form>	
<?php
} else {
?>
	<h2>Editar Cliente</h2>
	<form class="form-control" method="POST" action="<?php echo site_url('clientes/guardar_cliente/'.$cliente['c_id']); ?>">
		<label>Nombre:</label>
		<input type="text" name="clienteNombre" value="<?php echo $cliente['c_nombre']; ?>">
		<label>Apellido:</label>
		<input type="text" name="clienteApellido" value="<?php echo $cliente['c_apellido']; ?>">
		<label>Mail:</label>
		<input type="email" name="clienteMail" value="<?php echo $cliente['c_mail']; ?>">
		<input type="submit" name="" value="Guardar">
	</form>	
<?php
}
