<?php
class Clientes_model extends CI_Model{

	public function __construct(){
		$this->load->database();

	}	

	public function get_clients($id = FALSE){
		if ($id === FALSE){
			$query = $this->db->get('cliente');
		    return $query->result_array();
		}
		$query = $this->db->get_where('cliente', array('c_id' => $id));
		return $query->row_array();
	}


	public function insert_clients(){
		    $data = array(
		        'c_nombre' => $this->input->post('clienteNombre'),
		        'c_apellido' =>$this->input->post('clienteApellido'),
		        'c_mail' => $this->input->post('clienteMail')
		    );

		    return $this->db->insert('cliente', $data);
	}

	public function delete_clients($id){
			 $this->db->where('c_id', $id);
  			 $this->db->delete('cliente');
	}		

	public function update_clients($id,$nombre,$apellido,$mail){

  			 $data = array(
        				'c_nombre' => $nombre,
		        		'c_apellido' => $apellido,
		        		'c_mail' => $mail
					);

			$this->db->where('c_id', $id);
			$this->db->update('cliente', $data);
			$query = $this->db->get_where('cliente', array('c_id' => $id));
			return $query->row_array();
	}		

}