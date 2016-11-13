<h1>Cliente</h1>
<p>
	<label>Nombre: <?php echo $cliente['c_nombre']; ?></label>
</p>
<p>
	<label>Apellido: <?php echo $cliente['c_apellido']; ?></label>
</p>
<p>
	<label>Mail: <?php echo $cliente['c_mail']; ?></label>
</p>
<p>
	<a href="<?php echo site_url('clientes/borrar_cliente/'.$cliente['c_id']); ?>">Sí </a><br>
	<a href="<?php echo site_url('clientes/'); ?>"> No</a>
</p>