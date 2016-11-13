<?php
class OrdenCompra_model extends CI_Model{

	public function __construct(){
		$this->load->database();

	}	

	public function get_ordenCompra($id = FALSE){
		if ($id === FALSE){
			$query = $this->db->get('orden_compra');
		    return $query->result_array();
		}
		$query = $this->db->get_where('orden_compra', array('oc_id' => $id));
		return $query->row_array();
	}

	public function get_ordenCompraFull($id = FALSE){
		if ($id === FALSE){
			$this->db->select('oc_id,oc_fecha,c_nombre,c_apellido,ifnull(sum(oci_precio * oci_cantidad),0) as importe');
			$this->db->from('orden_compra');
			$this->db->join('cliente', 'orden_compra.oc_c_id = cliente.c_id','inner');
			$this->db->join('orden_compra_item', 'orden_compra.oc_id = orden_compra_item.oci_oc_id','left');
			$this->db->group_by('oc_id');
			$query = $this->db->get();
		
		    return $query->result_array();
		} else {
			$this->db->select('oc_id,oc_fecha,c_nombre,c_apellido,ifnull(sum(oci_precio * oci_cantidad),0) as importe');
			$this->db->from('orden_compra');
			$this->db->join('cliente', 'orden_compra.oc_c_id = cliente.c_id','inner');
			$this->db->join('orden_compra_item', 'orden_compra.oc_id = orden_compra_item.oci_oc_id','left');
			$this->db->where('oc_id',$id);
			$query = $this->db->get();
		
			return $query->row_array();
		}
	}

	//a priori poco util listar todos pero me quedó así
	public function get_ordenCompraItem($id = FALSE){
		if ($id === FALSE){
			$query = $this->db->get('orden_compra_item');
			return $query->result_array();
		}
		$query = $this->db->get_where('orden_compra_item', array('oci_id' => $id));
		return $query->row_array();
	}

	public function get_ItemsOrdenCompra($id){
		$this->db->select('oci_id,oci_id,oci_co_id,oci_precio,oci_cantidad,co_descripcion');
		$this->db->from('orden_compra_item');
		$this->db->join('cosa', 'cosa.co_id = orden_compra_item.oci_co_id','inner');
		$this->db->where('oci_oc_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}


	public function insert_ordenCompra(){
		    $data = array(
		        'oc_c_id' => $this->input->post('clienteId'),
		        'oc_fecha' =>date('Y-m-d'),
		    );

		    return $this->db->insert('orden_compra', $data);
	}

	public function insert_ordenCompraItem($idOrdenCompra,$idCosa,$cantidad){
		    $data = array(
		    	'oci_oc_id' => $idOrdenCompra,
		        'oci_co_id' => $idCosa,
		        'oci_precio' => $this->get_precio_cosa($idCosa)['co_precio'],
		        'oci_cantidad' =>$cantidad
		    );
		 	$this->db->insert('orden_compra_item', $data);
			$ult_id = $this->db->insert_id();
			$query = $this->db->get_where('orden_compra_item', array('oci_id' => $ult_id));
			return $query->row_array();
	}


	//aca debería o bien eliminar todos los items.. o chequear que esté vacía (el chequeo en el controlador)
	public function delete_ordenCompra($id){ 
			 $this->db->where('oci_oc_id', $id);
  			 $this->db->delete('orden_compra_item');
			 $this->db->where('oc_id', $id);
  			 $this->db->delete('orden_compra');
	}	

	public function delete_ordenCompraItem($id){ 
			 $this->db->where('oci_id', $id);
  			 $this->db->delete('orden_compra_item');
	}	

	//le dejo aumentar o disminuir la cantidad (disminuir hasta 1) que no joda (lógica en el controlador)
	public function update_ordenCompraItem($id){

  			 $data = array(
		        		'oci_cantidad' => $this->input->post('cantidad')
					);
			$this->db->where('oci_id', $id);
			return($this->db->update('orden_compra_item', $data));
	}		

	//una auxiliar por ahi
	private function get_precio_cosa($id){
		if (is_null($id)){
			return 0;
		} else {
			$this->db->select('co_precio');
			$this->db->from('cosa');
			$this->db->where('co_id',$id);
			$query = $this->db->get();
			return $query->row_array();
		}
	}


}