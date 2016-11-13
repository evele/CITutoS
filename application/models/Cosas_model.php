<?php
class Cosas_model extends CI_Model{

	public function __construct(){
		$this->load->database();

	}	

	public function get_cosas($id = FALSE){
		if ($id === FALSE){
			$query = $this->db->get('cosa');
		    return $query->result_array();
		}
		$query = $this->db->get_where('cosa', array('co_id' => $id));
		return $query->row_array();
	}

	public function insert_cosa($cosaDescripcion,$cosaPrecio){
		    $data = array(
		        'co_descripcion' => $cosaDescripcion,
		        'co_precio' =>$cosaPrecio,
		    );
		    $this->db->insert('cosa', $data);
		    $lastID = $this->db->insert_id();
		    $query = $this->db->get_where('cosa',array('co_id' => $lastID ));
		    return $query->row_array();

	}

	public function delete_cosa($id){
			 $this->db->where('co_id', $id);
  			 $this->db->delete('cosa');
	}		

	public function update_cosa($id){

  			 $data = array(
        				'co_descripcion' => $this->input->post('cosaDescripcion'),
		        		'co_precio' =>$this->input->post('cosaPrecio'),
		        	);

			$this->db->where('co_id', $id);
			return($this->db->update('cosa', $data));
	}		

}