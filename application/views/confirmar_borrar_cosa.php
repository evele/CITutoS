<h1>Cosa</h1>
<p>
	<label>Descripcion: <?php echo $cosa['co_descripcion']; ?></label>
</p>
<p>
	<label>Precio: <?php echo $cosa['co_precio']; ?></label>
</p>
<p>
	<a href="<?php echo site_url('cosas/borrar_cosa/'.$cosa['co_id']); ?>">Sí </a><br>
	<a href="<?php echo site_url('cosas/'); ?>"> No</a>
</p>