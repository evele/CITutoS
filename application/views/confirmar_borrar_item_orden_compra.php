<h1>Item Orden Compra</h1>
<p>
   <label>Seguro que desea borrar el item?</label>
	<a href="<?php echo site_url('ordencompra/borrar_item/'.$ordenCompraItem['oci_id']); ?>">Sí </a><br>
	<a href="<?php echo site_url('ordencompra/editar_orden_compra/'.$ordenCompraItem['oci_oc_id']); ?>"> No</a>
</p>