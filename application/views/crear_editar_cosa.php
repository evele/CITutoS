<?php
if ($crear){
?>	
	<h1>Crear Cosa</h1>
	<form method="POST" action="<?php echo site_url('cosas/guardar_cosa'); ?>">
		<label>Descripcion:</label>
		<input type="text" name="cosaDescripcion">
		<label>Precio $:</label>
		<input type="number" step="0.01" name="cosaPrecio">
		<input type="submit" name="" value="Guardar">
	</form>	
<?php
} else {
?>
	<h1>Editar cosa</h1>
	<form method="POST" action="<?php echo site_url('cosas/guardar_cosa/'.$cosa['co_id']); ?>">
		<label>Descripcion:</label>
		<input type="text" name="cosaDescripcion" value="<?php echo $cosa['co_descripcion']; ?>">
		<label>Precio $:</label>
		<input  type="number" step="0.01"  name="cosaPrecio" value="<?php echo $cosa['co_precio']; ?>">
		<input type="submit" name="" value="Guardar">
	</form>	
<?php
}
